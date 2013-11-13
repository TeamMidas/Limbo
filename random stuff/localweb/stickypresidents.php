<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.

  By: Stanley Yang, Antony Liang
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$fname = $_POST['fname'] ;
	$lname = $_POST['lname'] ;
    $number = $_POST['Number'] ;

    if(!valid_number($number))
		echo '<p style="color:red"> Please input a positive integer for Number</p>';
	else if(!valid_name($fname))
		echo '<p style="color:red"> Please input a first name</p>';
		else if(!valid_name($lname))
			echo '<p style="color:red"> Please input a last name</p>';
			else {
			$result = insert_record($dbc, $number, $fname, $lname) ;
			}
	
}

# Show the records
show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="stickypresidents.php" method="POST">
<table>
<tr>
<td>Number:</td><td><input type="text" name="Number" value="<?php if (isset($_POST['Number'])) echo $_POST['Number']; ?>"></td>
</tr>
<tr>
<td>First Name:</td><td><input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" ></td>
</tr>
<tr>
<td>Last Name:</td><td><input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>