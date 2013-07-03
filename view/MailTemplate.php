<article>
	<h3><?php echo $mailData['header']; ?></h3>
	<p><?php echo $mailData['content']; ?></p>
	<p><a href="index.php?location=verify&action=validate&email=<?php echo $instructions['email']; ?>&code=<?php echo $instructions['hash']; ?>">Click Here</a></p>
	<footer><?php echo $mailData['footer']; ?></footer>
</article>