<?php

namespace app\models;

use yii\db\ActiveQuery;
use app\models\BaseRegistration;

/*
 * Created this to avoid getting override the added rules from the parent model
 * when updating the parent models
 */
class Registration extends BaseRegistration
{
	public function rules()
	{
		$rules = parent::rules();

		//your additional rules here
		return array_merge($rules, [
			['email_address', 'email'],
			['email_address', 'unique', 'message' => 'Email address already exists'],
		]);
	}
}