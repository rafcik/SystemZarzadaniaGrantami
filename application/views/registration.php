<div id=container>
	<div id="errors">
		<?php 
			echo validation_errors();
		?>
	</div>
	
	<?php 
		echo form_open("registration/register");
	?>

	<label for="imie"> Imie: </label>
	<input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" />
	
	<label for="surname"> Nazwisko: </label>
	<input type="text" id="surname" name="surname" value="<?php echo set_value('surname'); ?>" />
	
	<label for="email_address"> Email: </label>	
	<input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
	
	<label for="password"> Haslo: </label>	
	<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
	
	<label for="con_password"> Powtorz haslo: </label>	
	<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
	
	<input type="submit" class="" value="Zarejestruj" />
	<?php echo form_close(); ?>
</div>