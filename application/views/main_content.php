<h1>Witamy w systemie zarządzania grantami!</h1>
<h2>
<?php
	if($logged_in) {
		echo "Jesteś zalogowany jako {$logged_in['imie']} {$logged_in['nazwisko']}. <a href='index.php?/auth/logout'>Wyloguj</a>";
	} else {
		echo 'Nie jesteś zalogowany :(<br />Aby zacząć korzystać z naszego super systemu, przejdź na stronę <a href="index.php?/auth/">logowania</a>.';
	}
?>
</h2>
