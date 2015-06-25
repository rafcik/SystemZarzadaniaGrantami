<?php
require_once('tabs_layout.php');
?>
<br />
<br />
<br />
<h3 id="tabName"></h3>

<form id="delete_form" method="post" action="<?php echo base_url() . 'grant/'; ?>delete_tab">
    <input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
    <input type="hidden" name="idZakladki" value="<?php echo $idZakladki; ?>" />
    <input type="submit" value="Usuń zakładkę" />
</form>

<input id="newWpis" type="submit" value="Dodaj wpis" onclick="$('#dialog').dialog('open');" />
	
<?php 
	foreach($wpisy as $wpis) {
		?>
			<div class="wpis">
				<div class="wpis_header">
					<?php 
						echo $wpis['user_name'] . ' ' . $wpis['data_wpisu'];
						
						if($wpis['user_id'] == $logged_in['id']) {
							?>
								<form method="post" action="<?php echo base_url() . 'grant/'; ?>delete_wpis">
								    <input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
									<input type="hidden" name="idZakladki" value="<?php echo $idZakladki; ?>" />
									<input type="hidden" name="wpisId" value="<?php echo $wpis['wpis_id']; ?>" />
									<input type="submit" value="Usuń wpis" />
								</form>
							<?php
						}
					?>
				</div>
				<div class="wpis_content">
					<?php 
						echo $wpis['wpis'];
					?>
				</div>
			</div>
		<?php
    }
?>

<div id="dialog" title="Dodaj wpis">
	<form id="add_wpis_form" method="post" action="<?php echo base_url() . 'grant/'; ?>add_wpis">
		<input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
		<input type="hidden" name="idZakladki" value="<?php echo $idZakladki; ?>" />
		
		<label class="wpis" for="wpis">Wpis </label>
        <div>
            <textarea id="wpis" name="wpis"  maxlength="500" value="" style="width: 350px; height: 100px;" > </textarea>
        </div>
		
		<input type="submit" value="Dodaj wpis" />
	</form>
</div>

<script>
	$(function() {
		$("#dialog" ).dialog({
			autoOpen: false,
			height: 250,
			width: 400
		});
	});
</script>