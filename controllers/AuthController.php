<?php 

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;

class AuthController extends Controller
{
	public function actionToken()
	{
		$request = Yii::$app->request;
		$username=$request->post('username');
		$password=$request->post('password');
		if($username&&$password){
			$user=User::findOne(['username'=>$username,'password'=>$password]);
			if($user){
				return [
					'access_token'=>$user->token,
					'expire_in'=>3600
				];
			}
		}
	}
}