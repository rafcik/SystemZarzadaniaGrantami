Witamy w systemie zarządzania grantami
<br>
<?php
	if($logged_in) {
		echo "Jesteś zalogowany jako {$logged_in['imie']} {$logged_in['nazwisko']}. <a href='index.php?/auth/logout'>Wyloguj</a>";
	} else {
		echo 'Jesteś nie zalogowany. Przejdź na stronę <a href="index.php?/auth/">logowania</a>';
	}
?>

