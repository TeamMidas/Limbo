<!DOCTYPE html>
<html>
<head>
<title>ADMIN'S Limbo</title>
</head>
<body>

<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<a href='./accountChanges.php'>Change Account Info</a>
<h1>Admin Management</h1>

<?php
require( 'includes/connect_db.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$theID = -1;
	
	if(isset($_POST['remove'])){
		$theID = $_POST['remove'] ;
		$deleteQuery = 'DELETE FROM users WHERE user_id = ' . $theID ;
		$deleteResults = mysqli_query($dbc, $deleteQuery) ;
	}
	
	else {
	
		if(isset($_POST['email']) AND !empty($_POST['email']) AND !empty($_POST['pass']) AND !empty($_POST['fname']) AND !empty($_POST['lname'])){
			$email = $_POST['email'] ;
			$pass = $_POST['pass'] ;
			$fname = $_POST['fname'] ;
			$lname = $_POST['lname'] ;
			$confirmpass = $_POST['confirmpass'] ;
			
			if($pass != $confirmpass){
				echo '<P style=color:red>Passwords do not match<P>' ;
			}
			
			else{
				$insertQuery = "INSERT INTO users(first_name, last_name, email, pass, reg_date) VALUES ('" . $fname . "', '" . $lname . "', '" . $email . "', PASSWORD('" . $pass . "'), Now())" ;
				$insertResults = mysqli_query($dbc, $insertQuery) ;
			}
			
		}
	
	}
}

$query = 'SELECT user_id, first_name, email FROM users ORDER BY user_id DESC' ;

$results = mysqli_query($dbc, $query) ;

if( $results )
{

  $id = 0 ;
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<h3>List of Admins</h3>' ;
  echo '<TABLE class="list">';
  echo '<TR>';
  echo '<TH class="none"></TH>' ;
  echo '<TH>First Name</TH>';
  echo '<TH>Email</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
	$id = $row['user_id'] ;
    echo '<TR>' ;
	echo '<TD class = "none"> <form action="adminManagement.php" method="POST"> <input type="hidden" name="remove" value = "' . $id . '"> <input type="submit" value = "" class = "redButton"> </form> </TD>' ;
    echo '<TD>' . $row['first_name'] . '</TD>' ;
    echo '<TD>' . $row['email'] . '</TD>';
	echo '</TR>' ;
  }

  # End the table
  echo '</TABLE>';

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

?>

<h3> Add a new admin </h3>

<form action="adminManagement.php" method="POST">
<table class = "list">
<tr><td class = "none">Email:</td><td><input type="text" name="email"></td></tr>
<tr><td class = "none">First Name:</td><td><input type="text" name="fname"></td></tr>
<tr><td class = "none">Last Name:</td><td><input type="text" name="lname"></td></tr>
<tr><td class = "none">Password:</td><td><input type="text" name="pass"></td></tr>
<tr><td class = "none">Confirm New Password:</td><td><input type="text" name="confirmpass"></td></tr>
</table>
<p><input type="submit" ></p>
</form>

</body>

<style>
.redButton {
    background:url(/images/redbutton.PNG) no-repeat;
    cursor:pointer;
    width: 15px;
    height: 15px;
    border: none;
}

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