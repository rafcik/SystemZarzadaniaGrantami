<?php
require_once('tabs_layout.php');
?>
<h3 id="tabName">Dodawanie nowej zakładki</h3>

<form id="create_tab" method="post" action="http://granty.lyrmet.pl/grant/insert_tab">
    <h1>Dodwanie nowej zakładki</h1>
    <label class="description" for="nazwa">Nazwa <span style="color:red">*</span> </label>
        <input id="nazwa" name="nazwa" type="text" maxlength="255" value="" required="To pole jest obowiązkowe"/>
	<br />
	
    <label class="opis" for="opis">Opis&nbsp; &nbsp;</label>
        <textarea id="opis" name="opis"  maxlength="500" value="" > </textarea>
	<br />

    <label for="owner">Właściciel zakładki&nbsp; &nbsp;</label>
        <select id="owner_select" name="owner_select">
        <?php
            foreach($Users as $u) {
				echo '<option id="' . $u->id . '" value="' . $u->id . '">'  . $u->imie . ' ' . $u->nazwisko . '</option>' . "\n";
            }
        ?>
		</select>
 <br /><br /><br />
    <input type="hidden" name="form_id" value="1015594" />
    <input type="hidden" name="idGrant" value="<?php echo $idGrant; ?>" />
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Dodaj" />
</form>
