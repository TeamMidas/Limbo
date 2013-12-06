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

<a href='./limbo.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php' style='margin-right:10px'>Admins</a>
<a href='./contactAdmin.php'>Contact Admins</a>

<h1>Found Item Search</h1>
<h4 style='margin-top:-15px'>Please enter the name or a trait of the item you have found</h4>

<?php

require( 'includes/connect_db.php' ) ;
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET' && isset($_GET['search'])) {

	$name = $_GET['search'] ;
	
	search_results($dbc, $name, 'lost');

}
?>

<form action="found.php" method="GET">
<table>
<tr>
<td>Search:</td><td><input type="text" name="search"></td>
<td><input type="submit" ><td>
</tr>
</table>
</form>
<br>
<form action="/foundform.php" method="get">
    <input type="submit" value="Submit a new entry" />
</form>

</html>