<!--
Limbo Project
By: Stanley Yang, Antony Liang

-->

<!DOCTYPE html>
<html>
<head>
<title>ADMIN'S Limbo</title>
</head>
<body>

<a href='./adminHome.php' style='margin-right:10px'>Home</a>
<a href='./lost.php' style='margin-right:10px'>Lost Something</a>
<a href='./found.php' style='margin-right:10px'>Found Something</a>
<a href='./adminManagement.php' style='margin-right:10px'>Admins Management</a>
<a href='./adminMessages.php' style='margin-right:10px'>Admins Messages</a>
<a href='./accountChanges.php' style='margin-right:10px'>Change Account Info</a>
<a href='./limbo.php' >Log Out</a>


<h1>Welcome Admin!</h1>
<h4 style='margin-top:-15px'>If you lost or found something, you're in luck: this is the place to report it.</h4>
<h3 style='display:inline'>Reported in last </h3>

<form action="adminHome.php" method="GET" style='display:inline'>
<select id="timeFilter" name="timeFilter" style='margin-bottom:10px'>
	<option value='0' selected="selected">7 days</option>
	<option value='1'>1 month</option>
	<option value='2'>3 months</option>
</select>
<p style='display:inline'><input type="submit"></p>
<form>

<?php
require( 'includes/connect_db.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
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

if( $results ){

	$id = 0 ;
	
	echo '<TABLE class="list">';
	echo '<TR>';
	echo '<TH class="none"></TH>' ;
	echo '<TH>Reported On</TH>';
	echo '<TH>Status</TH>';
	echo '<TH>Stuff</TH>';
	echo '<TH class="none"></TH>';
	echo '</TR>';
  
  
  	#sets timezone
	date_default_timezone_set('America/New_York');

	$week = mktime(0, 0, 0, date("m"), date("d")-7, date("Y"));
	$month = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
	$trimonth = mktime(0, 0, 0, date("m")-3, date("d"), date("Y"));
	$targetTime = $week;
	$filter = 0;
	$targetTime = $week;
	
	#POST timeFilter to get its value
	if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET' AND isset($_GET['timeFilter'])){
		#values: 0, 1, 2
		$filter = $_GET['timeFilter'];
		if($filter == 0){
			$targetTime = $week;
		}
		if($filter == 1){
			$targetTime = $month;
		}
		if($filter == 2){
			$targetTime = $trimonth;
		}
	}

	# For each row result, generate a table row
	while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
	
		$itemTime = strtotime($row['create_date']);

		if($itemTime >= $targetTime){

			$alink = '<A HREF=iteminfo.php?itemid=' . $row['id'] . '>' . $row['name'] . '</A>' ;
			$id = $row['id'] ;
			echo '<TR>' ;
			echo '<TD class = "none"> <form action="adminHome.php" method="POST"> <input type="hidden" name="remove" value = "' . $id . '"> <input type="submit" value = "" class = "redButton"> </form> </TD>' ;
			echo '<TD>' . date("M d Y", strtotime($row['create_date'])) . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '<TD ALIGN=left>' . $alink . '</TD>' ;
			echo '<TD ALIGN=left class = "none"> <form action="adminHome.php" method="POST"> <input type="hidden" name="claimed" value = "' . $id . '"> <input type="submit" value = "" class = "greenCheck"> </form> </TD>' ;
			echo '</TR>' ;
			
		}
	}

	# End the table
	echo '</TABLE>';

	# Free up the results in memory
	mysqli_free_result( $results ) ;
}
else{
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