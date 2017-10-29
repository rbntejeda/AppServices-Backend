<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property string $userId
 * @property string $id
 * @property string $title
 * @property integer $completed
 *
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'title', 'completed'], 'required'],
            [['userId', 'completed'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'id' => 'ID',
            'title' => 'Title',
            'completed' => 'Completed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
