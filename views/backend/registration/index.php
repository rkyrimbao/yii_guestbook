
<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$this->title = 'Guests';

?>

<div class="row justify-content-center">
	<div class="col-6"><h1>Guests</h1></div>
	<div class="col-6 text-right">
		<a href="/admin/guests/add" class="btn btn-primary">Add Guest</a>
	</div>
</div>

<table class="table">
	<caption>List of Guests</caption>
	<thead class="thead-light">
		<tr>
			<th scope="col">Guest#</th>
			<th scope="col">Name</th>
			<th scope="col">Gender</th>
			<th scope="col">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($guests as $guest): ?>
		<tr>
			<th scope="row"><?= $guest->id ?></th>
			<td>
				<p><strong><?= $guest->first_name. ' '. $guest->last_name ?></strong></p>
				<small><i>
					<?= sprintf('%s, %s, %s %s', $guest->street, $guest->city, $guest->country, $guest->zipcode) ?><br>
					<?= $guest->email_address ?><br>
					<?= $guest->phone_number ?>
				</i></small>
			</td>
			<td><?= $guest->gender ?></td>
			<td>
				<a href="<?= sprintf('/admin/guests/%d/view', $guest->id) ?>" class="btn btn-outline-primary btn-sm">View</a>
				<a href="<?= sprintf('/admin/guests/%d/edit', $guest->id) ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
				<a href="<?= sprintf('/admin/guests/%d/delete', $guest->id) ?>" class="btn btn-outline-danger btn-sm">Delete</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>