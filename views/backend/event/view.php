<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = sprintf('Viewing %s', $event->name);

?>

<div class="row justify-content-center">
	<div class="col-6"><h1><?= sprintf('Viewing Event: %s', $event->name) ?></h1></div>
	<div class="col-6 text-right">
		<?= 
			\Yii::$app->view->renderFile('@app/views/backend/event/partial/action.php', array(
				'model' => $event
			));
		?>
	</div>
</div>
<br>
<table class="table">
	<caption>Event Details</caption>
	<thead>
		<tr>
			<th scope="col">Venue</th>
			<th scope="col">Date</th>
			<th scope="col">Time</th>
			<th scope="col">Status</th>
		</tr>
	</thead>
	<tbody>	
	<tr>
		<td><?= $event->location ?></td>
		<td><?= date("F j, Y", strtotime($event->event_date)); ?></td>
		<td><?= $event->time ?></td>
		<td>Active</td>
	</tr>
	</tbody>
</table>