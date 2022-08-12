<!DOCTYPE html>
<html>
</body>
 <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aysegul_yilmaz";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT COUNT(rooms.room_id) AS ROOMS, roomtypes.room_type AS ROOM_TYPE, hotels.hotel_name AS HOTEL_NAME FROM rooms INNER JOIN hotels ON hotels.hotel_id = rooms.hotel_id  INNER JOIN roomtypes ON roomtypes.roomtype_id = rooms.roomtype_id INNER JOIN bookings ON rooms.room_id= bookings.room_id WHERE  bookings.room_id IN (SELECT bookings.room_id FROM bookings);";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    echo "<table border='1'>";
    echo "<tr><td>ROOMS</td><td>ROOM_TYPE</td><td>HOTEL_NAME</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["ROOMS"]. "</td><td>" . $row["ROOM_TYPE"]. "</td><td>" . $row["HOTEL_NAME"]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
    echo $_POST['showhotelname'];
}
mysqli_close($conn);


?>

  </html>
