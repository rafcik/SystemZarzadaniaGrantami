<?php
	require_once('tabs_layout.php');
?>
<br>
<br>
<br>

<input id="newEvent" style="position: relative; left: calc(100% - 190px);" type="submit" value="Dodaj wydarzenie" onclick="$('#dialog').dialog('open');" />
	
<div id="dialog" title="Dodaj wydarzenie">
	<form id="add_event_form" method="post" action="<?php echo base_url() . 'grant/'; ?>add_event">
		<input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
		
		<label  for="eventDate">Data wydarzenia</label>
        <div>
            <input id="eventDate" name="eventDate" type="date" value="<?php echo date('Y-m-d');?>" required="To pole jest obowiążkowe"/>
        </div>
		
		<label class="opis" for="opis">Opis </label>
        <div>
            <textarea id="opis" name="opis"  maxlength="500" value="" style="width: 350px; height: 100px;" > </textarea>
        </div>
		
		<input type="submit" value="Dodaj wydarzenie" />
	</form>
</div>

<script>
	$(function() {
		$("#dialog" ).dialog({
			autoOpen: false,
			height: 300,
			width: 400
		});
	});
</script>

<?php
	echo $calendar;
?>