<form id="create_grant"  method="post" action="insert">
    <div class="form_description">
        <h2>Dodwanie nowego granta</h2>
    </div>


            <label class="description" for="nazwa">Nazwa* </label>
            <div>
                <input id="nazwa" name="nazwa" type="text" maxlength="255" value="" required="To pole jest obowiążkowe"/>
            </div>

        <label class="opis" for="opis">Opis </label>
        <div>
            <textarea id="opis" name="opis"  maxlength="500" value="" > </textarea>
        </div>

        </li>

        <label for="kategoria">Kategoria </label>
        <div>
            <select id="kategoria_select" name="kategoria_select" onchange="updateId()">
                <?php
                    foreach($kat as $k) {
                    echo '<option id="' . $k->id . '" value="' . $k->id . '">'  . $k->nazwa . '</option>' . "\n";
                }
                ?>
            </select>
        </div>
        </li>

    <input type="text" id="kategoria_id" value="1" style="display: none;" />

    <script>
        function updateId() {
            var katId = $("#kategoria_select").val();
            $('#kategoria_id').val(katId);
        }
    </script>


        <label  for="budzet">Budżet (zł)*</label>
        <div>
            <input id="budzet" name="budzet" type="number" maxlength="255" step="any" min="0" value="" required="To pole jest obowiążkowe"/>
        </div>


        <label  for="czasRozpoczecia">Czas rozpoczęcia* </label>
        <div>
            <input id="czasRozpoczecia" name="czasRozpoczecia" type="date" value="2015-06-25" required="To pole jest obowiążkowe"/>
        </div>


        <label for="czasZakonczenia">Czas zakończenia* </label>
        <div>
            <input id="czasZakonczenia" name="czasZakonczenia" type="date" value="2015-06-15" required="To pole jest obowiążkowe"/>
        </div>


        <label for="czasRozliczenia">Czas rozliczenia (liczba tygodni)* </label>
        <div>
            <input id="czasRozliczenia" name="czasRozliczenia" type="number"  value="20" required="To pole jest obowiążkowe"/>
        </div>

            <input type="hidden" name="form_id" value="1014494" />
            <input id="saveForm" class="button_text" type="submit" name="submit" value="Dodaj" />

</form>




