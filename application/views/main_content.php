<h1>Witamy w systemie zarządzania grantami!</h1>
<h2>
<?php
	if($logged_in) {
		echo "Jesteś zalogowany jako {$logged_in['imie']} {$logged_in['nazwisko']}. <a href='auth/logout'>Wyloguj</a>";
	} else {
		echo 'Nie jesteś zalogowany :(<br />Aby zacząć korzystać z naszego super systemu, przejdź na stronę <a href="auth/">logowania</a>.';
	}
	echo '<br>==============test===============<br>';
				print_r($logged_in);
	echo '============end test=============';		
?>
</h2>
