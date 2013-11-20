<!--

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
<a href='./admin.php'>Admins</a>
<h1>Contact Admins</h1>

<?php
require( 'includes/connect_db.php' ) ;

require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

	$name = $_POST['name'] ;
	$email = $_POST['email'] ;
	$item = $_POST['item'] ;
	$subject = $_POST['subject'] ;
	$message = $_POST['message'] ;
	
	$error = false ;
	if(!valid_name($name)){
		#throw an error
		echo '<p style="color:red">Please enter a name</p>';
		$error = true;
	}
	
	if(!valid_name($name)){
		#throw an error
		echo '<p style="color:red">Please enter a name</p>';
		$error = true;
	}
	
	if(!valid_email($email)){
		#throw an error
		echo '<p style="color:red">Please enter a valid email</p>';
		$error = true;
	}
	
	if(!valid_name($subject)){
		#throw an error
		echo '<p style="color:red">Please enter a subject</p>';
		$error = true;
	}
	
	if(!valid_name($message)){
		#throw an error
		echo '<p style="color:red">Please enter a message</p>';
		$error = true;
	}
	
	if(!$error){
	
		if(valid_number($item)){
			
			echo '<p> HAD AN ITEM </p>' ;
			
			$query = 'INSERT INTO messages(name, create_date, email, subject, message, item_id) VALUES ("' . $name . '", Now(), "' . $email . '", "' . $subject . '" , "' . $message . '" , ' . $item . ')' ;
		}
		else{
			
			$query = 'INSERT INTO messages(name, create_date, email, subject, message) VALUES ("' . $name . '", Now(), "' . $email . '", "' . $subject . '" , "' . $message . '"' . ')' ;
			
		}
		
		$results = mysqli_query($dbc,$query) ;
		check_results($results) ;
		
		echo '<p> Thank you for your message. </p>' ;
	}

}

mysqli_close( $dbc ) ;
?>

<form action="contactAdmin.php" method="POST">
<table>
	Please fill out this form to contact the admins
	<tr>
		<td>Name:</td><td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>Email Address:</td><td><input type="text" name="email" ></td>
	</tr>
	<tr>
		<td>Item (If applicable) :</td><td><input type="text" name="item" ></td>
	</tr>
	<tr>
		<td>Subject: </td><td><input type="text" name="subject" ></td>
	</tr>
	<tr>
		<td>Message:</td><td><textarea name="message"></textarea> </td>
	</tr>
	
</table>
<p><input type="submit" ></p>
</form>

</body>
</html>