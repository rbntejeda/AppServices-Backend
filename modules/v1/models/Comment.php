<?php

namespace app\modules\v1\models;

use Yii;

class Comment extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'comment';
    }


    public function rules()
    {
        return [
            [['postId', 'name', 'email', 'body'], 'required'],
            [['postId'], 'integer'],
            [['body'], 'string'],
            [['name', 'email'], 'string', 'max' => 128],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['postId' => 'id']],
        ];
    }    

    public function extraFields()
    {
        return [
            'post'
        ];
    }


    public function attributeLabels()
    {
        return [
            'postId' => 'Post ID',
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'body' => 'Body',
        ];
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'postId']);
    }
}
