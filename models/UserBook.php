<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class UserBook extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_book';
    }
    public function rules()
    {
        return [
            [['title', 'author'], 'required'],
            [['description'], 'string'],
            ['status', 'default', 'value' => 'available'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'title' => 'Название книги',
            'author' => 'Автор',
            'description' => 'Описание',
            'status' => 'Статус',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->user->id;
            }
            return true;
        }
        return false;
    }
    public static function getAvailableBooks()
    {
        return self::find()
            ->where(['status' => 'available'])
            ->with('user')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }
    public static function getUserAvailableBooks($user_id)
    {
        return self::find()
            ->where(['user_id' => $user_id, 'status' => 'available'])
            ->all();
    }
}