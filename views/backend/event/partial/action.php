<?php 
	# Check if isViewButtonVisible is defined
	$isViewButtonVisible = $isViewButtonVisible ?? false;
?>

<?php if ($isViewButtonVisible) : ?>

	<a href="<?= sprintf('/admin/events/%d/view', $model->id) ?>" class="btn btn-outline-primary btn-sm">View</a>
	
<?php endif; ?>

<a href="<?= sprintf('/admin/events/%d/edit', $model->id) ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
<a href="<?= sprintf('/admin/events/%d/delete', $model->id) ?>" class="btn btn-outline-danger btn-sm">Delete</a>

<?php if (isset($eventStatuses) && !empty($eventStatuses)) : ?>

	<?php if ($eventStatuses[$model->is_published] == 'Published') : ?>

		<a 
			href="<?= sprintf('/admin/events/%s/unpublish', $model->id) ?>" 
			class="btn btn-outline-dark btn-sm"
		>Unpublish</a>

	<?php else : ?>

		<a 
			href="<?= sprintf('/admin/events/%s/publish', $model->id) ?>"
			class="btn btn-outline-success btn-sm"
		>Publish</a>

	<?php endif; ?>

<?php endif; ?>