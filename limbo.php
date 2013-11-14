<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>
</head>
<body>

<a href='./limbo.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>

<h1>Welcome to Limbo!</h1>
<h4 style='margin-top:-15px'>If you lost or found something, you're in luck: this is the place to report it.</h4>
<h3 style='display:inline'>Reported in last </h3>
<select style='margin-bottom:10px'>
<option value='week'>7 days</option>
<option value='month'>1 month</option>
<option value='trimonth'>3 months</option>
</select>

<?php
require( 'includes/connect_db.php' ) ;

require( 'includes/helpers.php' ) ;

show_stuff($dbc) ;

mysqli_close( $dbc ) ;
?>
</body>
</html>