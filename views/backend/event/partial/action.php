<?php 
	# Check if isViewButtonVisible is defined
	$isViewButtonVisible = $isViewButtonVisible ?? false; 
?>

<?php if ($isViewButtonVisible) : ?>
	<a href="<?= sprintf('/admin/events/%d/view', $model->id) ?>" class="btn btn-outline-primary btn-sm">View</a>
<?php endif; ?>

<a href="<?= sprintf('/admin/events/%d/edit', $model->id) ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
<a href="<?= sprintf('/admin/events/%d/delete', $model->id) ?>" class="btn btn-outline-danger btn-sm">Delete</a>