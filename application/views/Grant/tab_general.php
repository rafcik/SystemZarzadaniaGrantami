<?php
    require_once('tabs_layout.php');
?>
<h3 id="tabName">Ogólne</h3>

<h1><?php echo $Grant_item->nazwa?> </h1>

<p><span class="tytul">Kategoria:</span> <?php echo $Grant_item->kategoria->nazwa ?></p>
<p><span class="tytul">Zalożyciel:</span> <?php echo $Grant_item->zalozyciel->imie . ' ' . $Grant_item->zalozyciel->nazwisko ?></p>

<?php $i = 0;
	foreach ($Grant_item->podwykonawcyUserModel as $podwyk ) {
		if(!($Grant_item->zalozyciel->imie == $podwyk->imie && $Grant_item->zalozyciel->nazwisko == $podwyk->nazwisko)) {
			if($i == 0) echo "<p><span class=\"tytul\">Podwykonawcy:</span> " . $podwyk->imie . " " . $podwyk->nazwisko;
			else echo ", " . $podwyk->imie . " " . $podwyk->nazwisko;
			$i = 2;
		}
	}
?>

<?php if(!empty($Grant_item->opis)) echo "<p><span class=\"tytul\">Opis:</span> ". $Grant_item->opis . "</p>" ?>

<p><span class="tytul">Budżet:</span> <?php echo $Grant_item->budzet ?></p>
<p><span class="tytul">Czas rozpoczęcia:</span> <?php echo $Grant_item->czasRozpoczecia ?></p>
<p><span class="tytul">Deadline:</span> <?php echo $Grant_item->deadline ?></p>
<p><span class="tytul">Czas na rozliczenie:</span> <?php echo $Grant_item->czasRozliczenia ?> tygodni</p><br />

<input id="hiddenIdGrant" type="hidden" value="<?php echo $Grant_item->id; ?>" />
<input id="newTabBtn" type="submit" value="Dodaj nową zakładkę" />

<script type="text/javascript">
    document.getElementById("newTabBtn").onclick = function () {
        var idGrant = $("#hiddenIdGrant").val();
        location.href = "/grant/get/" + idGrant + '/newtab';
    };
</script>

<form style="display:inline" id="delete_form" method="post" action="<?php echo base_url() . 'grant/'; ?>delete">
    <input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
    <input type="submit" value="Usuń ten grant" />
</form>
