<!--
Limbo Project
By: Stanley Yang, Antony Liang

-->

<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>

</head>

<body>
<a href='./adminHome.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./adminManagement.php' style='margin-right:10px'>Admins Management</a>
<a href='./accountChanges.php' style='margin-right:10px'>Change Account Info</a>
<a href='./limbo.php' >Log Out</a>

<p></p>

<h1>Admin Messages</h1>

<h4>Click on the messages to expand them</h4>

<?php
require( 'includes/connect_db.php' ) ;

require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$theID = -1;
	
	if(isset($_POST['remove'])){
		$theID = $_POST['remove'] ;
		$deleteQuery = 'DELETE FROM messages WHERE id = ' . $theID ;
		$deleteResults = mysqli_query($dbc, $deleteQuery) ;
	}
}

show_messages($dbc) ;

mysqli_close( $dbc ) ;
?>

</body>

<style>
.redButton {
    background:url(/images/redbutton.PNG) no-repeat;
    cursor:pointer;
    width: 15px;
    height: 15px;
    border: none;
}

</style>

<script>
function toggleInfo(number) {
	 if( document.getElementById(number).style.display=='none' ){
   document.getElementById(number).style.display = '';
 }else{
   document.getElementById(number).style.display = 'none';
 }
}
</script>

</html>