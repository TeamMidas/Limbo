<!--
  Stanley Yang, Antony Liang
-->
<!DOCTYPE html>
<html>
<head>
<title>Item</title>
</head>

<a href='./limbo.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>

<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {

	show_record($dbc, $_GET['name']) ;
}

else {
     echo '<P style=color:red>You shouldnt be here</P>' ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>

</html>