<?php

namespace app\modules\v1\models;

use Yii;

class Task extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'task';
    }


    public function rules()
    {
        return [
            [['userId', 'title', 'completed'], 'required'],
            [['userId', 'completed'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    public function extraFields()
    {
        return [
            'user'
        ];
    }


    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'id' => 'ID',
            'title' => 'Title',
            'completed' => 'Completed',
        ];
    }

    public function getUser(){return $this->hasOne(User::className(), ['id' => 'userId']);}
    
}
