<header><?=$title ?> Post</header>
<form action="index.php?location=registerPage&action=changepassword" method="POST">
    <label>Title <input type="text" placeholder="Put a kick-ass title" name="title"></label>
    <label>Content <textarea placeholder="Tell us a story..." name="content"></textarea>
    <input type="submit" value="newpost">
</form>