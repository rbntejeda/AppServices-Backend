<?php

namespace app\modules\v1\models;

use Yii;

class Album extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'album';
    }


    public function rules()
    {
        return [
            [['userId', 'title'], 'required'],
            [['userId'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    public function extraFields()
    {
        return [
            'user',
            'photos'
        ];
    }


    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['albumId' => 'id']);
    }
}
