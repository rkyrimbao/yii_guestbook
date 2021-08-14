<?php if (Yii::$app->session->hasFlash('entryNotify')) : ?>
	<div class="alert alert-info" role="alert">
		<?= Yii::$app->session->getFlash('entryNotify') ?>
	</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('entrySuccess')) : ?>
	<div class="alert alert-success" role="success">
		<?= Yii::$app->session->getFlash('entrySuccess') ?>
	</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('entryFail')) : ?>
	<div class="alert alert-danger" role="danger">
		<?= Yii::$app->session->getFlash('entryFail') ?>
	</div>
<?php endif; ?>