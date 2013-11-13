<!DOCTYPE html>
<html>
<head>
<title>ADMIN'S Limbo</title>
</head>
<body>
<?php
require( 'includes/connect_db.php' ) ;

$query = 'SELECT create_date, status, name FROM stuff ORDER BY create_date DESC' ;

$results = mysqli_query($dbc, $query) ;


echo "<a href='./lost.php' style='margin-right:10px'>Lost Something</a>" ;
echo "<a href='./found.php' style='margin-right:10px'>Found Something</a>" ;
echo "<a href='./admin.php'>Admins</a>" ;
echo "<h1>Welcome to Limbo!</h1>" ;
echo "<h4 style='margin-top:-15px'>If you lost or found something, you're in luck: this is the place to report it.</h4>" ;
echo "<h3 style='display:inline'>Reported in last </h3>" ;
#dropdown menu
echo "<select style='margin-bottom:10px'>" ;
echo "<option value='week'>7 days</option>" ;
echo "<option value='month'>1 month</option>" ;
echo "<option value='trimonth'>3 months</option>" ;
echo "</select>" ;

if( $results )
{
  # But...wait until we know the query succeeded before
  # starting the table.
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

?>
</body>
</html>