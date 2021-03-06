<div class="row justify-content-center">
	<div class="col-6"><h1>Events</h1></div>
	<div class="col-6 text-right">
		<a href="/admin/events/create" class="btn btn-primary">Create Event</a>
	</div>
</div>

<hr>

<table class="table">
	<caption>List of Events</caption>
	<thead class="thead-light">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Event Name</th>
			<th scope="col">Venue</th>
			<th scope="col">Date</th>
			<th scope="col">Time</th>
			<th scope="col">Status</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($events as $key => $event): ?>

		<?php $eventStatuses = $event->getStatusChoices(); ?>
		<tr>
			<th scope="row"><?= $event->id ?></th>
			<td><?= $event->name ?></td>
			<td><?= $event->location ?></td>
			<td><?= date("F j, Y", strtotime($event->event_date)); ?></td>
			<td><?= $event->time ?></td>
			<td><?= $eventStatuses[$event->is_published] ?></td>
			<td>
				<?= 
					\Yii::$app->view->renderFile('@app/views/backend/event/partial/action.php', array(
						'isViewButtonVisible' => true,
						'model' => $event,
						'eventStatuses' => $eventStatuses
					));
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>