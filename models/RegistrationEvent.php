<?php

namespace app\models;

use app\models\BaseRegistrationEvent;

class RegistrationEvent extends BaseRegistrationEvent
{
    public function rules()
    {
        $rules = parent::rules();

        return array_merge($rules, [
        	//your additional rules here
        ]);
    }
}
