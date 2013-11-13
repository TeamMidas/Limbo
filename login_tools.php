<!--
Stanley Yang
Antony Liang

-->
<?php

# Includes these helper functions
require( 'includes/helpers.php' ) ;

# Loads a specified or default URL.
function load( $page = 'admin.php')
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page ;
  
  # Execute redirect then quit.
  session_start();

  header( "Location: $url" ) ;

  exit() ;
}

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
    show_query($query) ;

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
?>