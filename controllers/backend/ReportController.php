<?php

namespace app\controllers\backend;

use app\models\Event;
use app\controllers\backend\BaseController;
use yii\data\Pagination;

class ReportController extends BaseController
{
	public function actionIndex()
    {	
    	$page = $this->getAppRequest()->getQueryParam('page', 1);
    	$rowsPerPage = $this->getAppRequest()->getQueryParam('per-page', 30);

    	$query = Event::find()
    		->joinWith('registrationEvents')
    		->innerJoinWith('registrationEvents') # Get events with guests only
    		->groupBy(['id']);
    		
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

    public function actionExporttoxcel()
    {
        $page = $this->getAppRequest()->getQueryParam('page', 1);
        $rowsPerPage = $this->getAppRequest()->getQueryParam('per-page', 30);

        $query = Event::find()
            ->joinWith('registrationEvents')
            ->innerJoinWith('registrationEvents') # Get events with guests only
            ->groupBy(['id']);
            
        $countQuery = clone $query;

        $pagination = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => $rowsPerPage,
            'route' => 'admin/reports'
        ]);

        $events = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $excelData = array();

        foreach ($events as $row => $event) {
            $paricipatingGuestsInEvent = $event->registrationEvents;
            $excelData[$event->id][] = $event->name;

            $guests = array();
            foreach($paricipatingGuestsInEvent as $paricipatingGuestInEvent) {
                $guest = $paricipatingGuestInEvent->registration;
                $guests[] = sprintf('%s, %s', $guest->last_name, $guest->first_name);
            }
            $excelData[$event->id][] = implode("\n", $guests);
        }
        
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Event Reports' => [
                    'data' =>$excelData,
                    'titles' => [
                        'Event',
                        'List of Guests'
                    ],
                ]
            ]
        ]);

        $file->send('event-reports.xlsx');
    }
}