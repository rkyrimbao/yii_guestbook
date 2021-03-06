<?php 

// use yii\widgets\LinkPager; 
use yii\bootstrap4\LinkPager;

?>

<div class="row justify-content-center">
	<div class="col-6"><h1>Reports</h1></div>
	<div class="col-6 text-right">
		
	</div>
</div>

<hr>

<table class="table table-hover table-bordered">
	<caption>List of Events</caption>
	<thead class="thead-light">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Event Name</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($events)) : ?>

			<?php foreach ($events as $event) : ?>
				<tr>
					<td><?= $event->id ?></td>
					<td class="justify-content-between align-items-cente">
						<?= $event->name ?>
						<a href="<?= sprintf('/admin/reports/event-%s/generate', $event->id) ?>" class="float-right"> Generate Report
							<span class="badge badge-primary badge-pill">
								<?= count($event->registrationEvents) ?>
							</span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>

		<?php else : ?>

			<tr><td colspan="2">No events to generate</td></tr>

		<?php endif; ?>
	</tbody>
</table>

<nav aria-label="Page navigation example">
	<?= LinkPager::widget([
		'pagination' => $pagination,
		// 'lastPageLabel'=>'LAST',
		// 'firstPageLabel'=>'FIRST',
	 //    'prevPageLabel' => 'Prev',
	 //    'nextPageLabel' => 'Next',   
	]) ?>
</nav>