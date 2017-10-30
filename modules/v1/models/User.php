<?php

namespace app\modules\v1\models;

use Yii;

class User extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['name', 'username', 'password', 'mail'], 'string', 'max' => 128],
            [['username'], 'unique'],
        ];
    }

    public function extraFields()
    {
        return [
            'albums',
            'posts',
            'tasks'
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'mail' => 'Mail',
        ];
    }

    public function getAlbums(){return $this->hasMany(Album::className(), ['userId' => 'id']);}
    public function getPosts(){return $this->hasMany(Post::className(), ['userId' => 'id']);}    
    public function getTasks(){return $this->hasMany(Task::className(), ['userId' => 'id']);}

}
