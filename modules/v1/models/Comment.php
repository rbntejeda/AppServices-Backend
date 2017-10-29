<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property string $postId
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $body
 *
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'postId']);
    }
}
