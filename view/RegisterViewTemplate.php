<article id="registerBox">
	<span class="title">Create your account</span>
	<form action="index.php?location=loginPage&action=register"
		method="POST">
		<ul>
			<!-- Username -->
			<li><input type="text" placeholder="Username" name="username" size=30
				id="register_username"
				onblur="usernameValidation(this.value)">
				<div id="messageAlert"></div>
				<div id="message_username" class="messageBox"
					onclick="hideMessageBox('username')"></div>
			</li>

			<!-- Email -->
			<li><input type="text" placeholder="Email" name="email"
				id="register_email" size=30
				onblur="formValidation(this.value, 'email')">
				<div id="message_email" class="messageBox"
					onclick="hideMessageBox('email')"></div></li>

			<!-- Password -->
			<li><input type="password" placeholder="Password" name="pass"
				id="register_pass" size=30 onfocus="openPasswordBox()"
				onclick="openPasswordBox()" onkeyup="passValidation(this.value)")">
				<div id="message_pass" class="messageBox"
					onclick="hideMessageBox('pass')">
					<Header>Password Strength-O-Metre</Header>
					<br />
					<!-- STILL IN PROGRESS -->
					<!-- DOES NOT UPDATE - FIXED WIDTH -->
					<div id="passwordStrengthBar">
						<span></span>
					</div>
					<p>Testing</p>
					<ul>
						Required:
						<li>test</li>
					</ul>
					<ul>
						Suggestions
						<li>test</li>
					</ul>

				</div></li>
			<li><input type="submit" value="Sign me up!"></li
		
		</ul>
	</form>
</article>
