<!--
Limbo Project
By: Stanley Yang, Antony Liang

-->
<?php

# Includes these helper functions
require( 'includes/helpers.php' ) ;

# Validates the print name.
# Returns -1 if validate fails, and >= 0 if it succeeds
# which is the primary key id.
function validate($email = '', $pass = '')
{
    global $dbc;

    if(empty($pass))
      return -1 ;

    # Make the query
    $query = "SELECT email, pass FROM users WHERE email='" . $email . "' AND pass= PASSWORD('" . $pass . "')" ;
    #show_query($query) ;

    # Execute the query
    $results = mysqli_query( $dbc, $query ) ;
    check_results($results);

    # If we get no rows, the logging
    if (mysqli_num_rows( $results ) == 0 )
      return -1 ;

    # We have at least one row, so get the first one and return it
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;

    return 1 ;
}

function changePassword($email = '', $pass = ''){
	global $dbc;
	
	$query = "UPDATE users SET pass = PASSWORD('" . $pass . "') WHERE email = '" . $email . "'";
	show_query($query) ;
	$results = mysqli_query( $dbc, $query ) ;
	check_results($results);
}
?>