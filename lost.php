<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>
</head>
<body>

<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<h1>Lost Item</h1>
<h4 style='margin-top:-15px'>Please fill out your contact information and information pertaining to the item you lost</h4>

<?php
require( 'includes/connect_db.php' ) ;

$query = 'SELECT name FROM locations ORDER BY name ASC' ;

$results = mysqli_query($dbc, $query) ;

#populate locations dropdown menu
$options = '';

while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
{
	$options .="<option>" . $row['name'] . "</option>";
}

$menu="<form method='POST' action=''>
		<select name='Locations'>
		" . $options . "
		</select>
	</form>";

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
		<td>Time Lost:</td><td>
							<select>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
								<option value='4'>4</option>
								<option value='5'>5</option>
								<option value='6'>6</option>
								<option value='7'>7</option>
								<option value='8'>8</option>
								<option value='9'>9</option>
								<option value='10'>10</option>
								<option value='11'>11</option>
								<option value='12'>12</option>
							</select>
							<select>
								<option value='00'>00</option>
								<option value='10'>10</option>
								<option value='20'>20</option>
								<option value='30'>30</option>
								<option value='40'>40</option>
								<option value='50'>50</option>
							</select>
							<select>
								<option value='AM'>AM</option>
								<option value='PM'>PM</option>
							</select>
							</td>
	</tr>
	<tr>
		<td>Location Lost:</td><td><?php echo $menu ?></td>
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