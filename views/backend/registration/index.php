
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
				<p><strong><?= ucwords(strtolower($guest->first_name. ' '. $guest->last_name)) ?></strong></p>
				<small><i>
					<?= sprintf('%s, %s, %s %s', $guest->street, $guest->city, $guest->country, $guest->zipcode) ?><br>
					<?= $guest->email_address ?><br>
					<?= $guest->phone_number ?>
				</i></small>
			</td>
			<td><?= $guest->gender ?></td>
			<td class="text-right">
				<?=
					\Yii::$app->view->renderFile('@app/views/backend/registration/partial/action.php', array(
						'model' => $guest,
						'isViewButtonVisible' => true
					));
				?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>