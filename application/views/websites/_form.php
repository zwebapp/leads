<?php echo form_label("Domain Name: <br/> ") .  form_input("domain_name", isset($item) ? $item->row()->domain_name : ""); ?><br />

<?php echo form_label("URL: <br/> ") . form_input("url", isset($item) ? $item->row()->url : ""); ?>	<br />

<?php echo form_label("Recepients: <br/> ") . form_input("recepients", isset($item) ? $item->row()->recepients : ""); ?>	<br />

<?php echo form_label("Google Adwords Key: <br/> ") . form_input("adword_id", isset($item) ? $item->row()->adword_id : ""); ?>	<br />

<?php echo form_label("Redirection URL: <br/> ") . form_input("redirection_url", isset($item) ? $item->row()->redirection_url : ""); ?>	<br />

<?php echo form_label("Custom Message: <br/> ") . form_textarea("custom_message", isset($item) ? $item->row()->custom_message : ""); ?>	<br />

<?php echo form_label("Custom Layout: <br/> ") . form_textarea("custom_layout", isset($item) ? $item->row()->custom_layout : ""); ?>	<br />

<?php echo form_submit("submit", "Submit Entry") ?>