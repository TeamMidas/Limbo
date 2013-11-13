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
	$pass = $_POST['pass'] ;
	
    $success = validate($email, $pass) ;

    if($success == -1)
      echo '<P style=color:red>Login failed please try again.</P>' ;
	  
    else
      echo '<p> you got in wheeeeee </p>'  ;
}
?>

<!-- Get inputs from the user. -->
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<h1>Admin Login</h1>
<form action="admin.php" method="POST">
<table>
<tr>
<td>Username:</td><td><input type="text" name="email"></td>
<td>Password:</td><td><input type="text" name="pass"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>