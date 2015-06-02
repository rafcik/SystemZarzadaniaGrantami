<?php
echo '<div id="tabContainer" class="zakladki">';
require_once('tabs_layout.php');

for($i = 0; $i < count($Grant_item->podwykonawcyUserModel); $i++)
{
    echo '<a class="zakladka" href="' . base_url() . 'grant/get/' . $Grant_item->id . '/' . $Grant_item->zakladki[$i]['id'] . '">' . $Grant_item->zakladki[$i]['nazwa'] . '</a>';
    // echo '<br />Opis: ' . $Grant_item->zakladki[$i]['opis'];
    // echo '<br />Właściciel podzakladki: ' . $Grant_item->podwykonawcyUserModel[$i]->imie . ' ' . $Grant_item->podwykonawcyUserModel[$i]->nazwisko . ' - ' . $Grant_item->podwykonawcyUserModel[$i]->email;
}
echo '</div>';
?>
<br />
<br />
<br />
<h3 id="tabName">Kalendarz</h3>

