<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'unique'],
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert) && $this->password) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            return true;
        }
        return false;
    }
    public static function findIdentity($id) { return static::findOne($id); }
    public static function findIdentityByAccessToken($token, $type = null) { return null; }
    public function getId() { return $this->id; }
    public function getAuthKey() { return ''; }
    public function validateAuthKey($authKey) { return true; }
    public static function findByUsername($username) { return static::findOne(['username' => $username]); }
    public function validatePassword($password) { return Yii::$app->security->validatePassword($password, $this->password_hash); }
}