<h1><?php echo $title ?></h1>

<?php if(!empty($Grant_item))
foreach($Grant_item as $grant){ ?>
    <ul>
        <li><h2><a href="<?php echo base_url() . 'grant/get/' . $grant->id ?> "><?php echo $grant->nazwa?></a></h2></li>
        
        <p class="granty_lista">Kategoria: <?php echo $grant->kategoria->nazwa ?> &bull;
        Zalożyciel: <?php echo $grant->zalozyciel->imie . ' ' . $grant->zalozyciel->nazwisko ?> &bull;
        Data zakończenia: <?php echo $grant->deadline ?> </p>
		<p><?php echo $grant->opis ?></p>		
    </ul>
<?php } 
else echo "<h2>Nie posiadasz jeszcze żadnych grantów.</h2><h2>Dodaj jakiś wybierając z menu opcję \"Dodaj grant\".</h2>"; ?>
