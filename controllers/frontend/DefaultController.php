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
        
        $guests = Registration::find()->orderBy([new \yii\db\Expression("id desc")])->all();
        $events = Event::find()
            ->where(['is_published' => Event::STATUS_PUBLISHED])
            ->orderBy([new \yii\db\Expression("event_date asc")])
            ->all();

        $eventsData = array();

		if ($registration->load(Yii::$app->request->post())) {

            $isFormValid = $registration->validate();

            $postData = Yii::$app->request->post();

            if (isset($postData['events'])) {
                $eventsData = array_filter($postData['events']);
                $eventsData = array_values($eventsData);
            }

            if ($isFormValid) {

                $registration->save();

                if (!empty($eventsData)) {
                    
                    foreach ($eventsData as $key => $eventId) {

                        $registrationEvent = new RegistrationEvent();

                        $registrationEvent->registration_id = $registration->id;

                        $registrationEvent->event_id = $eventId;

                        $registrationEvent->save();
                    }
                    
                }
                
                Yii::$app->session->setFlash('entryConfirmed');

                return $this->refresh();
            }
		}

        return $this->render($this->indexTemplate, array(
            'registration' => $registration,
            'events' => $events,
            'eventsData' => $eventsData
        ));
	}
}
