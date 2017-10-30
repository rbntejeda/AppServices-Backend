<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use \Firebase\JWT\JWT;

class User extends ActiveRecord implements IdentityInterface
{
    const KEYCODE = "ViN}YKbSt7e7EU1YJG1cSdN2#htMTyt@Fs=8_LMvxPna:`P<hsMGp(^3^9k?FDY";

    public static function tableName()
    {
        return 'user';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        try
        {
            $decoded = JWT::decode($token, static::KEYCODE, array('HS256'));
            // return static::findOne($decoded->sub);
            $model=new Self();
            $model->Attributes=[
                "id"=>$decoded->sub,
                "name"=>$decoded->name
            ];
            return $model;
        }
        catch(yii\UnexpectedValueException $e){}
        catch(\Firebase\JWT\BeforeValidException $e){}
        catch(\Firebase\JWT\ExpiredException $e){}
        catch(\Firebase\JWT\SignatureInvalidException $e){}
    }

    public function getToken()
    {
        return JWT::encode([
            'sub'=>$this->id,
            'name'=>$this->name,
            'iss'=>\Yii::$app->request->hostName,
            "iat"=>time(),
            "exp"=>time()+3600,
            // "nbf"=>time()+30
        ], static::KEYCODE);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}