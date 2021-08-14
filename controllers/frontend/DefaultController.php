<?php

namespace app\controllers\frontend;

use Yii;

use app\models\Registration;
use app\models\RegistrationEvent;
use app\models\Event;

use yii\base\Model;
use yii\helpers\VarDumper;
use yii\helpers\Url;

class DefaultController extends \yii\web\Controller
{
	protected $indexTemplate = 'index';
	protected $confirmationTemplate = 'entry_confirmation';

	public function actionIndex()
	{
		$registration = new Registration();
        $registrationEvent = new RegistrationEvent();
        
        $events = Event::find()->all();

        $postData = Yii::$app->request->post();

        $eventsData = array();

		if ($registration->load($postData)) {
            $isFormValid = $registration->validate();
            
            $eventsData = array_filter($postData['events']);

            if ($isFormValid) {

                $registration->save();

                if (!empty($eventsData)) {
                    foreach ($eventsData as $key =>$eventData) {
                        $registrationEvent->registration_id = $registration->id;
                        $registrationEvent->event_id = $eventData;
                    }

                    $registrationEvent->save();
                }

                Yii::$app->session->setFlash('entryConfirmed');

                return $this->refresh();
            }
		}

        return $this->render($this->indexTemplate, array(
            'registration' => $registration,
            'registrationEvent' => $registrationEvent,
            'events' => $events,
            'eventsData' => $eventsData
        ));
	}

    // public function actionIndex()
    // {	
    // 	$registrationModel = new Registration();

    // 	$postData = Yii::$app->request->post();

    // 	if ($registrationModel->load($postData)) {

    // 		$isFormValid = $registrationModel->validate();

    // 		if ($isFormValid) {
    // 			$registrationModel->save();
    // 			Yii::$app->session->setFlash('entryConfirmed');
    // 			return $this->refresh();
    // 		}
    // 	}
    
    //     return $this->render($this->indexTemplateName, array(
    //     	'registrationModel' => $registrationModel
    //     ));
    // }
}
