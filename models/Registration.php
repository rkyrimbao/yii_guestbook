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
 * @property int $zip_code
 *
 * @property RegistrationEvent[] $registrationEvents
 */
class Registration extends \yii\db\ActiveRecord
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
            [['first_name', 'last_name', 'email_address', 'gender', 'street', 'city', 'country', 'zip_code'], 'required'],
            [['street'], 'string'],
            [['zip_code'], 'integer'],
            [['first_name', 'last_name', 'email_address', 'phone_number', 'city', 'country'], 'string', 'max' => 45],
            ['email_address', 'email'],
            ['email_address', 'unique', 'message' => 'Email address already exists'],
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
            'zip_code' => 'Zip Code',
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
