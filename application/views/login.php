<div class="logowanie"><div class="logowanie-ramka"">
	<p class="tytul">System Zarządzania Grantami</p>
	<p class="podtytul">Logowanie</p>
	<form method="post" action="/auth/login">
		<?php echo validation_errors(); ?>
		<img src="<?php echo base_url(); ?>resources/images/user.png" alt="e-mail: " />
		<input type="email" name="email" value="e-mail" onFocus="if(this.value=='e-mail')this.value=''" onBlur="if(this.value=='')this.value=this.defaultValue" />
		<br />
		<img src="<?php echo base_url(); ?>resources/images/key.png" alt="hasło: " />
		<input type="text" name="password" value="hasło" onFocus="if(this.value==this.defaultValue){this.value='';this.type='password'}" onBlur="if(this.value==''){this.value=this.defaultValue;this.type='text'}"/>
		<br />
		<input type="submit" name="zaloguj" value="Zaloguj" />
	</form>
	<a href="">
		<img src="<?php echo base_url(); ?>resources/images/sad.png" alt="" />Nie pamiętam hasła
	</a>
</div></div>
