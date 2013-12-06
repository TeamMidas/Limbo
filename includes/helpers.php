<!--
Limbo Project
By: Stanley Yang, Antony Liang

-->

<?php
$debug = true;

# Shows the records in prints
function show_stuff($dbc) {
$query = 'SELECT create_date, status, name FROM stuff ORDER BY create_date DESC' ;

$results = mysqli_query($dbc, $query) ;

	if( $results ){
	  # starting the table.
		echo '<TABLE BORDER = 1>';
		echo '<TR>';
		echo '<TH>Date</TH>';
		echo '<TH>Status</TH>';
		echo '<TH>Stuff</TH>';
		echo '</TR>';

		#sets timezone
		date_default_timezone_set('America/New_York');

		$week = mktime(0, 0, 0, date("m"), date("d")-7, date("Y"));
		$month = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
		$trimonth = mktime(0, 0, 0, date("m")-3, date("d"), date("Y"));
		$targetTime = $week;
		$filter = 0;

		#POST timeFilter to get its value
		if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST'){
			#values: 0, 1, 2
			$filter = $_POST['timeFilter'];
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

			#convert create_date to time
			$itemTime = strtotime($row['create_date']);

			if($itemTime >= $targetTime){

				$alink = '<A HREF=iteminfo.php?itemname=' . $row['name'] . '>' . $row['name'] . '</A>' ;
				echo '<TR>' ;
				echo '<TD>' . date("M d Y", strtotime($row['create_date'])) . '</TD>' ;
				echo '<TD>' . $row['status'] . '</TD>' ;
				echo '<TD ALIGN=left>' . $alink . '</TD>' ;
				echo '</TR>' ;

			}
		}

		# End the table
		echo '</TABLE>';

		# Free up the results in memory
		mysqli_free_result( $results ) ;
		}
	else {
			# If we get here, something has gone wrong
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
}

function show_messages($dbc) {
$query = 'SELECT id, name, create_date, email, subject, item_id, message FROM messages ORDER BY create_date DESC' ;

$results = mysqli_query($dbc, $query) ;

	if( $results ){
	  # starting the table.
		echo '<TABLE BORDER = 1>';
		echo '<TR>';
		echo '<TH class="none"></TH>' ;
		echo '<TH>Date</TH>';
		echo '<TH>From</TH>';
		echo '<TH>Subject</TH>';
		echo '</TR>';

			# For each row result, generate a table row
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo '<TR onclick="toggleInfo(' . $row['id'] .  ')");" >' ;
			echo '<TD class = "none"> <form action="adminMessages.php" method="POST"> <input type="hidden" name="remove" value = "' . $row['id'] . '"> <input type="submit" value = "" class = "redButton"> </form> </TD>' ;
			echo '<TD>' . date("M d Y", strtotime($row['create_date'])) . '</TD>' ;
			echo '<TD>' . $row['name'] . '</TD>' ;
			echo '<TD>' . $row['subject'] . '</TD>' ;
			echo '</TR>' ;
			
			echo '<TR id=' . $row['id'] . ' style="display:none">' ;
			echo '<td BORDER: solid 0px black;> </td>' ;
			if( !empty($row['item_id'])){
				echo '<td colspan="3"> ' .$row['message']  . '<br> Regarding item '. $row['item_id'] . '<br> <form method="post" action="mailto:' . $row['email'] . '" > <input type="submit" value="Reply" /> </form> </td>';
			}
			else{
				echo '<td colspan="3"> ' .$row['message']  . '<br> <form method="post" action="mailto:' . $row['email'] . '" > <input type="submit" value="Reply" /> </form> </td>';
			}
			echo '</TR>' ;

		}

		# End the table
		echo '</TABLE>';

		# Free up the results in memory
		mysqli_free_result( $results ) ;
		}
	else {
			# If we get here, something has gone wrong
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
}

function show_item($dbc, $name) {

	$query = 'SELECT owner FROM stuff WHERE name = "' . $name . '"';
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;
	$row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ;
	
	
	if($row['owner'] != NULL){
		$query = 'SELECT s.name, s.description, s.create_date, s.status, s.owner, s.email, s.phone, l.name AS location FROM stuff s INNER JOIN locations l ON l.id = s.location_id WHERE s.name = "' . $name . '"';
	}
	
	else {
		$query = 'SELECT s.name, s.description, s.create_date, s.status, s.finder, s.email, s.phone, l.name AS location FROM stuff s INNER JOIN locations l ON l.id = s.location_id WHERE s.name = "' . $name . '"';
	}
	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{

  		echo '<TABLE BORDER = 1>';


  		$row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ;

		echo '<h1>' . $row['name'] . '</h1>' ;
		
		echo '<TR>' ;
		echo '<TH>Date</TH>';
		echo '<TD>' . date("d/m/Y", strtotime($row['create_date'])) . '</TD>' ;
		echo '</TR>' ;
		echo '<TR>' ;
		echo '<TH>Status</TH>';
		echo '<TD>' . $row['status'] . '</TD>' ;
		echo '</TR>' ;
		echo '<TR>' ;
		echo '<TH>Location</TH>';
		echo '<TD>' . $row['location'] . '</TD>' ;
		echo '</TR>' ;
		echo '<TR>' ;
		echo '<TH>Description</TH>';
		echo '<TD>' . $row['description'] . '</TD>' ;
		echo '</TR>' ;
 

  		# End the table
  		echo '</TABLE>';

		echo '<button type="button" onclick="toggleInfo();">More Info</button>';
		
		echo '<TABLE BORDER = 1 id = "info" style="display:none">';

  		# For each row result, generate a table row

		echo '<TH> Contact Information </TH>' ;
		
		echo '<TR>' ;
		echo '<TH>Name</TH>';
		if(isset($row['owner'])){
			echo '<TD>' . $row['owner'] . '</TD>' ;
		}
		else {
			echo '<TD>' . $row['finder'] . '</TD>' ;
		}
		echo '</TR>' ;
		echo '<TR>' ;
		echo '<TH>Email</TH>';
		echo '<TD>' . $row['email'] . '</TD>' ;
		echo '</TR>' ;
		echo '<TR>' ;
		echo '<TH>Phone</TH>';
		echo '<TD>' . $row['phone'] . '</TD>' ;
		echo '</TR>' ;

  		# End the table
  		echo '</TABLE>';
		
  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}
#checks if number is empty, non-numeric, or less than 0
function valid_number($num){
  if(empty($num) || !is_numeric($num)){
    return false;
    }
  else {
    $num = intval($num);
    if($num <= 0)
      return false;
  }
  return true;
}
#checks if the name is empty
function valid_name($name){
  if(empty($name)){
    return false;
    }
  else
    return true;
}
function valid_phone($phone){
  if(empty($phone)){
    return false;
  }
  if(strlen($phone) > 10){
    #check for '-'
    if(strpos($phone, '-') !== false){
      #replace all '-' found
      $phone = str_replace('-', '', $phone);
    }
    else{
      return false;
    }
  }
  else
    return true;
}
function valid_email($email){
  if(empty($email) || (strpos($email, '@') === false)){
    return false;
  }
  else
    return true;
}
function valid_date($date){
  if(empty($date)){
    return false;
    }
  else
    return true;
}
function valid_description($description){
  if(empty($description)){
    return false;
    }
  else
    return true;
}
function valid_location($location){
	if($location === "Select a location"){
		return false;
	}
	else
		return true;
}

function load( $page = 'admin.php'){
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page ;
  
  # Execute redirect then quit.
  session_start();

  header( "Location: $url" ) ;

  exit() ;
}

# Inserts user inputs from Lost page into database
function insert_lost($dbc, $first_name, $last_name, $phone_number, $email, $item_name, $date, $location, $description, $pic){
  $owner = $first_name . ' ' . $last_name ;
  $createdate = "'" . $date . "'";

  $query = "SELECT id FROM locations WHERE name = " . "'" . $location . "'" ;
  
  $result = mysqli_query($dbc,$query) ;
  $location_id = 1;

  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $location_id = $row['id'];

  $query = 'INSERT INTO stuff(location_id, name, description, create_date, owner, email, phone, status) VALUES (' . $location_id . ',' . "'" . $item_name . "'" . ',' .  "'" . $description . "'". ',' . $createdate . ',' . "'" . $owner . "'" . ',' . "'" . $email . "'" . ',' . $phone_number . ', "lost")' ;
 
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

function insert_found($dbc, $first_name, $last_name, $phone_number, $email, $item_name, $date, $location, $description, $pic){
  $owner = $first_name . ' ' . $last_name ;
  $createdate = "'" . $date . "'";

  $query = "SELECT id FROM locations WHERE name = " . "'" . $location . "'" ;
  
  $result = mysqli_query($dbc,$query) ;
  $location_id = 1;

  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $location_id = $row['id'];

  $query = 'INSERT INTO stuff(location_id, name, description, create_date, finder, email, phone, status) VALUES (' . $location_id . ',' . "'" . $item_name . "'" . ',' .  "'" . $description . "'". ',' . $createdate . ',' . "'" . $owner . "'" . ',' . "'" . $email . "'" . ',' . $phone_number . ', "found")' ;
 
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

function init($dbname){

    # Connect to the database, if we fail assume the DB doesnt exist
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname );

    if($dbc) {
        mysqli_set_charset( $dbc, 'utf8' ) ;
        return $dbc;
    }
	
	$dbc = @mysqli_connect ( 'localhost', 'root', '', '' );
	
	echo '<p> Welcome to Limbo for the first time! </p>' ;
	
	$query = 'CREATE DATABASE limbo_db';
    #show_query( $query );

    $results = mysqli_query($dbc, $query);
    check_results($results);

    # Close connection since we dont need it
    mysqli_close( $dbc );

    # Connect to the (newly created) database
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname )
        OR die ( mysqli_connect_error() ) ;

    # Set encoding to match PHP script encoding.
    mysqli_set_charset( $dbc, 'utf8' ) ;
	
	$sql= file_get_contents('limbo.sql');
	$results = mysqli_multi_query($dbc, $sql);
	mysqli_close( $dbc );
	
	sleep(1);

    return init($dbname);
}

function search_results($dbc, $name) {

$query = 'SELECT s.name, s.description, s.create_date, s.status, s.owner, s.email, s.phone, l.name AS location FROM stuff s INNER JOIN locations l ON l.id = s.location_id WHERE s.name = "' . $name . '"';
	

$query = 'SELECT s.create_date, s.name, l.name AS location FROM stuff s INNER JOIN locations l ON l.id = s.location_id WHERE s.name LIKE "%' . $name . '%" OR s.description LIKE "%' . $name . '%" ORDER BY s.create_date DESC' ;

$results = mysqli_query($dbc, $query) ;

	if( $results ){
	  # starting the table.
		
		$row = mysqli_fetch_array( $results , MYSQLI_ASSOC );
		
		if($row ) {
		
			echo '<TABLE BORDER = 1>';
			echo '<CAPTION> Potential Matches </CAPTION>';
			echo '<TR>';
			echo '<TH>Date</TH>';
			echo '<TH>Name</TH>';
			echo '<TH>Location Found</TH>';
			echo '</TR>';

			#sets timezone
			date_default_timezone_set('America/New_York');

			$week = mktime(0, 0, 0, date("m"), date("d")-7, date("Y"));
			$month = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
			$trimonth = mktime(0, 0, 0, date("m")-3, date("d"), date("Y"));
			$targetTime = $week;
			$filter = 0;

			# For each row result, generate a table row
			do{

				#convert create_date to time
				$itemTime = strtotime($row['create_date']);

				$alink = '<A HREF=iteminfo.php?itemname=' . $row['name'] . '>' . $row['name'] . '</A>' ;
				echo '<TR>' ;
				echo '<TD>' . date("M d Y", strtotime($row['create_date'])) . '</TD>' ;
				echo '<TD ALIGN=left>' . $alink . '</TD>' ;
				echo '<TD>' . $row['location'] . '</TD>';
				echo '</TR>' ;

			} while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ));

			# End the table
			echo '</TABLE>';
			
			echo '<form action="/lostform.php" method="get">
					<input type="submit" value="No Matches?" />
					</form>' ;
			
			echo '<br>';
		}
		
		else{
			
			echo '<p>No Matches were found. Please try a more general term or submit a new entry</p>';
		
		}
		
		# Free up the results in memory
		mysqli_free_result( $results ) ;
		}
	else {
			# If we get here, something has gone wrong
			echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
}

?>