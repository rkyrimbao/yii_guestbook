<div class="form-group">
	<?= 
		$form->field($guest, 'first_name')
			->input('text', ['placeholder' => 'First Name', 'class' => 'form-control']) 
			->label(false)
	?>
	
	<?= 
		$form->field($guest, 'last_name')
			->input('text', ['placeholder' => 'Last Name', 'class' => 'form-control']) 
			->label(false)
	?>

	<?= 
		$form->field($guest, 'email_address')
			->input('email', ['placeholder' => 'Email Address', 'class' => 'form-control']) 
			->label(false)
	?>

	<?= 
		$form->field($guest, 'phone_number')
			->input('text', ['placeholder' => 'Phone Number', 'class' => 'form-control']) 
			->label(false)
	?>

	<div class="row">
		<div class="col-md-4">
			<?= 
				$form->field($guest, 'gender')
					->dropDownList(['Male' => 'Male', 'Female' => 'Female'],['prompt'=>'Select Gender'])
					->label(false)
			?>
		</div>
	</div>

	<?= 
		$form->field($guest, 'street')
			->input('text', ['placeholder' => 'Street', 'class' => 'form-control']) 
			->label(false)
	?>

	<?= 
		$form->field($guest, 'city')
			->input('text', ['placeholder' => 'City', 'class' => 'form-control']) 
			->label(false)
	?>

	<?= 
		$form->field($guest, 'country')
			->input('text', ['placeholder' => 'Country', 'class' => 'form-control']) 
			->label(false)
	?>

	<?= 
		$form->field($guest, 'zipcode')
			->input('text', ['placeholder' => 'Zip Code', 'class' => 'form-control'])
			->label(false)
	?>
</div>