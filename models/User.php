<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $cedula;    
    public $nombre;
    public $correo;  
    public $rol;    
    public $celular;
    public $username;
    public $contrasena;    
    public $authKey;
    public $accessToken;

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $user = Usuario::find()->where(['cedula' => $id])->one();

        if ($user) {
            return new static($user);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = Usuario::find()->where(['cedula' => $username])->asArray()->one();

        if ($user) {
            return new static($user);
        }
        return null;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->cedula;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($contrasena)
    {
        //return $this->contrasena === $contrasena;
        if (crypt($contrasena, $this->contrasena) == $this->contrasena) {
            return $contrasena === $contrasena;
        }
    }
    
    public static function isUserAdmin($id) {
        if (Usuario::findOne(['cedula' => $id, 'rol' => 1])) {
            return true;
        } else {

            return false;
        }
    }

    public static function isUserSimple($id) {
        if (Usuario::findOne(['cedula' => $id, 'rol' => 2])) {
            return true;
        } else {

            return false;
        }
    }
    
}
