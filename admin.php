<!--
Limbo Project
By: Stanley Yang, Antony Liang

-->

<!DOCTYPE html>
<html>
<a href='./limbo.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<h1>Admin Login</h1>

<?php
require( 'includes/connect_db.php' ) ;
require( 'includes/login_tools.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

	$email = $_POST['email'] ;
	$pass = $_POST['pass'] ;
	
    $success = validate($email, $pass) ;

    if($success != -1)
      load('adminHome.php');
	  
    else
	  echo '<P style=color:red>Incorrect Email or Incorrect Password</P>' ;
}
?>

<!-- Get inputs from the user. -->

<form action="admin.php" method="POST">
<table>
<tr>
<td>Email:</td><td><input type="text" name="email"></td>
<td>Password:</td><td><input type="password" name="pass"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>