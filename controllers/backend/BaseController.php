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

	public function setFlashEntryFail($message = '')
	{
		Yii::$app->session->setFlash('entryFail', $message);
	}

	public function setFlashEntryNotify($message = '')
	{
		Yii::$app->session->setFlash('entryNotify', $message);
	}

	public function setFlashEntrySuccess($message = '')
	{
		Yii::$app->session->setFlash('entrySuccess', $message);
	}

	public function getAppRequest()
	{
		return Yii::$app->getRequest();
	}

	public function getAppReferrer()
	{
		return Yii::$app->request->referrer;
	}

	public function onPost($model)
    {
    	if ($model->load($this->post())) {

    		$isFormValid = $model->validate();

    		if ($isFormValid) {

    			$model->save();

    			return true;
    		}
    	}

    	return false;
    }
}