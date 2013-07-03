<article>
<h3>Check your mail</h3>
<p>An email with a confirmation link has been sent to you</p>

<form action="index.php?location=verify&action=mailView&email=<?php echo $instructions['email']; ?>&code=<?php echo $instructions['hash']; ?>" method="POST">
<input type="submit" class="enabledButton" value="View Mail">
</form>
</article>