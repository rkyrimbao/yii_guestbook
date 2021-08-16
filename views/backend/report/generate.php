<?php 

// use yii\widgets\LinkPager; 
use yii\bootstrap4\LinkPager;

$rowsPerPage30 = 30;
$rowsPerPage60 = 60;
$rowsPerPage90 = 90;

$baseUrl = sprintf('/admin/reports/event-%s/generate', $event->id);

?>

<div class="row justify-content-center">
	<div class="col-8"><h1><?= $event->name ?>  Reports</h1></div>
	<div class="col-2 text-right">
		<div class="btn-group">
			<button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Switch Events
			</button>
				<div class="dropdown-menu">
					<?php foreach ($events as $iEvent) : ?>
						<a 
							class="dropdown-item" 
							href="<?= sprintf('/admin/reports/event-%s/generate', $iEvent->id) ?>"><?= $iEvent->name ?></a>
					<?php endforeach; ?>
				</div>
		</div>
	</div>
	<div class="col-2 text-right">
		<a href="<?= sprintf('/admin/reports/export-to-excel?event-id=%s&page=%s&per-page=%s', $event->id, $page, $rowsPerPage) ?>" class="btn btn-outline-secondary">Export to Excel</a>
	</div>
</div>

<hr>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
  	Show :&nbsp;
    <a 
    	href="<?= sprintf('%s?page=%s&per-page=%s', $baseUrl, $page, $rowsPerPage30) ?>" 
    	<?php if ($rowsPerPage == $rowsPerPage30) : ?>
    		class="btn btn-sm btn-outline-success active"
    	<?php else: ?>
    		class="btn btn-sm btn-outline-success"
    	<?php endif; ?>
    >30</a>&nbsp;

    <a 
    	href="<?= sprintf('%s?page=%s&per-page=%s', $baseUrl, $page, $rowsPerPage60) ?>" 
    	<?php if ($rowsPerPage == $rowsPerPage60) : ?>
    		class="btn btn-sm btn-outline-success active"
    	<?php else: ?>
    		class="btn btn-sm btn-outline-success"
    	<?php endif; ?>
    >60</a>&nbsp;

    <a 
    	href="<?= sprintf('%s?page=%s&per-page=%s', $baseUrl, $page, $rowsPerPage90) ?>" 
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
			<th scope="col">Guest ID</th>
			<th scope="col">Name</th>
			<th scope="col">Address</th>
			<th scope="col">Email</th>
			<th scope="col">Contact #</th>
			<!-- <th>List of Guests</th> -->
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($guests)) : ?>
			<?php foreach ($guests as $key => $guest) : ?>
				<tr>
					<td><?= $key + 1 ?></td>
					<td><?= $guest->id ?></td>
					<td><?= sprintf('%s, %s', $guest->last_name, $guest->first_name) ?></td>
					<td><?= sprintf('%s, %s, %s %s', $guest->street, $guest->city, $guest->country, $guest->zipcode) ?></td>
					<td><?= $guest->email_address ?></td>
					<td><?= $guest->phone_number ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr><td colspan="6">No participating guests.</td></tr>
		<?php endif; ?>
	</tbody>
</table>

<nav aria-label="Page navigation example">
	<?= LinkPager::widget([
		'pagination' => $pagination
	]) ?>
</nav>

<?php
	$this->registerJsFile("@web/js/plugins/popper.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
?>