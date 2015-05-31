<h1>Kalendarz</h1>
<h2>
<?php	
	foreach ($calendarList->getItems() as $calendarListEntry) {
		echo $calendarListEntry->getSummary()."<br>\n";
	}
?>
</h2>
