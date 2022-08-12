<?php
    //CSE 348-PROJECT
    //AYSEGUL YILMAZ
    //20180702076


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aysegul_yilmaz";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn->connect_error)
{
    die("Connection failed:\n" . mysqli_connect_error());
}
else
{
    echo "Connection Successfull\n";
}

$city_name= $_POST['hotelsbycitydate'];
$start_date = $_POST['Start'];
$end_date = $_POST['End'];
$sql ="SELECT hotels.hotel_id AS HOTEL_ID, hotels.hotel_name AS HOTEL_NAME ,COUNT(rooms.room_id) AS ROOMS FROM hotels
INNER JOIN rooms ON rooms.hotel_id = hotels.hotel_id
INNER JOIN bookings ON bookings.room_id = rooms.room_id
INNER JOIN places ON places.place_id = hotels.place_id
WHERE '$city_name' = places.city AND bookings.booking_date BETWEEN '$start_date' AND '$end_date'
GROUP BY hotels.hotel_name;";


$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    echo "<table border='1'>";
    echo "<tr><td>HOTEL_ID</td><td>HOTEL_NAME</td><td>ROOMS</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["hotel_id"]. "</td><td>" . $row["hotel_name"]. "</td><td>" . $row["rooms"]. "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>

