<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aysegul_yilmaz";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$sql = "SELECT distinct(city) FROM places ";
$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<form action='FilterHotelsByCityDate.php' method='post'>";
	echo '<select name="hotelsbycitydate">';
    while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["city"] . "'>";
        echo $row["city"];
		echo "</option>";
    }
	echo '</select>';
    echo '<label for="date">Start Date:</label>';
    echo '<input type="date" id="End Date" name="Start">';
    
    echo '<label for="date">End Date:</label>';
    echo '<input type="date" id="End Date" name="End">';
    
    echo '<input type="submit" value="Submit">';
	echo "</form>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>

</body>
</html>
