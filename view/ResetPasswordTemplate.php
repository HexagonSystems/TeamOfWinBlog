<article>
	<h3>Reset password</h3>
	<form action="index.php?location=loginPage&action=forgotPassword" method="POST">
		<input type="text" name="email" placeholder="Email" required>
		<input type="submit" value="Reset">
		<input type="hidden" value="resetPassword" name="action">
	</form>
</article>
