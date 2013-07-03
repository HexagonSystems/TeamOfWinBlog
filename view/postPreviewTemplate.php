<article class="post">
	<header class="topabsolute">
		<h2>
			<?php echo $blog->getTitle(); ?>
		</h2>
		<span>
			Posted by <?php echo $blog->getUserName(); ?>
		</span>
		<p><time itemprop="datePublished" datetime="2009-10-09"><?php echo $blog->getdate(); ?></time></p>
	</header>
	<p class="paddingmedium">
		<?php echo $blog->getContent(); ?>... <a href="index.php?location=viewBlog&blog=<?php echo $blog->getPostid(); ?>">View more</a>
	</p>
	<footer>
		<span>Comments 5</span>
	</footer>
</article>