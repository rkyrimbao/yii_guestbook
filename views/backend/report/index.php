<?php 

// use yii\widgets\LinkPager; 
use yii\bootstrap4\LinkPager;

?>

<div class="row justify-content-center">
	<div class="col-6"><h1>Event Reports</h1></div>
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
			<!-- <th>List of Guests</th> -->
		</tr>
	</thead>
	<tbody>
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
				<!-- <td> -->
					<!-- <?php 

						$paricipatingGuestsInEvent = $event->registrationEvents;

						if (!empty($paricipatingGuestsInEvent)) :
							foreach ($paricipatingGuestsInEvent as $paricipatingGuestInEvent) :


								$guest = $paricipatingGuestInEvent->registration;

					?>		
							<p><?= sprintf('%s, %s', $guest->last_name, $guest->first_name) ?></p>
								
					<?php 

							endforeach; 

						else :

							echo "No participating guests";

						endif;

					?> -->
				<!-- </td> -->
			</tr>
		<?php endforeach; ?>
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