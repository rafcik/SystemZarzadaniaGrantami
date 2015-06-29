<h1>Dodwanie nowego granta</h1>
<form id="create_grant"  method="post" action="insert">
    <label class="description" for="nazwa">Nazwa <span style="color:red">*</span></label>
    <input id="nazwa" name="nazwa" type="text" maxlength="255" value="" required="To pole jest obowiążkowe"/>
	<br />
    <label class="opis" for="opis">Opis&nbsp; &nbsp;</label>
    <textarea id="opis" name="opis"  maxlength="500" value="" > </textarea>
	<br />
    <label for="kategoria">Kategoria <span style="color:red">*</span></label>
    <select id="kategoria_select" name="kategoria_select" onchange="updateId()">
        <?php
            foreach($kat as $k) {
            echo '<option id="' . $k->id . '" value="' . $k->id . '">'  . $k->nazwa . '</option>' . "\n";
            }
        ?>
    </select>
    
    <input type="text" id="kategoria_id" value="1" style="display: none;" />

    <script>
        function updateId() {
            var katId = $("#kategoria_select").val();
            $('#kategoria_id').val(katId);
        }
    </script>
	<br />

        <label  for="budzet">Budżet (zł) <span style="color:red">*</span></label>

            <input id="budzet" name="budzet" type="number" maxlength="255" step="any" min="0" value="" required="To pole jest obowiążkowe"/>
<br />

        <label  for="czasRozpoczecia">Data rozpoczęcia <span style="color:red">*</span></label>
      
            <input id="czasRozpoczecia" name="czasRozpoczecia" type="date" value="<?php echo date('Y-m-d');?>" required="To pole jest obowiążkowe"/>
     <br />


        <label for="czasZakonczenia">Data zakończenia <span style="color:red">*</span></label>
        
            <input id="czasZakonczenia" name="czasZakonczenia" type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d').' + 140 days'));?>" required="To pole jest obowiążkowe"/>
        
<br />

        <label for="czasRozliczenia">Czas rozliczenia (liczba tygodni) <span style="color:red">*</span></label>
        
            <input id="czasRozliczenia" name="czasRozliczenia" type="number"  value="20" required="To pole jest obowiążkowe"/>
       <br /><br />

            <input type="hidden" name="form_id" value="1014494" />
            <input id="saveForm" class="button_text" type="submit" name="submit" value="Dodaj" />
</form>




