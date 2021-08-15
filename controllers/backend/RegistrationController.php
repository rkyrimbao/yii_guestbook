<?php

namespace app\controllers\backend;

use app\models\Event;
use app\models\Registration;
use app\models\RegistrationEvent;

use app\controllers\backend\BaseController;

class RegistrationController extends BaseController
{
	protected $indexTemplate = 'index';
	protected $addTemplate = 'add';
	protected $editTemplate = 'edit';
    protected $viewTemplate = 'view';

    public function actionIndex()
    {
    	$guests = Registration::find()->orderBy([new \yii\db\Expression("id desc")])->all();

        return $this->render($this->indexTemplate, array(
        	'guests' => $guests
       	));
    }

    public function actionAdd()
    {
    	$events = Event::find()
            ->where(['is_published' => Event::STATUS_PUBLISHED])
            ->orderBy([new \yii\db\Expression("event_date asc")])
            ->all();
            
    	$eventOptions = array();

    	$guest = new Registration();

    	if ($guest->load($this->post())) {

    		$isFormValid = $guest->validate();

    		$postData = $this->post();

    		if (isset($postData['events'])) {
                $eventOptions = array_filter($postData['events']);
                $eventOptions = array_values($eventOptions);
            }

    		if ($isFormValid) {

    			$guest->save();

    			if (!empty($eventOptions)) {
    				
                    foreach ($eventOptions as $key => $eventId) {

                        $registrationEvent = new RegistrationEvent();

                        $registrationEvent->registration_id = $guest->id;

                        $registrationEvent->event_id = $eventId;

                        $registrationEvent->save();
                    }
                }

    			$this->setFlashEntrySuccess('Guest successfully created.');

    			return $this->redirect(['/admin/guests']);
    		}
    	}

    	return $this->render($this->addTemplate, array(
    		'guest' => $guest,
    		'events' => $events,
    		'eventOptions' => $eventOptions
    	));
    }

    public function actionEdit()
    {
    	$events = Event::find()
            ->where(['is_published' => Event::STATUS_PUBLISHED])
            ->orderBy([new \yii\db\Expression("event_date asc")])
            ->all();
    
    	$guest = $this->getGuest();

    	$registeredEvents = RegistrationEvent::find()
    		->where(['registration_id' => $guest->id])
    		->orderBy([new \yii\db\Expression("id desc")])
    		->all();

    	$eventOptions = array();

    	foreach ($registeredEvents as $registeredEvent) {
    		$eventOptions[] = $registeredEvent->event_id;
    	}

    	if ($guest->load($this->post())) {

    		$isFormValid = $guest->validate();

    		$postData = $this->post();

    		if (isset($postData['events'])) {
                $eventOptions = array_filter($postData['events']);
                $eventOptions = array_values($eventOptions);
            }

    		if ($isFormValid) {

    			$guest->save();

    			if (!empty($eventOptions)) {
			 		
			 		$baseQuery = RegistrationEvent::find()->where(['registration_id' => $guest->id]);

			 		$clonedQuery = clone $baseQuery;
    				$selectedRegisteredEvents = $clonedQuery
						->andWhere(['in', 'event_id',  $eventOptions])
						->orderBy([new \yii\db\Expression("id desc")])
						->all();

					foreach ($eventOptions as $key => $eventId) {
						$clonedQuery = clone $baseQuery;
						$existingRegisteredEvent = $clonedQuery
							->andWhere(['event_id' => $eventId])
							->one();

						if (is_null($existingRegisteredEvent)) {
							$newRegistrationEvent = new RegistrationEvent();
							$newRegistrationEvent->registration_id = $guest->id;
							$newRegistrationEvent->event_id = $eventId;
							$newRegistrationEvent->save();
						}
						else {
							$clonedQuery = clone $baseQuery;
							$unselectedRegisteredEvents = $clonedQuery
								->andWhere(['not in', 'event_id', $eventOptions])
								->all();

							if (count($unselectedRegisteredEvents) == 1) {
								$unselectedRegisteredEvent = reset($unselectedRegisteredEvents);
								$unselectedRegisteredEvent->delete();
							}
							else {
								foreach ($unselectedRegisteredEvents as $unselectedRegisteredEvent) {
									$unselectedRegisteredEvent->delete();
								}
							}
						}
					}
                }
				else {
					RegistrationEvent::deleteAll(['registration_id' => $guest->id]);
				}
				
    			$this->setFlashEntrySuccess('Guest successfully updated.');

    			return $this->redirect(['/admin/guests']);
    		}
    	}


    	return $this->render($this->editTemplate, array(
    		'guest' => $guest,
    		'events' => $events,
    		'eventOptions' => $eventOptions
    	));
    }

    public function actionDelete()
    {
        $guest = $this->getGuest();

        $selectedEvents = RegistrationEvent::findAll(['registration_id' => $guest->id]);

        if (!empty($selectedEvents)) {
            $this->setFlashEntryFail(sprintf('Failed to delete guest %s %s due to active participating events, delete the guest from event first', $guest->first_name, $guest->last_name));
        }
        else {
            $this->setFlashEntrySuccess('Guest successfully removed.');
            $guest->delete();
        }

        return $this->redirect($this->getAppReferrer() ?: '/admin/guests');
    }

    public function actionView()
    {
        $guest = $this->getGuest();

        if (is_null($guest)) {
            return $this->redirect('/admin/guests');
        }

        $selectedEvents = RegistrationEvent::findAll(['registration_id' => $guest->id]);
        
        return $this->render($this->viewTemplate, array(
            'guest' => $guest,
            'selectedEvents' => $selectedEvents
        ));
    }

    protected function getGuest()
    {
    	return Registration::findOne($this->getAppRequest()->getQueryParam('guestId'));
    }
}