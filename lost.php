<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>

	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
 	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

</head>
<body>

<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<h1>Lost Item</h1>
<h4 style='margin-top:-15px'>Please fill out your contact information and information pertaining to the item you lost</h4>


<script>
//Creates the calendar
  $(function() {
    $( "#datepicker" ).datepicker();
  });
</script>


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

$menu="<select name='Locations'>
		" . $options . "
		</select>";

#create Time Lost dropdown
$hours = '';
$minutes = '';

for ($i=1; $i<13; $i++){
	$hours .="<option>" . $i . "</option>";
}

for ($i=0; $i<61; $i++){
	$minutes .="<option>" . $i . "</option>";
}


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
		<td>Date Lost:</td><td><input type="text" name="datepicker" id="datepicker" /></td>
	</tr>
	<tr>
		<td>Time Lost:</td><td>
							<select name='hour'><?php echo $hours?></select>
							<select name='minute'><?php echo $minutes?></select>
							<select name='AMPM'>
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