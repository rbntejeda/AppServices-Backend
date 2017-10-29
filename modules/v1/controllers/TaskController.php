<?php 

namespace app\modules\v1\controllers;

use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = 'app\modules\v1\models\Task';
}