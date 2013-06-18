<link rel="stylesheet" type="text/css" href="includes/css/loginView.css" />
<script
	src="includes/js/register_formValidation.js"></script>
<script
	src="includes/js/register_passValidation.js"></script>

<article id="loginBox" e>
	<span class="title">Login</span>
	<form action="index.php?location=loginPage&action=login" method="POST">
		<ul>
			<!-- Username -->
			<li><input type="text" placeholder="Username" name="username" size=30
				id="register_username">
			</li>

			<!-- Password -->
			<li><input type="password" placeholder="Password" name="pass"
				id="register_pass" size=30>
			
			<li><input type="submit" value="Login"></li
		
		</ul>
	</form>
</article>
<article>
	<span class="title">Forgotten your password? Click Here</span>
	</br>
	<a href="index.php?location=registerPage" class="title">Don't have an account? Click here to get started!</span>
</article>
