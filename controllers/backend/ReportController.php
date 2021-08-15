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
}