<article id="registerBox">
	<span class="title">Create your account</span>
	<form action="index.php?location=registerPage&action=register"
		method="POST">
		<ul>
			<!-- Username -->
			<li><input type="text" placeholder="Username" name="username" size=30
				id="register_username"
				onblur="validateEntry(this)">
				<div id="messageAlert"></div>
				<div id="message_username" class="messageBox"
					onclick="hideMessageBox('username')"></div>
			</li>

			<!-- Email -->
			<li><input type="text" placeholder="Email" name="email"
				id="register_email" size=30
				onblur="validateEntry(this)">
				<div id="message_email" class="messageBox"
					onclick="hideMessageBox('email')"></div></li>

			<!-- Password -->
			<li><input type="password" placeholder="Password" name="pass"
				id="register_pass" size=30 onfocus="openPasswordBox()"
				onclick="openPasswordBox()" onblur="hideMessageBox('message_pass')" onkeyup="validateEntry(this)">
				<div id="message_pass" class="messageBox" onclick="hideMessageBox('message_pass')">
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
			<li id="submitBox">
				<span>
					<?php	
						if(isset($message)){
							echo $message['type'].": ".$message['message'];
						}else{
							echo "Please fill in all fields correctly";
						}
					?>
				</span>
				<button class="disabledButton" disabled>Sign me up!</button>
			</li>
		
		</ul>
	</form>
</article>
