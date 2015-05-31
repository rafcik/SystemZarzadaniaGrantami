<h2><?php echo $title ?></h2>

<h3>Zakladki grant:</h3>

<!--
echo '<pre>';
var_dump($user);
echo '</pre>';
-->

<ul>
    <?php
    for($i = 0; $i < count($Grant_item->podwykonawcyUserModel); $i++)
    {
        echo '<li>Nazwa: <a href="' . base_url() . 'grant/get/' . $Grant_item->id . '/' . $Grant_item->zakladki[$i]['id'] . '">' . $Grant_item->zakladki[$i]['nazwa'] . '</a>';
        echo '<br />Opis: ' . $Grant_item->zakladki[$i]['opis'];
        echo '<br />Właściciel podzakladki: ' . $Grant_item->podwykonawcyUserModel[$i]->imie . ' ' . $Grant_item->podwykonawcyUserModel[$i]->nazwisko . ' - ' . $Grant_item->podwykonawcyUserModel[$i]->email;
        echo '</li>';
    }
    ?>
</ul>

<a href="<?php echo base_url() . 'grant/get/' . $Grant_item->id . '/newtab' ?>">Nowa zakładka</a>


    <div class="main">
        <ul>
<!--
            <?php foreach ($Grant_item->podwykonawcyUserModel as $podwyk ): ?>
                <li>Tab: <?php echo $podwyk->imie . ' ' . $podwyk->nazwisko ?>
                </li>
            <?php endforeach ?>
-->

            <h3>Nazwa: <?php echo $Grant_item->nazwa?> </h3>
            <li>Opis: <?php echo $Grant_item->opis ?></li>
            <li> Kategoria: <?php echo $Grant_item->kategoria->nazwa ?></li>
            <li> Zalożyciel: <?php echo $Grant_item->zalozyciel->imie . ' ' . $Grant_item->zalozyciel->nazwisko ?> </li>

            <li> Budzet: <?php echo $Grant_item->budzet ?></li>
            <li> Czas rozpoczecia: <?php echo $Grant_item->czasRozpoczecia ?></li>

            <li> Deadline: <?php echo $Grant_item->deadline ?></li>
            <li> Czas rozliczenia: <?php echo $Grant_item->czasRozliczenia ?> tygodni</li>
        </ul>

    </div>
