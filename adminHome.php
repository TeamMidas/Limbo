<!DOCTYPE html>
<html>
<head>
<title>ADMIN'S Limbo</title>
</head>
<body>

<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./admin.php'>Admins</a>
<a href='./accountChanges.php'>Change Account Info</a>
<h1>Welcome Admin!</h1>
<h4 style='margin-top:-15px'>If you lost or found something, you're in luck: this is the place to report it.</h4>
<h3 style='display:inline'>Reported in last </h3>

<select style='margin-bottom:10px'>
<option value='week'>7 days</option>
<option value='month'>1 month</option>
<option value='trimonth'>3 months</option>
</select>

<?php
require( 'includes/connect_db.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$theID = -1;
	
	if(isset($_POST['remove'])){
		$theID = $_POST['remove'] ;
		$deleteQuery = 'DELETE FROM stuff WHERE id = ' . $theID ;
		$deleteResults = mysqli_query($dbc, $deleteQuery) ;
	}
	
	if(isset($_POST['claimed'])){
		$theID = $_POST['claimed'] ;
		$claimQuery = 'UPDATE stuff SET status = "claimed" WHERE id = ' . $theID ;
		$updateResults = mysqli_query($dbc, $claimQuery) ;
	}
	
}

$query = 'SELECT id, create_date, status, name FROM stuff ORDER BY create_date DESC' ;

$results = mysqli_query($dbc, $query) ;

if( $results )
{

  $id = 0 ;
  # But...wait until we know the query succeeded before
  # starting the table.
  echo '<TABLE class="list">';
  echo '<TR>';
  echo '<TH class="none"></TH>' ;
  echo '<TH>Date</TH>';
  echo '<TH>Status</TH>';
  echo '<TH>Stuff</TH>';
  echo '<TH class="none"></TH>';
  echo '</TR>';

  # For each row result, generate a table row
  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  {
	$id = $row['id'] ;
    echo '<TR>' ;
	echo '<TD class = "none"> <form action="adminHome.php" method="POST"> <input type="hidden" name="remove" value = "' . $id . '"> <input type="submit" value = "" class = "redButton"> </form> </TD>' ;
    echo '<TD>' . date("d/m/Y", strtotime($row['create_date'])) . '</TD>' ;
    echo '<TD>' . $row['status'] . '</TD>' ;
    echo '<TD>' . $row['name'] . '</TD>';
	echo '<TD class = "none"> <form action="adminHome.php" method="POST"> <input type="hidden" name="claimed" value = "' . $id . '"> <input type="submit" value = "" class = "greenCheck"> </form> </TD>' ;
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

<style>
.redButton {
    background:url(/images/redbutton.PNG) no-repeat;
    cursor:pointer;
    width: 15px;
    height: 15px;
    border: none;
}

.greenCheck {
    background:url(/images/greencheck.PNG) no-repeat;
    cursor:pointer;
    width: 20px;
    height: 15px;
    border: none;
}

.list {
	BORDER: solid 1px black;
}

.list td{
	BORDER: solid 1px black;
}

.list td.none{
	border-style: none;
}

.list th{
	BORDER: solid 1px black;
}

.list th.none{
	border-style: none;
}
</style>

</html>