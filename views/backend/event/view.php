<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = sprintf('Viewing %s', $event->name);

?>


<div class="row justify-content-center">
	<div class="col-8"><h1>Viewing Event</h1></div>
	<div class="col-4 text-right">
		<?= 
			\Yii::$app->view->renderFile('@app/views/backend/event/partial/action.php', array(
				'model' => $event
			));
		?>
	</div>
</div>

<hr>

<div class="row justify-content-center">
	<div class="col-7">
		<ul class="list-group">
			<li class="list-group-item list-group-item-primary"><?= $event->name ?></li>
			<li class="list-group-item"><?= $event->location ?></li>
			<li class="list-group-item"><?= date("F j, Y", strtotime($event->event_date)); ?></li>
			<li class="list-group-item"><?= $event->time ?></li>
		</ul>
	</div>

	<div class="col-5">
		<ul class="list-group">
			<li class="list-group-item list-group-item-primary">Guests</li>
			<?php foreach ($participatingGuests as $participatingGuest) : ?>
				<li class="list-group-item">
					<a 
						href="<?= sprintf('/admin/guests/%s/view', $participatingGuest->registration->id) ?>"
					><?= $participatingGuest->registration->first_name .' '. $participatingGuest->registration->last_name ?></a>

					<div class="row justify-content-center">
						<div class="col text-right">
							<small>
								<a href="<?= sprintf('/admin/guests/%s/view', $participatingGuest->registration->id) ?>" class="btn btn-outline-primary btn-sm">View</a>
								<a href="<?= sprintf('/admin/registration-events/%d/delete-event-guest', $participatingGuest->id) ?>" class="btn btn-outline-danger btn-sm">Delete</a>
							</small>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>