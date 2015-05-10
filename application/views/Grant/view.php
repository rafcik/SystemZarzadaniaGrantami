<h2><?php echo $title ?></h2>

  <?php var_dump($Grant_item); ?>
<h3>Zakladki grant:</h3>
<?php var_dump($Grant_item->zakladki); ?>


    <div class="main">
        <ul>
            <?php foreach ($Grant_item->zakladki as $zakladka ): ?>
                <li>Tab: <?php echo $zakladka->nazwa . ' ' . $zakladka->opis ?>

                    Podwykonawca: <?php echo $zakladka->podwykonawca->imie . ' ' . $zakladka->podwykonawca->nazwisko?>
                </li>
            <?php endforeach ?>

            <li><h2>Nazwa: <?php echo $Grant_item->nazwa?> </h2></li>
            <li>Opis: <?php echo $Grant_item->opis ?></li>
            <li> Kategoria: <?php echo $Grant_item->kategoria->nazwa ?></li>
            <li> Zalożyciel: <?php echo $Grant_item->zalozyciel->imie . ' ' . $Grant_item->zalozyciel->nazwisko ?> </li>

            <li> Budzet: <?php echo $Grant_item->budzet ?></li>
            <li> Deadline: <?php echo $Grant_item->deadline ?></li>
            <li> Czas rozliczenia: <?php echo $Grant_item->czasRozliczenia ?> tygodni</li>
        </ul>

    </div>
