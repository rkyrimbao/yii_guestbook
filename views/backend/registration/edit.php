<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\VarDumper;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

	$this->title = 'Edit Guest';
?>

<?php $form = ActiveForm::begin(['id' => 'guest-form', 'action' => sprintf('/admin/guests/%d/edit', $guest->id), 'options' => ['autocomplete' => 'off']]); ?>

<div class="row justify-content-center">
	<h1>Edit Guest</h1>
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
		<?php if (!empty($events)) : ?>
			<?= 
				\Yii::$app->view->renderFile('@app/views/backend/registration/partial/form_field_events.php', array(
					'events' => $events,
					'eventOptions' => $eventOptions
				));
			?>
		<?php else: ?>
			No available events yet.
		<?php endif; ?>
	</div>
</div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block']) ?>
</div>
<?php ActiveForm::end(); ?>