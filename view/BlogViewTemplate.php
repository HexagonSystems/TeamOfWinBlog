<link rel="stylesheet" type="text/css" href="includes/css/blogView.css" />

<section id="blogBox">
	<header>
		<?php echo $blog->getTitle(); ?>
	</header>
	<ul>
		<li>Posted by <?php echo $blog->getUserName();?></li>
		<li><?php echo $blog->getdate(); ?></li>
	</ul>
	<article>
		<?php echo $blog->getContent(); ?>
	</article>
</section>
