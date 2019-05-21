<?php

namespace upc\identitat;

use Yii;
use  yii\base\InvalidConfigException;

use phpCAS;

class User extends \yii\web\User
{
    public $serverHostname= '';
    public $serverUri = '';
    public $serverVersion = '2.0';
    public $serverPort = 443;
    public $serverCA = false;
    public $verbose = false;
    public $testUser = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->assertRequired('serverHostname');
        $this->assertRequired('serverPort');
        $this->assertRequired('serverVersion');

        if ($this->testUser != null) {
            return;
        }

        phpCAS::setVerbose($this->verbose);
        phpCAS::client($this->serverVersion, $this->serverHostname, $this->serverPort, $this->serverUri);
        if (empty($this->serverCA)) {
            phpCAS::setNoCasServerValidation();
        }
        else {
            phpCAS::setserverCACert(Yii::getAlias($this->serverCA));
        }
    }

    /**
     * Force user authentication.
     *
     * @return IdentityInterface the identity object associated with the currently authenticated user.
     */
    public function authenticate()
    {
        if ($this->testUser != null) {
            return $this->loadIdentity();
        }
        phpCAS::forceAuthentication();
        return $this->loadIdentity();
    }

    /**
     * @inheritdoc
     */
    public function logout($destroySession = true)
    {
        parent::logout(false);

        if ($this->testUser != null) {
            return true;
        }

        if (phpCAS::checkAuthentication()) {
            phpCAS::logout();
        }
        return $this->getIsGuest;
    }

    private function loadIdentity()
    {
        $class = $this->identityClass;
        $identity = $class::findByUsername($this->testUser == null ? phpCAS::getUser() : $this->testUser);
        $this->setIdentity($identity);
        return $identity;
    }

    private function assertRequired($attribute)
    {
        if (empty($this->$attribute)) {
            throw new InvalidConfigException("$attribute is required.");
        }
    }
}
