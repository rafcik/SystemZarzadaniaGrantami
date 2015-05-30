<nav>
	<img src="<?php echo base_url(); ?>/resources/images/menu.png" alt="" />
	<div class="powiadomienie">
		<a href="">
			<img src="<?php echo base_url(); ?>/resources/images/notifications.png" alt="" />
			1 powiadomienie
		</a>
	</div>
	<p class="user">
		<?php
			if($logged_in) {
				echo "{$logged_in['imie']} {$logged_in['nazwisko']}";
			} else {
				echo 'Nie zalogowany';
			}
		?>
	</p>
	<ul>
		<li><a href=""><img src="<?php echo base_url(); ?>/resources/images/grants.png" alt="" />Moje granty</a></li>
		<li><a href=""><img src="<?php echo base_url(); ?>/resources/images/calendar.png" alt="" />Kalendarz</a></li>
		<li><br /></li>
		<li><a href=""><img src="<?php echo base_url(); ?>/resources/images/add.png" alt="" />Dodaj grant</a></li>
		<li><a href=""><img src="<?php echo base_url(); ?>/resources/images/edit.png" alt="" />Edytuj granty</a></li>
		<li><br /></li>
		<?php
			if($logged_in) {
				$img = base_url().'/resources/images/logout.png';
				echo "<li><a href='auth/logout'><img src='{$img}' alt='' />Wyloguj</a></li>";
			}	
		?>
	</ul>
</nav>
<div class="tresc">
