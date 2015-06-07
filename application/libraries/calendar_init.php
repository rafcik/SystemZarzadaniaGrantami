<?php 
	$client_id = '638657162940-qteb7evphm08rapd2bq25al332522puh.apps.googleusercontent.com';
	$client_secret = 'a7x7g2Dmbx-IILJeIKVqEcu6';
	$redirect_uri = 'http://granty.lyrmet.pl/auth/calendar';

	$client = new Google_Client();
	$client->setApplicationName("SystemZarzadzaniaGrantami");
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->setAccessType('offline');   // Gets us our refreshtoken

	$client->setScopes(array('https://www.googleapis.com/auth/calendar'));
?>