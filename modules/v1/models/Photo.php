<?php

namespace app\modules\v1\models;

use Yii;

class Photo extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'photo';
    }


    public function rules()
    {
        return [
            [['albumId', 'url'], 'required'],
            [['albumId'], 'integer'],
            [['title', 'url', 'thumbnailUrl'], 'string', 'max' => 128],
            [['albumId'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['albumId' => 'id']],
        ];
    }
    


    public function attributeLabels()
    {
        return [
            'albumId' => 'Album ID',
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'Url',
            'thumbnailUrl' => 'Thumbnail Url',
        ];
    }

    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'albumId']);
    }
}