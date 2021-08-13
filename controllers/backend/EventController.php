<?php

namespace app\controllers\backend;

use app\controllers\backend\BaseController;
use app\models\Event;

use yii\db\Query;

class EventController extends BaseController
{
	protected $indexTemplate = 'index';
	protected $createTemplate = 'create';

    public function actionIndex()
    {
    	$events = Event::find()->all();

        return $this->render($this->indexTemplate, array(
        	'events' => $events
        ));
    }

    public function actionCreate()
    {
    	$eventModel = new Event();

    	if ($eventModel->load($this->post())) {
    		$isFormValid = $eventModel->validate();

    		if ($isFormValid) {

    			$eventModel->save();

    			$this->setFlashEnterySuccess();

    			return $this->redirect(['/admin/events']);
    		}
    	}

    	return $this->render($this->createTemplate, array(
    		'eventModel' => $eventModel
    	));
    }
}
