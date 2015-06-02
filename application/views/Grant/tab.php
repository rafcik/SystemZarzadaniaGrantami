<?php

echo '<pre>';
//echo var_dump($Grant_item);
echo $idZakladki;
echo '</pre>';

?>

<form id="delete_form" method="post" action="<?php echo base_url() . 'grant/'; ?>delete_tab">
    <input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
    <input type="hidden" name="idZakladki" value="<?php echo $idZakladki; ?>" />
    <input type="submit" value="Usuń zakładkę" />
</form>
