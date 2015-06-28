<div class="rejestracja">
	<p class="tytul">System Zarządzania Grantami</p>
	<p class="podtytul">Rejestracja</p>
	<div id="errors">
		<?php 
			echo validation_errors();
		?>
	</div>
	
	<?php 
		echo form_open("registration/register");
	?>

	<label for="imie"> Imię: </label>
	<input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" /><br />
	
	<label for="surname"> Nazwisko: </label>
	<input type="text" id="surname" name="surname" value="<?php echo set_value('surname'); ?>" /><br />
	
	<label for="email_address"> Email: </label>	
	<input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" /><br />
	
	<label for="password"> Hasło: </label>	
	<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" /><br />
	
	<label for="con_password"> Powtórz hasło: </label>	
	<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" /><br />
	
	<input type="submit" class="" value="Zarejestruj" />
	<?php echo form_close(); ?>
</div>
