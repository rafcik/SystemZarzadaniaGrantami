<?php
    require_once('tabs_layout.php');
?>
<h3 id="tabName">Ogólne</h3>


<!--
<a href="<?php echo base_url() . 'grant/get/' . $Grant_item->id . '/newtab' ?>">Nowa zakładka</a>
-->

<input id="hiddenIdGrant" type="hidden" value="<?php echo $Grant_item->id; ?>" />
<input id="newTabBtn" type="submit" value="Nowa zakładka" />

<script type="text/javascript">
    document.getElementById("newTabBtn").onclick = function () {
        var idGrant = $("#hiddenIdGrant").val();
        location.href = "/grant/get/" + idGrant + '/newtab';
    };
</script>


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

<form id="delete_form" method="post" action="<?php echo base_url() . 'grant/'; ?>delete">
    <input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
    <input type="submit" value="Usuń ten grant" />
</form>
