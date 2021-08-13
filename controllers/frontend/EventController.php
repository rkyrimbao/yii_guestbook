<?php

namespace app\controllers\frontend;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
