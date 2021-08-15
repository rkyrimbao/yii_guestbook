<?php

namespace app\controllers\backend;

use app\controllers\backend\BaseController;
use app\models\Event;
use app\models\RegistrationEvent;

use yii\db\Query;
use yii\web\HttpException;

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
        	'events' => $events,
            'eventStatusChoices' => Event::getStatusChoices()
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
    	$event = $this->getEvent();

    	$participatingGuests = RegistrationEvent::findAll(['event_id' => $event]);

    	return $this->render($this->viewTemplate, array(
        	'event' => $event,
            'participatingGuests' => $participatingGuests
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
            $this->setFlashEntryNotify(sprintf('Event %s cannot be deleted, remove the participating guest first', $event->name));
            return $this->redirect(['/admin/events']);
        }
        else {
            $this->setFlashEntrySuccess('Event successfull removed.');
            $event->delete();
        }

        return $this->redirect($this->getAppReferrer() ?: 'admin/events');

    }
    
    public function actionPublish()
    {
        $event = $this->getEvent();

        try {

            $this->setFlashEntrySuccess('Event successfully published');

            $event->status = Event::STATUS_PUBLISHED;
            $event->save(false);

        }
        catch (\Exception $e) {
            throw new HttpException(405, 'Error saving model'); 
        }

        return $this->redirect($this->getAppReferrer() ?: 'admin/events');
    }

    public function actionUnpublish()
    {
        $event = $this->getEvent();

        try {

            $event->status = Event::STATUS_UNPUBLISHED;
            $event->save(false);

            $this->setFlashEntrySuccess('Event successfully unpublished');
        }
        catch (\Exception $e) {
            throw new HttpException(405, 'Error saving model');
        }


        return $this->redirect($this->getAppReferrer() ?: 'admin/events');
    }

    protected function getEvent()
    {
    	return Event::findOne($this->getAppRequest()->getQueryParam('eventId'));
    }
}
