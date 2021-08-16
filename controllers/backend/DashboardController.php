<?php

namespace app\controllers\backend;

use app\controllers\backend\BaseController;
use app\models\Event;
use app\models\Registration;
use yii\helpers\Json;
use yii\helpers\Url;

class DashboardController extends BaseController
{
	protected $indexTemplate = 'index';

    public function actionIndex()
    {
    	$guests = Registration::find()->all();

    	$searchSuggestions = array();

    	foreach ($guests as $guest) {
    		$searchSuggestions[] = array(
    			'guestId' => $guest->id,
    			'name' => ucwords(strtolower($guest->first_name.' '.$guest->last_name)),
    			'url' => sprintf('%s/admin/guests/%d/view', Url::base(true), $guest->id)
    		);
    	}

    	$suggestions['suggestions'] = $searchSuggestions;
    	
        $events = Event::find()
            // ->where(['is_published' => Event::STATUS_PUBLISHED])
            ->all();

        return $this->render($this->indexTemplate, array(
        	'searchSuggestions' => Json::encode($suggestions),
            'events' => $events
        ));
    }
}
