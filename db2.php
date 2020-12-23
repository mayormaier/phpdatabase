<html>
    <head>
        <title>MySQL + PHP database app example</title>
        <base href="/"/>
    </head>
    <body>
<?php 
// username and password to connect to the database
$user  
$password  
// database name that you are connecting to
$db 

// "localhost" implies that this is a connection internal to the server
// the IP based version is 127.0.0.1 and this can be tweaked to connect
// to remote system as well if permissions are set appropriately
// in the database
$host = "localhost"; 
$link = mysqli_connect($host, $user, $password, $db);
// this will throw an error if we could not establish a connection
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
// a simple message to tell you that it connected
echo "<h1>Success: A proper connection to MySQL was made!</h1><br/>The <strong>$db</strong> database is great.<br/>";
echo "<p>Host information: " . mysqli_get_host_info($link) . "</p>";
// run a query that shows all the tables we have
$query = mysqli_query($link, "SHOW TABLES FROM $db");
// loop through and print the response
echo "<h1>Tables</h1>";
while ($data = mysqli_fetch_array($query)) { // go through each row that was returned in $query
    // print the table name
    echo('<h2>' . $data[0] . "</h2>");
    // build a new query to show the columns
    $query2 = mysqli_query($link, "SHOW COLUMNS FROM $db.$data[0]");
    // make an unordered list
    echo "<ul>";
    while ($table = mysqli_fetch_array($query2)) {
        // print field name - data type and if it can be null)
        echo('<li><strong>' . $table['Field'] . "</strong> - " . $table['Type'] . " - " . ($table['Null'] == "NO" ? "NOT NULL" : "NULL") . "</li>");    // print the table that was returned on that row.
    }
    echo "</ul>";
}

print "<h1>Behaviors</h1>";
// query to list behaviors table
$query = mysqli_query($link, "SELECT Behaviors.BehaviorID as BehaviorID, Behaviors.Exercise as Exercise, Behaviors.HandHygene as Wash, Behaviors.Travel as Travel, Behaviors.SocialDist as Dist, Behaviors.GatheringAttend as Gather, Behaviors.WearMask as Mask FROM Behaviors");
print "<table style='text-align=center;' border='1px'>
    <tr>
        <th>Behavior ID</th>
        <th>Exercise</th>
        <th>Hand Washing</th>
        <th>Travel</th>
        <th>Social Distancing</th>
        <th>Gatherings</th>
        <th>Mask Wearing</th>
    </tr>";

while ($data = mysqli_fetch_array($query)) {
    print "
    <tr>" .
        "<td>" . $data["BehaviorID"] . "</td>" .
        "<td>" . ($data["Exercise"] ? "TRUE" : "FALSE") . "</td>" .
        "<td>" . ($data["Wash"] ? "TRUE" : "FALSE") . "</td>" .
        "<td>" . ($data["Travel"] ? "TRUE" : "FALSE") . "</td>" .
        "<td>" . ($data["Dist"] ? "TRUE" : "FALSE") . "</td>" .
        "<td>" . ($data["Gather"] ? "TRUE" : "FALSE") . "</td>" .
        "<td>" . ($data["Mask"] ? "TRUE" : "FALSE") . "</td>" ;
}
print "</table>";
mysqli_close($link);
?>
<h1>Insert new data</h1>
<form action="/insert.php" method="GET">
    <input type="hidden" name="table" value="Behaviors"/><br>

    <label for="exercise">Exercise?</label>
    <input type="checkbox"name="exercise"/><br><br>

    <label for="wash">Hand Washing?</label>
    <input type="checkbox"name="wash"/><br><br>

    <label for="travel">Travel</label>
    <input type="checkbox"name="travel"/><br><br>

    <label for="dist">Social Distancing?</label>
    <input type="checkbox"name="dist"/><br><br>

    <label for="gather">Gatherings?</label>
    <input type="checkbox"name="gather"/><br><br>

    <label for="mask">Mask Wearing?</label>
    <input type="checkbox"name="mask"/><br><br><br>

    <input type="submit"/>
</form>
</body>
</html>
