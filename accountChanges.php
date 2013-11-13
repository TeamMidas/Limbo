<!--
Stanley Yang
Antony Liang

-->

<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Connect to MySQL server and the database
require( 'includes/login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

	$email = $_POST['email'] ;
	$oldpass = $_POST['oldpass'] ;
	$newpass = $_POST['newpass'] ;
	$confirmpass = $_POST['confirmpass'] ;
	
    $success = validate($email, $oldpass) ;

    if($success != -1) {
		if($newpass != $confirmpass OR empty($newpass))
			echo '<P style=color:red>Passwords do not match<P>' ;
		else {
			changePassword($email, $newpass) ;
			echo '<P>Password changed!</P>' ;
		}
	}
    else
	  echo '<P style=color:red>Incorrect Password</P>' ;
}
?>

<!-- Get inputs from the user. -->
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<h1>Change Account Info</h1>

<form action="accountChanges.php" method="POST">
<table class = "list">
<tr><td class = "none">Email:</td><td><input type="text" name="email"></td></tr>
<tr><td class = "none">Current Password:</td><td><input type="text" name="oldpass"></td></tr>
<tr><td class = "none">New Password:</td><td><input type="text" name="newpass"></td></tr>
<tr><td class = "none">Confirm New Password:</td><td><input type="text" name="confirmpass"></td></tr>
</table>
<p><input type="submit" ></p>
</form>

<style>
.list {
	BORDER: solid 1px black;
}

.list td{
	BORDER: solid 1px black;
}

.list td.none{
	border-style: none;
}

.list th{
	BORDER: solid 1px black;
}

.list th.none{
	border-style: none;
}
</style>

</html>