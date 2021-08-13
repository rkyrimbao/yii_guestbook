<?php

namespace app\controllers\backend;

use Yii;

class BaseController extends \yii\web\Controller
{	
	public $layout = '@app/views/backend/layouts/main';

	public function post()
	{
		return Yii::$app->request->post();
	}

	public function setFlashEnterySuccess()
	{
		Yii::$app->session->setFlash('entrySuccess');
	}
}