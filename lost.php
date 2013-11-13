<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>
</head>
<body>

<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>

<?php
require( 'includes/connect_db.php' ) ;

$query = 'SELECT create_date, status, name FROM stuff ORDER BY create_date DESC' ;

$results = mysqli_query($dbc, $query) ;


echo "<h1>Lost Item</h1>" ;
echo "<h4 style='margin-top:-15px'>Please fill out your contact information and information pertaining to the item you lost</h4>" ;

?>

<form action="lost.php" method="POST">

<table>
	<caption>Contact Information</caption>
	<tr>
		<td>First Name:</td><td><input type="text" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" ></td>
	</tr>
	<tr>
		<td>Last Name:</td><td><input type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></td>
	</tr>
	<tr>
		<td>Phone Number:</td><td><input type="text" name="phone_number" value="<?php if (isset($_POST['phone_number'])) echo $_POST['phone_number']; ?>"></td>
	</tr>
	<tr>
		<td>Email Address:</td><td><input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></td>
	</tr>
</table>

<br>

<table>
	<caption>Item Information</caption>
	<tr>
		<td>Item Name:</td><td><input type="text" name="item_name" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>" ></td>
	</tr>
	<tr>
		<td>Date Lost:</td><td>WILL ADD CALENDAR LATER</td>
	</tr>
	<tr>
		<td>Time Lost:</td><td>WILL ADD TIME LATER</td>
	</tr>
	<tr>
		<td>Location Lost:</td><td>WILL ADD LOCATIONS</td>
	</tr>
	<tr>
		<td>Description:</td><td><input type="text" name="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>" ></td>
	</tr>
	<tr>
		<td>Picture Upload:</td><td><input type="file" name="pic" accept="image/*"></td>
	</tr>
</table>
<p><input type="submit" ></p>
</form>

</body>
</html>