<?php

namespace app\models;

// use app\models\ReflectionClass;
use app\models\BaseEvent;

class Event extends BaseEvent
{
    const STATUS_UNPUBLISHED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {   
        $rules = parent::rules();

        return array_merge($rules, [
            //your additional rules here
        ]);
    }

    public function getStatusChoices()
    {
        return [
            self::STATUS_UNPUBLISHED => 'Unpublished',
            self::STATUS_PUBLISHED => 'Published'
        ];
    }

    public static function getConstants($token) {
        $tokenLen = strlen($token);

        $reflection = new \ReflectionClass(__CLASS__);
        $allConstants = $reflection->getConstants();

        $tokenConstants = array();

        foreach($allConstants as $name => $val) {
            if ( substr($name,0,$tokenLen) != $token ) continue;
            $tokenConstants[ $val ] = $val;
        }

        return $tokenConstants;
    }

    public static function getStatuses() {
        return self::getConstants('STATUS_',__CLASS__);
    }
}