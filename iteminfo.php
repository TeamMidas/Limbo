<!--
Limbo Project
By: Stanley Yang, Antony Liang

-->

<!DOCTYPE html>
<html>

<a href='./limbo.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php' style='margin-right:10px'>Admins</a>
<a href='./contactAdmin.php'>Contact Admins</a>

<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET' && isset($_GET['itemname'])) {
	show_item($dbc, $_GET['itemname']) ;
}

else {
     echo '<P style=color:red>You shouldnt be here</P>' ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>

<script>
function toggleInfo() {
 if( document.getElementById("info").style.display=='none' ){
   document.getElementById("info").style.display = '';
 }else{
   document.getElementById("info").style.display = 'none';
 }
}
</script>

</html>