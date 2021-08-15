<?php

namespace app\controllers\backend;

use app\models\Event;

use app\controllers\backend\BaseController;

class ReportController extends BaseController
{
	public function actionIndex()
    {	
    	$events = Event::find()
    		->joinWith('registrationEvents')
    		// ->innerJoinWith('registrationEvents')
			->all();    	

        return $this->render('index', array(
        	'events' => $events
        ));

    }
}