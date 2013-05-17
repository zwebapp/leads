<?php echo form_open('requests/send/358c477c823cc5495cce89a276f622fc09927afc'); ?>

<?php echo form_label('Name', 'name') . form_input('name', ''); ?>
<br>
	
<?php echo form_label('Email', 'email') . form_input('email', ''); ?>
<br>

<?php echo form_label('Company', 'company') . form_input('company', ''); ?>
<br> 

<?php echo form_label('Your Message', 'message') . form_textarea('message', ''); ?>
<br>

<?php echo form_submit('submit', 'Submit'); ?>
<br>

<?php echo form_close(); ?>

