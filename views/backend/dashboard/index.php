
<?php
	/* @var $this \yii\web\View */
	/* @var $content string */
	use yii\bootstrap4\Nav;
	use yii\bootstrap4\NavBar;

	$this->title = 'Admin';
	$this->registerCssFile('@web/css/plugins/typeahead.css', ['position' => \yii\web\View::POS_HEAD]);
?>

<div class="row justify-content-left">
	<div class="col">
		<h1>Guests and Events Management</h1>
		<input id="suggestivesearch" type="text" class="form-control" placeholder="Search for a guest" class="white bordered" autocomplete="off" />
	</div>
</div>
<br>
<div class="row justify-content-center">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Events</h5>
				<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<div class="text-right">
					<a href="/admin/events" class="btn btn-outline-primary btn-sm">Manage Events</a>
					<a href="/admin/events/create" class="btn btn-outline-secondary btn-sm">Add Event</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Guests</h5>
				<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<div class="text-right">
					<a href="/admin/guests" class="btn btn-outline-primary">Manage Guests</a>
					<a href="/admin/guests/add" class="btn btn-outline-secondary">Add Guest</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Reports</h5>
				<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<div class="text-right">
					<div class="btn-group">
						<button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Generate Report
						</button>
							<div class="dropdown-menu">
								<?php if (!empty($events)) : ?>

									<?php foreach ($events as $iEvent) : ?>
										<a 
											class="dropdown-item" 
											href="<?= sprintf('/admin/reports/event-%s/generate', $iEvent->id) ?>"
										><?= $iEvent->name ?></a>
									<?php endforeach; ?>

								<?php else : ?>

									<a href="#" class="dropdown-item">No events to generate</a>
									
								<?php endif; ?>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$this->registerJsFile("@web/js/plugins/popper.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);
	$this->registerJsFile("@web/js/plugins/typeahead.js", ['depends' => [\yii\web\JqueryAsset::class]]);
	$this->registerJsFile("@web/js/backend/search_guest_widget.js", ['depends' => [\yii\web\JqueryAsset::class]]);


	$script = <<< JS

		var suggestedGuestConfig = {
			searchSuggestions: $searchSuggestions,
			searchAllUrl: 'javascript:void(0)'
		};

	    SearchGuestWidget.init({
	    	suggestedGuestConfig: suggestedGuestConfig
	    });
JS;
$this->registerJs($script);
?>