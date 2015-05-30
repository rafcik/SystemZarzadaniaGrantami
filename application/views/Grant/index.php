<h2><?php echo $title ?></h2>


<div class="main">
<?php foreach($Grant_item as $grant): ?>
    <ul>
        <li><a href="<?php echo base_url() . 'grant/get/' . $grant->id ?> "><?php echo $grant->nazwa?> </a></li>

        <?php foreach ($grant->zakladki as $zakladka ): ?>
            <li>Tab: <?php echo $zakladka['nazwa'] . ' ' . $zakladka['opis'] ?>

               <!-- Podwykonawca: <?php echo $zakladka->podwykonawca->imie . ' ' . $zakladka->podwykonawca->nazwisko ?> -->
            </li>
        <?php endforeach ?>

        <?php echo $grant->opis ?>
        <!--
        <li> Kategoria: <?php echo $grant->kategoria->nazwa ?></li>
        <li> Zalożyciel: <?php echo $grant->zalozyciel->imie . ' ' . $grant->zalozyciel->nazwisko ?> </li>
        <li> Data rozpoczęcia: <?php echo $grant->czasRozpoczecia ?></li>
        <li> Data zakończenia: <?php echo $grant->deadline ?></li>

        <li> Budzet: <?php echo $grant->budzet ?> zł</li>
        <li> Czas rozliczenia: <?php echo $grant->czasRozliczenia ?> tygodni</li>
        -->
    </ul>
<?php endforeach ?>

</div>



