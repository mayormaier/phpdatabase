<?php 
// username and password to connect to the database
$user
$password 
// database name that you are connecting to
$db = "mayormai_covidDash4";

// "localhost" implies that this is a connection internal to the server
// the IP based version is 127.0.0.1 and this can be tweaked to connect
// to remote system as well if permissions are set appropriately
// in the database
$host = "localhost"; 
$link = mysqli_connect($host, $user, $password, $db);

// run a query that shows all the tables we have
$table = $_GET['table'];
//$name = $_GET['name'];
//$main = ($_GET['main'] == "on") ? true : false;

$exercise = ($_GET['exercise'] == "on") ? 1 : 0;
$wash = ($_GET['wash'] == "on") ? 1 : 0;
$travel = ($_GET['travel'] == "on") ? 1 : 0;
$dist = ($_GET['dist'] == "on") ? 1 : 0;
$gather = ($_GET['gather'] == "on") ? 1 : 0;
$mask = ($_GET['mask'] == "on") ? 1 : 0;

print "INSERT INTO $table (Exercise, HandHygene, Travel, SocialDist, GatheringAttend, WearMask) VALUES (\"$exercise\", \"$wash\", \"$travel\", \"$dist\", \"$gather\", \"$mask\")";
$response = mysqli_query($link, "INSERT INTO $table (Exercise, HandHygene, Travel, SocialDist, GatheringAttend, WearMask) VALUES (\"$exercise\", \"$wash\", \"$travel\", \"$dist\", \"$gather\", \"$mask\")");
mysqli_close($link);
?>
<a href="db2.php">go back</a>
