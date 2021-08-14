<?php

namespace app\controllers\backend;

use app\models\Event;
use app\models\Registration;
use app\models\RegistrationEvent;

use app\controllers\backend\BaseController;

class RegistrationeventController extends BaseController
{
    public function actionIndex()
    {
         return $this->render('index');
    }

	public function actionDeleteguestevent()
    {
        $registeredEvent = $this->getRegistrationEvent();

        if (!is_null($registeredEvent)) {
            $this->setFlashEntrySuccess(sprintf('Event %s is successfully removed', $registeredEvent->event->name));
            $registeredEvent->delete();
        }
        else {
            $this->setFlashEntryNotify(sprintf('Failed to delete event %s', $registeredEvent->event->name));   
        }

        return $this->redirect($this->getAppReferrer() ?: '/admin');
    }

    public function actionDeleteeventguest()
    {
        $registeredEvent = $this->getRegistrationEvent();

        if (!is_null($registeredEvent)) {
            $this->setFlashEntrySuccess(sprintf('Event %s is successfully removed', $registeredEvent->event->name));
            $registeredEvent->delete();
        }
        else {
            $this->setFlashEntryNotify(sprintf('Failed to delete event %s', $registeredEvent->event->name));   
        }

        return $this->redirect($this->getAppReferrer() ?: '/admin');
    }

    public function getRegistrationEvent()
    {
        return RegistrationEvent::findOne($this->getAppRequest()->getQueryParam('id'));
    }
}