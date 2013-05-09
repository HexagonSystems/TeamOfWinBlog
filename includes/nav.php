<nav>
	<h1>Menu</h1>
	<?php
	//This would normally come from the database
	$item1 = array('location'=>'/index.php?location=page1&action=view', 'link' => 'Page 1');
	$item2 = array('location'=>'/index.php?location=page2&action=view&id=1', 'link' => 'Page 2');
	$item3 = array('location'=>'/index.php?location=loginPage&action=view&id=1', 'link' => 'Login');
	$menu = array($item1, $item2, $item3);
	?>
	<ul class="menu">
		<!-- display links for all menu items -->
		<?php foreach($menu as $menuItem) : ?>
		<li><a href="<?php echo SITE_ROOT . $menuItem['location']; ?>"> <?php echo $menuItem['link']; ?>
		</a></li>
		<?php endforeach; ?>
	</ul>
</nav>
<?php echo "\n" ?>