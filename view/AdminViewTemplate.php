<header>Admin</header>
<form action="index.php?location=registerPage&action=" method="POST">
</form>

<br />

<table border="1">
<th colspan="3">Users</th>

<?php foreach ($data['content'] as $row): ?>

<tr>

<td><?php echo $row['username']; ?></td>

<td><a href="index.php?location=adminPage&action=suspendUser&username=<?php echo $row['username']; ?>">Suspend</a></td>

<td><a href="index.php?location=adminPage&action=unsuspendUser&username=<?php echo $row['username']; ?>">Unsuspend</a></td>

</tr>

<?php endforeach; ?>
</table>
