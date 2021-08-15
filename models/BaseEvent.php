<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property string $location
 * @property string $event_date
 * @property string $time
 * @property int|null $status
 *
 * @property RegistrationEvent[] $registrationEvents
 */
class BaseEvent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location', 'event_date', 'time'], 'required'],
            [['location'], 'string'],
            [['event_date'], 'safe'],
            [['status'], 'integer'],
            [['name', 'time'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'location' => 'Location',
            'event_date' => 'Event Date',
            'time' => 'Time',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[RegistrationEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrationEvents()
    {
        return $this->hasMany(RegistrationEvent::className(), ['event_id' => 'id']);
    }
}
