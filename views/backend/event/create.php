<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Create Event';
$this->registerCssFile('@web/css/plugins/tempusdominus-bootstrap-4.min.css', ['position' => \yii\web\View::POS_HEAD]);
?>

<?php if (Yii::$app->session->hasFlash('entryConfirmed')): ?>
	<div class="alert alert-success" role="alert">
		Entry saved!
	</div>
<?php endif; ?>

<div class="row justify-content-center">

	<div class="col-6">
		<h1>Create Event</h1>
		
		<?php $form = ActiveForm::begin(['id' => 'event-form', 'options' => ['autocomplete' => 'off']]); ?>	    
			<div class="form-group">
				<?= 
					$form
						->field($eventModel, 'name')
						->input('text', ['placeholder' => 'Event Name', 'class' => 'form-control']) 
						->label(false)
				?>

				<?= 
					$form
						->field($eventModel, 'location')
						->input('text', ['placeholder' => 'Event Location', 'class' => 'form-control'])
						->label(false)
				?>
				
				<?= 
					$form
						->field($eventModel, 'event_date')
						->input('text', [
							'placeholder' => 'Date of Event', 
							'class' => 'form-control datetimepicker-input', 
							'data-target' => '#datetimepicker5', 
							'data-toggle' => 'datetimepicker',
							'inputOptions' => ['autocomplete' => 'off']
						])
						->label(false)
				?>

				<?= 
					$form
						->field($eventModel, 'time')
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