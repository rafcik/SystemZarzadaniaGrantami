    <a id="tab-general" class="zakladka" href="<?php echo base_url() . 'grant/get/' . $Grant_item->id . '/general' ?>">Ogólne</a>
    <a id="tab-budget" class="zakladka" href="<?php echo base_url() . 'grant/get/' . $Grant_item->id . '/budget' ?>">Budżet</a>
    <a id="tab-calendar" class="zakladka" href="<?php echo base_url() . 'grant/get/' . $Grant_item->id . '/calendar' ?>">Kalendarz</a>
    <a id="tab-files" class="zakladka" href="<?php echo base_url() . 'grant/get/' . $Grant_item->id . '/files' ?>">Pliki</a>

<script type="text/javascript">
    $( document ).ready(function() {
        var tabName = $("#tabName").html();
        var selector = '';

        if(tabName == 'Ogólne') {
            $("#tab-general").addClass('aktywna');
        }
        else if(tabName == 'Budżet') {
            $("#tab-budget").addClass('aktywna');
        }
        else if(tabName == 'Kalendarz') {
            $("#tab-calendar").addClass('aktywna');
        }
        else if(tabName == 'Pliki') {
            $("#tab-files").addClass('aktywna');
        }
        else {
            //$("#tab-general").removeClass('aktywna');
           // /$("#tab-budget").removeClass('aktywna');
           // $("#tab-calendar").removeClass('aktywna');
            //$("#tab-files").removeClass('aktywna');
            //alert(tabName);
            //findElementByText(tabName).addClass('aktywna');
        }
    });

    function findElementByText(text){
       // alert(text);
        var jSpot=$("a:contains("+text+")")
            .filter(function(){ return $(this).children().length === 0;})
            .parent();  // because you asked the parent of that element

        return jSpot;
    }
</script>