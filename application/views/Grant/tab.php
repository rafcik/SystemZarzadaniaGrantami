<?php
require_once('tabs_layout.php');
?>
<br />
<br />
<br />
<h3 id="tabName"></h3>

<form id="delete_form" method="post" action="<?php echo base_url() . 'grant/'; ?>delete_tab">
    <input type="hidden" name="idGrant" value="<?php echo $Grant_item->id; ?>" />
    <input type="hidden" name="idZakladki" value="<?php echo $idZakladki; ?>" />
    <input type="submit" value="Usuń zakładkę" />
</form>
