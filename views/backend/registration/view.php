<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = sprintf('Viewing Guest: %s', sprintf('%s %s', $guest->first_name, $guest->last_name));

?>

<div class="row justify-content-center">
	<div class="col-8"><h1>View Guest Record</h1></div>
	<div class="col-4 text-right">
		<?= 
			\Yii::$app->view->renderFile('@app/views/backend/registration/partial/action.php', array(
				'model' => $guest
			));
		?>
	</div>
</div>

<hr>

<div class="row justify-content-center">
	<div class="col-7">
		<ul class="list-group">
			<li class="list-group-item list-group-item-primary">Personal Record</li>
			<li class="list-group-item"><?= sprintf('%s, %s', $guest->last_name, $guest->first_name) ?></li>
			<li class="list-group-item"><?= sprintf('%s, %s, %s %s', $guest->street, $guest->city, $guest->country, $guest->zipcode) ?></li>
			<li class="list-group-item"><?= $guest->phone_number ?></li>
			<li class="list-group-item"><?= $guest->email_address ?></li>
		</ul>
	</div>

	<div class="col-5">
		<ul class="list-group">
			<li class="list-group-item list-group-item-primary">Participating Events</li>

			<?php if (!empty($selectedEvents)) : ?>

				<?php foreach ($selectedEvents as $selectedEvent) : ?>
					<li class="list-group-item">
						<strong><?= $selectedEvent->event->name ?></strong></p>
						<p>
							<small>
								<?= $selectedEvent->event->location ?>,
								<?= date('F j, Y', strtotime($selectedEvent->event->event_date)) ?>,
								<?= $selectedEvent->event->time ?>
							</small>
						</p>
						<div class="row justify-content-center">
							<div class="col text-right">
								<small>
									<a href="<?= sprintf('/admin/registration-events/%d/delete-guest-event', $selectedEvent->id) ?>" class="btn btn-outline-danger btn-sm">Delete</a>
								</small>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li class="list-group-item">No Participating Event.</li>
			<?php endif; ?>
		</ul>
	</div>
</div>