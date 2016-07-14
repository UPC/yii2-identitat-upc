<?php

namespace upc\identitat;

use Yii;

use phpCAS;

class User extends \yii\web\User
{
    public $casServerVersion = '2.0';
    public $casServerPort = 443;
    public $casServerHostname = '';
    public $casServerUri = '';

    public function init()
    {
        parent::init();

        $this->assertRequired(['casServerVersion', 'casServerHostname', 'casServerPort'])

        phpCAS::client($this->casServerVersion, $this->casServerHostname, $this->casServerPort, $this->casServerUri);
        if (phpCAS::checkAuthentication())
        {
            $this->loadIdentity();
        }
    }

    public function authenticate()
    {
        phpCAS::forceAuthentication();
        return $this->loadIdentity();
    }

    public function logout($destroySession = true)
    {
        parent::logout(false);
        if (phpCAS::checkAuthentication()) {
            phpCAS::logout();
        }
        return $this->getIsGuest;
    }

    private function loadIdentity()
    {
        $class = $this->identityClass;
        $identity = $class::findIdentity(phpCAS::getUser());
        $this->setIdentity($identity);
        return $identity;
    }

    private function assertRequired($attributes)
    {
        foreach($attributes as $attribute) {
            if (empty($this->$attribute)) {
                throw new InvalidConfigException("$attribute is required.");
            }
        }
    }
}
