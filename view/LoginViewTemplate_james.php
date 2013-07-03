<link rel="stylesheet" type="text/css" href="includes/css/loginView.css" />
<link rel="stylesheet"
	type="text/css" href="includes/css/index_blog_display.css" />
<script
	src="includes/js/register_formValidation.js"></script>

<aside>
	<article>
		<span class="title">Create your account</span>
		<form action="index.php?location=loginPage&action=register"
			method="POST">
			<ul>
				<li><input type="text" placeholder="Username" name="username"
					size=30 id="register_username"
					onblur="formValidation(this.value, 'username')">
					<div id="messageAlert"></div>
					<div id="message_username" onclick="hideMessageBox('username')"></div>
				</li>
				<li><input type="text" placeholder="Email" name="email"
					id="register_email" size=30
					onblur="formValidation(this.value, 'email')">
					<div id="message_email" onclick="hideMessageBox('email')"></div></li>
				<li><input type="password" placeholder="Password" name="pass"
					id="register_pass" size=30 onblur="validatePass(this.value)">
					<div id="message_pass" onclick="hideMessageBox('pass')"></div></li>
				<li><input type="submit" value="Sign me up!"></li>
			</ul>
		</form>
	</article>
	<article>
		<span class="title">New here?<br />It's simple to register!
		</span>
		<button>Create your account</button>
	</article>
</aside>

<div id="mainArea">
	<ul>
		<li class="blogBox"><header>Top Blogs</header>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
		</li>
		<li class="blogBox"><header>New Blogs</header>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
			<article>
				<header>This is a blog</header>
				<p>This is a brief description of whats in the article...</p>
			</article>
		</li>
	</ul>
</div>
