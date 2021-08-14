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

<?php endif; ?>

<?php $form = ActiveForm::begin(['id' => 'registration-form', 'options' => ['autocomplete' => 'off']]); 
	// $form->errorSummary($registration);
	// var_dump($eventsData);
?>
<div class="row">
	<div class="col-8">
	
		<h1>Registration</h1>
			<div class="form-group">
				<?= 
					$form->field($registration, 'first_name')
						->input('text', ['placeholder' => 'First Name', 'class' => 'form-control']) 
						->label(false)
				?>
				
				<?= 
					$form->field($registration, 'last_name')
						->input('text', ['placeholder' => 'Last Name', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registration, 'email_address')
						->input('email', ['placeholder' => 'Email Address', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registration, 'phone_number')
						->input('text', ['placeholder' => 'Phone Number', 'class' => 'form-control']) 
						->label(false)
				?>

				<div class="row">
					<div class="col-md-4">
						<?= 
							$form->field($registration, 'gender')
								->dropDownList(['Male' => 'Male', 'Female' => 'Female'],['prompt'=>'Select Gender'])
								->label(false)
						?>
					</div>
				</div>

				<?= 
					$form->field($registration, 'street')
						->input('text', ['placeholder' => 'Street', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registration, 'city')
						->input('text', ['placeholder' => 'City', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registration, 'country')
						->input('text', ['placeholder' => 'Country', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form->field($registration, 'zipcode')
						->input('text', ['placeholder' => 'Zip Code', 'class' => 'form-control'])
						->label(false)
				?>
			</div>
	</div>
	<div class="col-4">
		<h1>Events</h1>
		<div class="form-group">
			<?php foreach ($events as $key => $event) : ?>
				<div class="card">
					<div class="card-body">
						<div class="custom-control custom-checkbox">
							<input type="hidden" name="events[event<?= $event->id ?>]" value="0">
							<input 
								type="checkbox" 
								id="events<?= $event->id ?>" 
								class="custom-control-input" 
								name="events[event<?= $event->id ?>]" 
								value="<?= $event->id ?>"
								<?php if (in_array($event->id, $eventsData)) : ?>
									checked="checked"
								<?php endif; ?>
							>

							<label class="custom-control-label" for="events<?= $event->id ?>"><?= $event->name ?>
								<div class="invalid-feedback"></div>
								<div><?= $event->location ?></div>
								<div><?= date('F j, Y', strtotime($event->event_date)) ?></div>
								<div><?= $event->time ?></div>
							</label>
						</div>
					</div>
				</div>
				<br>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block']) ?>
</div>
<?php ActiveForm::end(); ?>