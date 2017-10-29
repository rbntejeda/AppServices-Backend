<?php 

namespace app\modules\v1\controllers;

use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\Post';
}