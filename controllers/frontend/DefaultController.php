<?php

namespace app\controllers\frontend;

use Yii;
use app\models\Registration;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\helpers\Url;

class DefaultController extends \yii\web\Controller
{
	protected $indexTemplateName = 'index';
	protected $confirmationTemplateName = 'entry_confirmation';

	// public function actionIndex()
	// {
	// 	$registrationModel = new Registration();

	// 	if ($registrationModel->load($postData)) {

	// 	}
	// }

    public function actionIndex()
    {	
    	$registrationModel = new Registration();

    	$postData = Yii::$app->request->post();

    	if ($registrationModel->load($postData)) {

    		$isFormValid = $registrationModel->validate();

    		if ($isFormValid) {
    			$registrationModel->save();
    			Yii::$app->session->setFlash('entryConfirmed');
    			return $this->refresh();
    		}
    	}
    
        return $this->render($this->indexTemplateName, array(
        	'registrationModel' => $registrationModel
        ));
    }
}
