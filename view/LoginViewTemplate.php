<article id="loginBox">
	<h3>Login</h3>
	<form action="index.php?location=loginPage&action=login" method="POST">
		<ul>
			<!-- Username -->
			<li>
				<input type="text" placeholder="Username" name="username" size=30 id="register_username">
			</li>

			<!-- Password -->
			<li>
				<input type="password" placeholder="Password" name="pass" id="register_pass" size=30>
			</li>
			
			<li>
				<input type="submit" class="enabledButton" value="Login">
			</li>
		</ul>
		<input type="hidden" value="registerAccount" name="action">
	</form>
</article>
<article>
	| <span class="title">Forgotten your password? <a href="index.php?location=loginPage&action=forgotPassword">Click Here</a></span> | 
	<a href="index.php?location=registerPage" class="title">Don't have an account? Click here to get started!</a> |
</article>
