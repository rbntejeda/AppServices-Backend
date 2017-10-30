<?php

namespace app\modules\v1\models;

use Yii;

class Post extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'post';
    }


    public function rules()
    {
        return [
            [['userId', 'title', 'body'], 'required'],
            [['userId'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    public function extraFields()
    {
        return [
            'comments',
            'user'
        ];
    }


    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['postId' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
