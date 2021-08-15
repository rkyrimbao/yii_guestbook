<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string|null $phone_number
 * @property string $gender
 * @property string $street
 * @property string $city
 * @property string $country
 * @property int $zipcode
 *
 * @property RegistrationEvent[] $registrationEvents
 */
class BaseRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email_address', 'gender', 'street', 'city', 'country', 'zipcode'], 'required'],
            [['street'], 'string'],
            [['zipcode'], 'integer'],
            [['first_name', 'last_name', 'email_address', 'phone_number', 'city', 'country'], 'string', 'max' => 45],
            [['gender'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_address' => 'Email Address',
            'phone_number' => 'Phone Number',
            'gender' => 'Gender',
            'street' => 'Street',
            'city' => 'City',
            'country' => 'Country',
            'zipcode' => 'Zipcode',
        ];
    }

    /**
     * Gets query for [[RegistrationEvents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrationEvents()
    {
        return $this->hasMany(RegistrationEvent::className(), ['registration_id' => 'id']);
    }
}
