<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class ExchangeRequest extends ActiveRecord
{
    public static function tableName()
    {
        return 'exchange_request';
    }
    public function rules()
    {
        return [
            [['to_user_id', 'book_title', 'book_author'], 'required'],
            ['status', 'default', 'value' => 'pending'],
            [['message'], 'string'],
        ];
    }
    public function getFromUser()
    {
        return $this->hasOne(User::class, ['id' => 'from_user_id']);
    }
    public function getToUser()
    {
        return $this->hasOne(User::class, ['id' => 'to_user_id']);
    }
}