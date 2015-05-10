<h2><?php echo $title ?></h2>


<div class="main">
<?php foreach($Grant_item as $grant): ?>
    <ul>


        <li><h2>Nazwa: <?php echo $grant->nazwa?> </h2></li>

        <?php foreach ($grant->zakladki as $zakladka ): ?>
            <li>Tab: <?php echo $zakladka->nazwa . ' ' . $zakladka->opis ?>

                Podwykonawca: <?php echo $zakladka->podwykonawca->imie . ' ' . $zakladka->podwykonawca->nazwisko?>
            </li>
        <?php endforeach ?>

        <li>Opis: <?php echo $grant->opis ?></li>
        <li> Kategoria: <?php echo $grant->kategoria->nazwa ?></li>
        <li> Zalożyciel: <?php echo $grant->zalozyciel->imie . ' ' . $grant->zalozyciel->nazwisko ?> </li>

        <li> Budzet: <?php echo $grant->budzet ?></li>
        <li> Deadline: <?php echo $grant->deadline ?></li>
        <li> Czas rozliczenia: <?php echo $grant->czasRozliczenia ?> tygodni</li>
    </ul>
<?php endforeach ?>

</div>



