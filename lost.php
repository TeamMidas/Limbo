<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>

	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
 	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

</head>
<body>

<a href='./limbo.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<h1>Lost Item</h1>
<h4 style='margin-top:-15px'>Please fill out your contact information and information pertaining to the item you lost</h4>


<script>
//Creates the calendar
  $(function() {
    $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
  });


</script>


<?php
require( 'includes/connect_db.php' ) ;
require( 'includes/helpers.php' ) ;

$query = 'SELECT name FROM locations ORDER BY name ASC' ;

$results = mysqli_query($dbc, $query) ;

#populate locations dropdown menu
$options = '';

while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
{
	$options .="<option>" . $row['name'] . "</option>";
}

$menu="<select name='location'>
		" . $options . "
		</select>";

#hook up the submit button
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	#all the user inputs
	$first_name = $_POST['first_name'] ;
	$last_name = $_POST['last_name'] ;
	$phone_number = $_POST['phone_number'] ;
	$email = $_POST['email'] ;
	$item_name = $_POST['item_name'] ;
	$date = $_POST['datepicker'] ;

	$location = $_POST['location'] ;
	$description = $_POST['description'] ;

	$pic = '';
	if(!empty($_POST['pic'])){
		$pic = $_POST['pic'] ;
	}
	#validate inputs
	#0 is okay, 1 is bad
	$error = false;
	if(!valid_name($first_name)){
		#throw an error
		echo '<p style="color:red">Please enter a first name</p>';
		$error = true;
	}
	if(!valid_name($last_name)){
		#throw an error
		echo '<p style="color:red">Please enter a last name</p>';
		$error = true;
	}
	if(!valid_phone($phone_number)){
		#throw an error
		echo '<p style="color:red">Please enter a valid phone number</p>';
		$error = true;
	}
	if(!valid_email($email)){
		#throw an error
		echo '<p style="color:red">Please enter a valid email address</p>';
		$error = true;
	}
	if(!valid_name($item_name)){
		#throw an error
		echo '<p style="color:red">Please enter a item name</p>';
		$error = true;
	}
	if(!valid_date($date)){
		#throw an error
		echo '<p style="color:red">Please choose a date</p>';
		$error = true;
	}
	#time and location will always be valid since they are enumerated
	if(!valid_description($description)){
		#throw an error
		echo '<p style="color:red">Please provide a description</p>';
		$error = true;
	}
	#submit
	if(!$error){
		$input = insert_lost($dbc, $first_name, $last_name, $phone_number, $email, $item_name, $date, $location, $description, $pic) ;
	}
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
	<caption style='width:262px'>Item Information</caption>
	<tr>
		<td>Item Name:</td><td><input type="text" name="item_name" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>" ></td>
	</tr>
	<tr>
		<td>Date Lost:</td><td><input type="text" name="datepicker" id="datepicker" /></td>
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