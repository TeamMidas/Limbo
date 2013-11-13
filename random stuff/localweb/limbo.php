<!DOCTYPE html>
<html>
<head>
<title>Limbo</title>
</head>
<body>
<?php
#$logo = "images/dog.png" ;

$welcome = "Welcome to Limbo!" ; 
$lost = "Lost Something" ;
$found = "Found Something" ;
$admins = "Admins" ;

echo "<a href='./lost.php'>" . $lost . "</a>" ;
echo "<a href='./found.php'>" . $found . "</a>" ;
echo "<a href='./admin.php'>" . $admins . "</a>" ;
echo "<h1>" . $welcome . " </h1>" ;
echo "<p>If you lost or found something, you're in luck: this is the place to report it." ;

?>
</body>
</html>