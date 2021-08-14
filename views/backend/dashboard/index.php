
<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$this->title = 'Admin';
$this->registerCssFile('@web/css/plugins/typeahead.css', ['position' => \yii\web\View::POS_HEAD]);
?>

<h1>Welcome to Dashboard</h1>

<input id="suggestivesearch" type="text" class="form-control" placeholder="Search for a guest" class="white bordered" autocomplete="off" />

<?php

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