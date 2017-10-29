<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property string $albumId
 * @property string $id
 * @property string $title
 * @property string $url
 * @property string $thumbnailUrl
 *
 * @property Album $album
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['albumId', 'url'], 'required'],
            [['albumId'], 'integer'],
            [['title', 'url', 'thumbnailUrl'], 'string', 'max' => 128],
            [['albumId'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['albumId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'albumId']);
    }
}
