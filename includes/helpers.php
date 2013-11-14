<!--

By: Stanley Yang, Antony Liang

-->

<?php
$debug = true;

# Shows the records in prints
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT number, fname, lname FROM presidents ORDER BY number ASC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Dead Presidents</H1>' ;
  		echo '<TABLE BORDER = 1>';
  		echo '<TR>';
		echo '<TH>Number</TH>';
  		echo '<TH>First Name</TH>';
  		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
			echo '<TD>' . $row['number'] . '</TD>' ;
    		echo '<TD>' . $row['fname'] . '</TD>' ;
    		echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_link_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT number, lname FROM presidents ORDER BY number ASC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Dead Presidents</H1>' ;
  		echo '<TABLE BORDER = 1>';
  		echo '<TR>';
		echo '<TH>Number</TH>';
  		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
			$alink = '<A HREF=linkypresidents.php?number=' . $row['number'] . '>' . $row['number'] . '</A>' ;
    		echo '<TR>' ;
			echo '<TD ALIGN=right>' . $alink . '</TD>' ;
    		echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_record($dbc, $num) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT number, fname, lname FROM presidents WHERE number = ' . $num ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Requested President</H1>' ;
  		echo '<TABLE BORDER = 1>';
  		echo '<TR>';
		echo '<TH>Number</TH>';
  		echo '<TH>First Name</TH>';
  		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
			echo '<TD>' . $row['number'] . '</TD>' ;
    		echo '<TD>' . $row['fname'] . '</TD>' ;
    		echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function insert_record($dbc, $number, $fname, $lname) {
  $query = 'INSERT INTO presidents(number, fname, lname) VALUES (' . $number . ' , "' . $fname . '", "' . $lname . '" )' ;
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

# Shows the query as a debugging aid
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
# Inserts user inputs from Lost page into database
function insert_lost($dbc, $first_name, $last_name, $phone_number, $email, $item_name, $date, $location, $description, $pic){
  $owner = $first_name . ' ' . $last_name ;
  $createdate = date($date);

  $query = "SELECT id FROM locations WHERE name = " . "'" . $location . "'" ;
  
  $result = mysqli_query($dbc,$query) ;
  $location_id = -1;

  while($row = mysqli_fetch_array($result)){
    #echo $row['id'];
    $location_id = $row['id'];
  }

  $query = 'INSERT INTO stuff(location_id, name, description, create_date, owner, email, phone) VALUES (' . $location_id . ',' . "'" . $item_name . "'" . ',' .  "'" . $description . "'". ',' . $createdate . ',' . "'" . $owner . "'" . ',' . "'" . $email . "'" . ',' . $phone_number . ')' ;
 
  show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}


?>