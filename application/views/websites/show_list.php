<div>

	<?php echo $this->session->flashdata("alert"); ?>

	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Domain Name</td>
				<td>URL</td>
				<td>Recepients</td>
				<td>Access Link</td>
			</tr>
		
		</thead>
		<tbody>
			<?php  foreach($items->result() as $item) : ?> 

			<tr>
				<td> <?php echo $item->id ?> </td>
				<td> <?php echo $item->domain_name ?> </td>
				<td> <?php echo $item->url ?> </td>
				<td> <?php echo $item->recepients ?> </td>
				<td> <?php echo site_url("requests/send/" . $item->token_key) ?> </td>
				<td> <?php echo anchor("websites/edit/" . $item->token_key, "Edit" ) ?> </td>
				<td> <?php echo anchor("websites/delete/" . $item->token_key, "Remove" ) ?> </td>
			</tr> 

			<?php endforeach; ?>
		</tbody>

	</table>

</div>