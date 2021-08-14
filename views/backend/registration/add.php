<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\VarDumper;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

	$this->title = 'Add Guest';
?>

<?php $form = ActiveForm::begin(['id' => 'guest-form', 'options' => ['autocomplete' => 'off']]); ?>

<div class="row justify-content-center">
	<h1>Add Guest</h1>
</div>

<div class="row">
	<div class="col-8">
		<h4>Guest Details</h4>		
		<?= 
			\Yii::$app->view->renderFile('@app/views/backend/registration/partial/form_field_guest.php', array(
				'form' => $form,
				'guest' => $guest
			));
		?>
	</div>
	<div class="col-4">
		<h4>Event Details</h4>
		<?= 
			\Yii::$app->view->renderFile('@app/views/backend/registration/partial/form_field_events.php', array(
				'events' => $events,
				'eventOptions' => $eventOptions
			));
		?>
	</div>
</div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block']) ?>
</div>
<?php ActiveForm::end(); ?>