<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\VarDumper;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

	$this->title = 'Guestbook Registration';
?>

<?php if (Yii::$app->session->hasFlash('entryConfirmed')): ?>
	<div class="alert alert-success" role="alert">
		Entry saved!
	</div>

<?php 
	#$form->errorSummary($registrationModel) 
	endif; 
?>

<?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>
<div class="row">
	<div class="col-8">
	
		<h1>Registration</h1>
			<div class="form-group">
				<?= 
					$form->field($registrationModel, 'first_name')
						->input('text', ['placeholder' => 'First Name', 'class' => 'form-control']) 
						->label(false)
				?>
				
				<?= 
					$form->field($registrationModel, 'last_name')
						->input('text', ['placeholder' => 'Last Name', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registrationModel, 'email_address')
						->input('email', ['placeholder' => 'Email Address', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registrationModel, 'phone_number')
						->input('text', ['placeholder' => 'Phone Number', 'class' => 'form-control']) 
						->label(false)
				?>

				<div class="row">
					<div class="col-md-4">
						<?= 
							$form->field($registrationModel, 'gender')
								->dropDownList(['1' => 'Male', '0' => 'Female'],['prompt'=>'Select Gender'])
								->label(false)
						?>
					</div>
				</div>

				<?= 
					$form->field($registrationModel, 'street')
						->input('text', ['placeholder' => 'Street', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registrationModel, 'city')
						->input('text', ['placeholder' => 'City', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registrationModel, 'country')
						->input('text', ['placeholder' => 'Country', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registrationModel, 'zip_code')
						->input('text', ['placeholder' => 'Zip Code', 'class' => 'form-control']) 
						->label(false)
				?>
			</div>
	</div>
	<div class="col-4">
		<h1>Events</h1>
	</div>
</div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block']) ?>
</div>
<?php ActiveForm::end(); ?>