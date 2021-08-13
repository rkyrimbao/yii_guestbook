<?php

namespace app\controllers\backend;

use app\controllers\backend\BaseController;

class ReportController extends BaseController
{
	public function actionIndex()
    {
        return $this->render('index');
    }
}