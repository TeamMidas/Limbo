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

<h1>Welcome to Limbo!</h1>
<h4 style='margin-top:-15px'>If you lost or found something, you're in luck: this is the place to report it.</h4>
<h3 style='display:inline'>Reported in last </h3>

<form action="limbo.php" method="POST" style='display:inline'>
<select id="timeFilter" name="timeFilter" style='margin-bottom:10px'>
	<option value='0' selected="selected">7 days</option>
	<option value='1'>1 month</option>
	<option value='2'>3 months</option>
</select>
<p style='display:inline'><input type="submit"></p>
<form>

<?php
require( 'includes/helpers.php' ) ;

$dbc = init('limbo_db');

show_stuff($dbc) ;

mysqli_close( $dbc ) ;
?>
</body>
</html>