<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>
</head>
<body>
<?php
require( 'includes/connect_db.php' ) ;

$query = 'SELECT create_date, location_id, description FROM stuff ORDER BY create_date DESC' ;

$results = mysqli_query($dbc, $query) ;


echo "<a href='./lost.php'>Lost Something</a>" ;
echo "<a href='./found.php'>Found Something</a>" ;
echo "<a href='./admin.php'>Admins</a>" ;
echo "<h1>Welcome to Limbo!</h1>" ;
echo "<p>If you lost or found something, you're in luck: this is the place to report it." ;
echo "<h4>Reported in last</h4>" ;
#dropdown menu
echo "<select>" ;
echo "<option value='7'>7 days</option>" ;
echo "<option value='30'>30 days</option>" ;
echo "<option value='365'>1 year</option>" ;
echo "</select>" ;

if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<TABLE BORDER = 1>';
  echo '<TR>';
  echo '<TH>Create Date</TH>';
  echo '<TH>Location</TH>';
  echo '<TH>Description</TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
    echo '<TR>' ;
    echo '<TD>' . $row['create_date'] . '</TD>' ;
    echo '<TD>' . $row['location_id'] . '</TD>' ;
    echo '<TD>' . $row['description'] . '</TD>';
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

?>
</body>
</html>