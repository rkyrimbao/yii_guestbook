<div class="form-group">
	<?php foreach ($events as $key => $event) : ?>

		<div class="card">
			<div class="card-body">
				<div class="custom-control custom-checkbox">
					<input type="hidden" name="events[event<?= $event->id ?>]" value="0">
					<input 
						type="checkbox" 
						id="events<?= $event->id ?>" 
						class="custom-control-input" 
						name="events[event<?= $event->id ?>]" 
						value="<?= $event->id ?>"
						<?php if (!empty($eventOptions) && in_array($event->id, $eventOptions)) : ?>
							checked="checked"
						<?php endif; ?>
					>

					<label class="custom-control-label" for="events<?= $event->id ?>"><?= $event->name ?>
						<div class="invalid-feedback"></div>
						<div><?= $event->location ?></div>
						<div><?= date('F j, Y', strtotime($event->event_date)) ?></div>
						<div><?= $event->time ?></div>
					</label>
				</div>
			</div>
		</div>
		<br>
	<?php endforeach; ?>
</div>