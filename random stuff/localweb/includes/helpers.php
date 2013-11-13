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

# Inserts a record into the prints table
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

#checks if it is a valid number greater than 0
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

?>