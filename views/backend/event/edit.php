<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Edit Event';
$this->registerCssFile('@web/css/plugins/tempusdominus-bootstrap-4.min.css', ['position' => \yii\web\View::POS_HEAD]);
?>

<?php if (Yii::$app->session->hasFlash('entryConfirmed')): ?>
	<div class="alert alert-success" role="alert">
		Entry saved!
	</div>
<?php endif; ?>

<div class="row justify-content-center">

	<div class="col-6">
		<h1>Edit Event</h1>
		<!-- ['admin/events/edit', 'eventId' => $event->id] -->
		<?php $form = ActiveForm::begin(['id' => 'registration-form', 'action' => sprintf('/admin/events/%d/edit', $event->id),'options' => ['autocomplete' => 'off']]); ?>	    
			<div class="form-group">
				<?= 
					$form
						->field($event, 'name')
						->input('text', ['placeholder' => 'Event Name', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form
						->field($event, 'location')
						->input('text', ['placeholder' => 'Event Location', 'class' => 'form-control'])
						->label(false)
				?>
				
				<?= 
					$form
						->field($event, 'event_date')
						->input('text', [
							'placeholder' => 'Date of Event', 
							'class' => 'form-control datetimepicker-input', 
							'data-target' => '#datetimepicker5', 
							'data-toggle' => 'datetimepicker',
							// 'value' => date('d.m.Y', strtotime($event->event_date)),
							'inputOptions' => ['autocomplete' => 'off']
						])
						->label(false)
				?>

				<?= 
					$form
						->field($event, 'time')
						->input('text', [
								'placeholder' => 'Time of Event', 
								'class' => 'form-control datetimepicker-input', 
								'data-target' => '#datetimepicker3', 
								'data-toggle' => 'datetimepicker',
								'inputOptions' => ['autocomplete' => 'off']
							])
						->label(false)
				?>

				<?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<?php
	$this->registerJsFile("@web/js/plugins/moment.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
	$this->registerJsFile("@web/js/plugins/tempusdominus-bootstrap-4.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
	$this->registerJsFile("@web/js/backend/event_create_page.js",[
		'depends' => [\yii\web\JqueryAsset::class],
		// 'position' => [\yii\web\View::POS_LOAD]
	]);
?>