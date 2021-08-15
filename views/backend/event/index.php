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
			<th scope="col">Status</th>
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
				<?php if ($event->status == \Yii::$app->params['STATUS_PUBLISHED']) : ?>
					Published
				<?php else : ?>
					Unpublish
				<?php endif; ?>
			</td>
			<td>
				<?= 
					\Yii::$app->view->renderFile('@app/views/backend/event/partial/action.php', array(
						'isViewButtonVisible' => true,
						'model' => $event
					));
				?>

				<?php if ($event->status == \Yii::$app->params['STATUS_PUBLISHED']) : ?>
					<a 
						href="<?= sprintf('/admin/events/%s/unpublish', $event->id) ?>" 
						class="btn btn-outline-dark btn-sm"
					>Unpublish</button>
				<?php else : ?>
					<a 
						href="<?= sprintf('/admin/events/%s/publish', $event->id) ?>"
						class="btn btn-outline-success btn-sm"
					>Publish</button>
				<?php endif; ?>

			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>