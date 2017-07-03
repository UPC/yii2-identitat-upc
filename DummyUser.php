<?php
namespace upc\identitat;

use Yii;
use  yii\base\InvalidConfigException;


use phpCAS;

class DummyUser extends \yii\web\User
{
    public $casServerVersion = '2.0';
    public $casServerHostname = 'cas.upc.edu';
    public $casServerPort = 443;
    public $casServerCA = '@upc/identitat/ca_bundle.crt';
    public $casServerUri = '';
    public $casVerbose = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->assertRequired('casServerHostname');
        $this->assertRequired('casServerPort');
        $this->assertRequired('casServerVersion');
    }

    /**
     * Force user authentication.
     *
     * @return IdentityInterface the identity object associated with the currently authenticated user.
     */
    public function authenticate()
    {
        return $this->loadIdentity();
    }

    /**
     * @inheritdoc
     */
    public function logout($destroySession = true)
    {
        parent::logout(false);
        return true;
    }

    private function loadIdentity()
    {
        $class = $this->identityClass;
        $identity = $class::findByUsername('admin');
        if ($identity == null) {
            throw new \Exception('User not found.');
        }
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
