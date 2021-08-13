<?php

namespace app\controllers\backend;

use app\controllers\backend\BaseController;

class DashboardController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
