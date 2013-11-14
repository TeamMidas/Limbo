<!--
  Stanley Yang, Antony Liang
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {

	echo '<P style=color:red>You shouldn''t be here</P>' ;
}

else {
     echo '<P style=color:red>You shouldn''t be here</P>' ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>

</html>