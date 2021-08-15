<?php 

// use yii\widgets\LinkPager; 
use yii\bootstrap4\LinkPager;

$rowsPerPage30 = 30;
$rowsPerPage60 = 60;
$rowsPerPage90 = 90;

?>

<div class="row justify-content-center">
	<div class="col-6"><h1>Reports</h1></div>
	<div class="col-6 text-right">
		<a href="<?= sprintf('/admin/reports/export-to-excel?page=%s&per-page=%s', $page, $rowsPerPage) ?>" class="btn btn-primary">Export to Excel</a>
	</div>
</div>

<hr>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
  	Show :&nbsp;
    <a 
    	href="<?= sprintf('/admin/reports?page=%s&per-page=%s', $page, $rowsPerPage30) ?>" 
    	<?php if ($rowsPerPage == $rowsPerPage30) : ?>
    		class="btn btn-sm btn-outline-success active"
    	<?php else: ?>
    		class="btn btn-sm btn-outline-success"
    	<?php endif; ?>
    >30</a>&nbsp;

    <a 
    	href="<?= sprintf('/admin/reports?page=%s&per-page=%s', $page, $rowsPerPage60) ?>" 
    	<?php if ($rowsPerPage == $rowsPerPage60) : ?>
    		class="btn btn-sm btn-outline-success active"
    	<?php else: ?>
    		class="btn btn-sm btn-outline-success"
    	<?php endif; ?>
    >60</a>&nbsp;

    <a 
    	href="<?= sprintf('/admin/reports?page=%s&per-page=%s', $page, $rowsPerPage90) ?>" 
    	<?php if ($rowsPerPage == $rowsPerPage90) : ?>
    		class="btn btn-sm btn-outline-success active"
    	<?php else: ?>
    		class="btn btn-sm btn-outline-success"
    	<?php endif; ?>
    >90</a>
  </form>
</nav>

<br>

<table class="table table-hover table-bordered">
	<caption>List of Events</caption>
	<thead class="thead-light">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Event Name</th>
			<th>List of Guests</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($events as $event) : ?>
			<tr>
				<td><?= $event->id ?></td>
				<td class="justify-content-between align-items-cente">
					<?= $event->name ?>
					<span class="badge badge-primary badge-pill float-right"><?= count($event->registrationEvents) ?></span>
				</td>
				<td>
					<?php 

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

					?>
				</td>
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