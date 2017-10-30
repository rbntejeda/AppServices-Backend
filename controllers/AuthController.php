<?php 

namespace app\controllers;

use Yii;
use app\models\User;
use yii\rest\Controller;
use yii\web\HttpException;
use \Firebase\JWT\JWT;

class AuthController extends Controller
{
	public function actionToken()
	{
		$request = Yii::$app->request;
		$username=$request->post('username');
		$password=$request->post('password');
		if($username&&$password)
		{
			$user=User::findOne(['username'=>$username,'password'=>$password]);
			if($user){
				return [
					'access_token'=>$user->token,
					'expire_in'=>3600
				];
			}
			else
			{
            	throw new HttpException(401, "Unauthorized.");
			}
		}
		else
		{
            throw new HttpException(401, "Unauthorized.");
		}
	}

	public function actionTime()
	{
		$data = JWT::decode($_POST['access_token'], User::KEYCODE, array('HS256'));
		return $data->exp-time();
	}
}