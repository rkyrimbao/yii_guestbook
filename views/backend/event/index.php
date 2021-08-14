<div>
	<a href="/admin/events/create" class="btn btn-primary">Create Event</a>
</div>

<br>


<table class="table">
	<caption>List of Events</caption>
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Event Name</th>
			<th scope="col">Venue</th>
			<th scope="col">Date</th>
			<th scope="col">Time</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($events as $key => $event): ?>
		<tr>
			<th scope="row"><?= $event->id ?></th>
			<td><?= $event->name ?></td>
			<td><?= $event->location ?></td>
			<td><?= date("F j, Y", strtotime($event->event_date)); ?></td>
			<td><?= $event->time ?></td>
			<td>
				<?= 
					\Yii::$app->view->renderFile('@app/views/backend/event/partial/action.php', array(
						'isViewButtonVisible' => true,
						'model' => $event
					));
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>