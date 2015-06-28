<?php 
if($logged_in) {
?>
<nav>
	<!--<img src="<?php echo base_url(); ?>/resources/images/menu.png" alt="" />
	<div class="powiadomienie">
		<a href="">
			<img src="<?php echo base_url(); ?>/resources/images/notifications.png" alt="" />
			1 powiadomienie
		</a>
	</div>-->
	<p class="user">
		<?php
			echo "{$logged_in['imie']} {$logged_in['nazwisko']}";
		?>
	</p>
	<ul>
		<li><a href="<?php echo base_url() . 'grant' ?>"><img src="<?php echo base_url(); ?>/resources/images/grants.png" alt="" />Moje granty</a></li>
		<li><br /></li>
		<li><a href="<?php echo base_url() . 'grant/create' ?>"><img src="<?php echo base_url(); ?>/resources/images/add.png" alt="" />Dodaj grant</a></li>
		<li><br /></li>
		<?php
			$img = base_url().'/resources/images/logout.png';
			echo "<li><a href='".base_url()."auth/logout'><img src='{$img}' alt='' />Wyloguj</a></li>";
		?>
	</ul>
</nav>
<?php } ?>
<div class="tresc">
