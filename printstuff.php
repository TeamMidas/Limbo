<!--
Author: Stanley Yang, Antony Liang

This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Create a query to get the number, first name, and last name sorted by number
$query = 'SELECT create_date, status, name FROM stuff' ;

# Execute the query
$results = mysqli_query( $dbc , $query ) ;

# Show results
if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<H1>Lost Stuff</H1>' ;
  echo '<TABLE BORDER = 1>';
  echo '<TR>';
  echo '<TH>Date</TH>';
  echo '<TH>Status</TH>';
  echo '<TH>Stuff</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . date("d/m/Y", strtotime($row['create_date'])) . '</TD>' ;
    echo '<TD>' . $row['status'] . '</TD>' ;
    echo '<TD>' . $row['name'] . '</TD>';
	echo '</TR>' ;
  }

  # End the table
  echo '</TABLE>';

  # Free up the results in memory
  mysqli_free_result( $results ) ;
}
else
{
  # If we get here, something has gone wrong
  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
}

# Close the connection
mysqli_close( $dbc ) ;
?>
</html>