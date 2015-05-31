
<form id="create_tab"  method="post" action="http://granty.lyrmet.pl/grant/insert_tab">
    <div class="form_description">
        <h2>Dodwanie nowej zakładki</h2>
    </div>
        <label class="description" for="nazwa">Nazwa* </label>
        <div>
            <input id="nazwa" name="nazwa" type="text" maxlength="255" value="" required="To pole jest obowiązkowe"/>
        </div>

        <label class="opis" for="opis">Opis </label>
        <div>
            <textarea id="opis" name="opis"  maxlength="500" value="" > </textarea>
        </div>

        <label for="owner">Właściciel zakładki</label>
        <div>
            <select id="owner_select" name="owner_select">
                <?php
                    foreach($Users as $u) {
                        echo '<option id="' . $u->id . '" value="' . $u->id . '">'  . $u->imie . ' ' . $u->nazwisko . '</option>' . "\n";
                    }
                ?>
        </select>
        </div>
    <input type="hidden" name="form_id" value="1015594" />
    <input type="hidden" name="idGrant" value="<?php echo $idGrant; ?>" />
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Dodaj" />
</form>