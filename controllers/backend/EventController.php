<?php

namespace app\controllers\backend;

use app\controllers\backend\BaseController;
use app\models\Event;
use app\models\RegistrationEvent;

use yii\db\Query;

class EventController extends BaseController
{
	protected $indexTemplate = 'index';
	protected $createTemplate = 'create';
	protected $viewTemplate = 'view';
	protected $editTemplate = 'edit';

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

    	if ($this->onPost($eventModel)) {

    		$this->setFlashEntrySuccess();

    		return $this->redirect(['/admin/events']);
    	}

    	return $this->render($this->createTemplate, array(
    		'eventModel' => $eventModel
    	));
    }

    public function actionView()
    {
    	$eventId = $this->getEvent();

    	$event = Event::findOne($eventId);
    	
    	return $this->render($this->viewTemplate, array(
        	'event' => $event
        ));
    }

    public function actionEdit()
    {
    	$event = $this->getEvent();

    	if ($this->onPost($event)) {

    		$this->setFlashEntrySuccess();

    		return $this->redirect(['/admin/events']);
    	}

    	return $this->render($this->editTemplate, array(
        	'event' => $event
        ));
    }

    public function actionDelete()
    {
        $event = $this->getEvent();

        $activeEvents = RegistrationEvent::findAll(['event_id' => $event->id]);

        if (!empty($activeEvents)) {
            $this->setFlashEntryNotify(sprintf('Event %s cannot be deleted due to this event still active.', $event->name));
            return $this->redirect(['/admin/events']);
        }
        else {
            $this->setFlashEntrySuccess();
            $event->delete();
        }

        return $this->redirect($this->getAppReferrer() ?: 'admin/events');

    }
    
    protected function getEvent()
    {
    	return Event::findOne($this->getAppRequest()->getQueryParam('eventId'));
    }
}
