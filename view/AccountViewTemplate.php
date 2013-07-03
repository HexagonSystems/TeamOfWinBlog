<header>Account</header>
<form action="index.php?location=accountPage&action=changeemail" method="POST">
    <input type="text" placeholder="New Email" name="email"><br />
    <input type="password" placeholder="Password" name="password"><br />
    <input type="submit" value="Change Email">
</form><br />
<form action="index.php?location=accountPage&action=changepassword" method="POST">
    <input type="password" placeholder="Old Password" name="oldpass"><br />
    <input type="password" placeholder="New Password" name="newpass"><br />
    <input type="password" placeholder="New Password Again" name="newpass2"><br />
    <input type="submit" value="Change Password">
</form>
