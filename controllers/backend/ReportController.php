<?php

namespace app\controllers\backend;

use app\models\Event;
use app\models\Registration;
use app\controllers\backend\BaseController;
use yii\data\Pagination;

class ReportController extends BaseController
{
	public function actionIndex()
    {	
    	$page = $this->getAppRequest()->getQueryParam('page', 1);
    	$rowsPerPage = $this->getAppRequest()->getQueryParam('per-page', 30);

    	$query = $this->initEventQuery();
    		
		$countQuery = clone $query;

		$pagination = new Pagination([
			'totalCount' => $countQuery->count(),
			'pageSize' => $rowsPerPage,
			'route' => 'admin/reports'
		]);

		$events = $query->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

        return $this->render('index', array(
        	'page' => $page,
        	'events' => $events,
        	'pagination' => $pagination,
        	'rowsPerPage' => $rowsPerPage
        ));

    }

    public function actionGenerate()
    {
        $event = $this->getEvent();
        $page = $this->getAppRequest()->getQueryParam('page', 1);
        $rowsPerPage = $this->getAppRequest()->getQueryParam('per-page', 30);

        $query = $this->initRegistrationQuery();

        $countQuery = clone $query;

        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => $rowsPerPage,
            'route' => sprintf('/admin/reports/event-%s/generate', $event->id)
        ]);

        $guests = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $events = Event::find()
            // ->where(['is_published' => Event::STATUS_PUBLISHED])
            ->all();

        return $this->render('generate', array(
            'event' => $event,
            'events' => $events,
            'page' => $page,
            'guests' => $guests,
            'pagination' => $pagination,
            'rowsPerPage' => $rowsPerPage
        ));
    }

    public function actionExporttoxcel()
    {
        $event = $this->getEvent();
        $page = $this->getAppRequest()->getQueryParam('page', 1);
        $rowsPerPage = $this->getAppRequest()->getQueryParam('per-page', 30);

        $query = $this->initRegistrationQuery();
            
        $countQuery = clone $query;

        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => $rowsPerPage
        ]);

        $guests = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $excelData = array();

        foreach ($guests as $key => $guest) {
            $excelData[] = array(
                $key + 1,
                $guest->id,
                sprintf('%s, %s', $guest->last_name, $guest->first_name),
                sprintf('%s, %s, %s %s', $guest->street, $guest->city, $guest->country, $guest->zipcode),
                $guest->email_address,
                $guest->phone_number
            );
        }
        
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                $event->name => [
                    'data' =>$excelData,
                    'titles' => [
                        '#',
                        'Guest Id',
                        'Name',
                        'Address',
                        'Email',
                        'Contact #'
                    ],
                ]
            ]
        ]);

        $filename = $event->name . date('Ymd_hi').'.xlsx'; 

        $file->send($filename);
    }

    protected function getEvent()
    {
        return Event::findOne($this->getAppRequest()->getQueryParam('event-id'));
    }

    protected function initRegistrationQuery()
    {
        $event = $this->getEvent();

        if (!$event) {
            return $this->redirect(['/admins/reports']);
        }

        return Registration::find()
            ->joinWith('registrationEvents')
            ->where(['registration_event.event_id' => $event->id]);
    }

    protected function initEventQuery()
    {
        return Event::find()
            ->innerJoinWith('registrationEvents') # Get events with guests only
            ->groupBy(['id']);
    }
}