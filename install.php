<?php
    //CSE 348-PROJECT
    //AYSEGUL YILMAZ
    //20180702076


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "aysegul_yilmaz";

$conn = new mysqli($servername,$username,$password);

if($conn->connect_error)
{
    die("Connection failed:\n" . mysqli_connect_error());
}
else
{
    echo "Connection Successfull\n";
}


$sql_db_create = "CREATE DATABASE if not exists aysegul_yilmaz";


if($conn->query($sql_db_create) === TRUE)
{
    echo "Database created\n";
}
else
{
    echo "Error when creating database:\n" . mysqli_connect_error();
}

$conn->close();

$conn2 = mysqli_connect($servername,$username,$password,$dbname);

if($conn2->connect_error)
{
    die("Connection failed:\n" . mysqli_connect_error());
}
else
{
    echo "Connection Successfull\n";
}
$sql_db_create_places = "CREATE TABLE places(place_id INT NOT NULL AUTO_INCREMENT,city VARCHAR(50) NOT NULL,district VARCHAR(50) NOT NULL,PRIMARY KEY(place_id)) ENGINE = INNODB;";
$sql_db_create_hotels = "CREATE TABLE hotels (hotel_id INT NOT NULL AUTO_INCREMENT, hotel_name VARCHAR(50) NOT NULL, place_id INT NOT NULL, FOREIGN KEY (place_id) REFERENCES places(place_id),PRIMARY KEY(hotel_id)) ENGINE = INNODB;";
$sql_db_create_clients = "CREATE TABLE clients (client_id INT NOT NULL AUTO_INCREMENT, client_name VARCHAR(50) NOT NULL,client_surname VARCHAR(50) NOT NULL, PRIMARY KEY(client_id)) ENGINE = INNODB;";
$sql_db_create_facilities = "CREATE TABLE facilities(facility_id INT NOT NULL AUTO_INCREMENT,facility_name VARCHAR(50) NOT NULL,hotel_id INT NOT NULL,FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id),PRIMARY KEY(facility_id))ENGINE = INNODB;";
$sql_db_create_roomtypes = "CREATE TABLE roomtypes(roomtype_id INT NOT NULL AUTO_INCREMENT,room_type VARCHAR(50) NOT NULL,room_price INT NOT NULL,PRIMARY KEY(roomtype_id)) ENGINE=INNODB;";
$sql_db_create_rooms = "CREATE TABLE rooms (room_id INT NOT NULL AUTO_INCREMENT,roomtype_id INT NOT NULL,FOREIGN KEY (roomtype_id) REFERENCES roomtypes(roomtype_id),hotel_id INT NOT NULL,FOREIGN KEY (hotel_id) REFERENCES hotels(hotel_id) ,PRIMARY KEY(room_id))ENGINE = INNODB;";
$sql_db_create_travelagents = "CREATE TABLE travelagents(travelagent_id INT NOT NULL AUTO_INCREMENT,travelagent_name VARCHAR(50) NOT NULL,travelagent_price INT NOT NULL,PRIMARY KEY(travelagent_id))ENGINE=INNODB;";
$sql_db_create_bookings = "CREATE TABLE bookings(booking_id INT NOT NULL AUTO_INCREMENT,booking_date date NOT NULL,checkin_date date NOT NULL,checkout_date date NOT NULL,travelagent_id INT NOT NULL,FOREIGN KEY (travelagent_id) REFERENCES travelagents(travelagent_id),client_id INT NOT NULL,FOREIGN KEY (client_id) REFERENCES clients(client_id),room_id INT NOT NULL,FOREIGN KEY (room_id) REFERENCES rooms(room_id),PRIMARY KEY(booking_id)) ENGINE=INNODB;";
if($conn2->query($sql_db_create_places)=== TRUE)
{
    echo "Places Table created\n";
    echo "</br></br>";
}
else{
    //echo "Error when creating places:\n" . mysqli_connect_error();
   
}

if($conn2->query($sql_db_create_hotels)=== TRUE)
{
    echo "Hotels Table created\n";
    echo "</br></br>";
}
else{
  //echo "Error when creating hotels:\n" . mysqli_connect_error();
    
}

if($conn2->query($sql_db_create_clients) === TRUE)
{
  echo "Clients Table created\n";
  echo "</br></br>";
}
else{
  //echo "Error when creating clients:\n" . mysqli_connect_error();
    
}

if($conn2->query($sql_db_create_facilities)=== TRUE)
{
  echo "Facilities Table created\n";
  echo "</br></br>";
}
else{
  //echo "Error when creating facilities:\n" . mysqli_connect_error();
    
}

if($conn2->query($sql_db_create_roomtypes)=== TRUE)
{
  echo "RoomTypes Table created\n";
  echo "</br></br>";
}
else{
  //echo "Error when creating roomtypes:\n" . mysqli_connect_error();
    
}


if($conn2->query($sql_db_create_rooms) === TRUE)
{
  echo "Rooms Table created\n";
  echo "</br></br>";
}
else{
  //echo "Error when creating rooms:\n" . mysqli_connect_error();
}

if($conn2->query($sql_db_create_travelagents)=== TRUE)
{
  echo "Travel Agents Table created\n";
  echo "</br></br>";
}
else{
  //echo "Error when creating travelagent:\n" . mysqli_connect_error();
    
}

if($conn2->query($sql_db_create_bookings)=== TRUE)
{
  echo "Bookings Table created\n";
  echo "</br></br>";
}
else{
  //echo "Error when creating booking tables:\n" . mysqli_connect_error();
    
}



//INSERT PLACES
$row = 0;
$filename_places = "csv/places.csv";


if(!file_exists($filename_places) || !is_readable($filename_places))
   return FALSE;

if (($handle = fopen($filename_places, 'r')) !== FALSE)
{
    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
    {
    
        $write = "INSERT INTO places (city, district) VALUES ('" . $row[0] . "','" . $row[1] . "');";
        if ($conn2->query($write) === FALSE)
        {
            echo "ERROR District and city added to Places Table!\n";
        }
     
    }
    fclose($handle);
}
    

//INSERT HOTELS
$sql_db_create_fill_hotels = "INSERT INTO hotels (hotel_name,place_id) VALUES('";

$hilton = "hilton";
$wyndham = "wyndham";
$marriott = "marriott";
$kaya = "kaya";
$rixos = "rixos";
$radisson = "radisson";
$dedeman = "dedeman";
$titanic = "titanic";
$divan = "divan";
$greenpark = "greenpark";


$row = 0;
$min =1;
$max = 10;//should have max 10 hotels
$city = 1;
$i = 5;

while($city <=81)
{
    $i = 5;//every city can have 5 random hotels
    while($i > 0)
        {
            $write = $sql_db_create_fill_hotels;
            $random = rand($min, $max);
            if($random === 1 )
                {
                    $write = $write . $hilton;
                    
                }
            if($random === 2)
                {
                    $write = $write . $wyndham;
                }
            if($random === 3)
                {
                $write = $write . $marriott;
                }
            if($random === 4)
                {
                    $write = $write . $kaya;
                }
            if($random === 5)
                {
                    $write = $write . $rixos;
                }
            if($random === 6)
                {
                    $write = $write . $radisson;
                }
            if($random === 7)
                {
                    $write = $write . $dedeman;
                }
            if($random === 8)
                {
                    $write = $write . $titanic;
                }
            if($random === 9)
                {
                    $write = $write . $divan;
                }
            if($random === 10)
                {
                    $write = $write . $greenpark;
                }
            $write = $write . "','" . $city . "');";
            if($conn2 -> query($write) === TRUE)
                {
                    //echo "Hotel tables are sucessfull\n;
                }
            else{
                //echo "Error in hotel tables:" . mysqli_connect_error();
            }
            $i = $i-1;
        }
        $city = $city +1;
}


//INSERT CLIENTS

$row=0;
$filename_clients = "csv/clients1.csv";
$name_array = array();
$surname_array = array();
$head = NULL;
$forname = NULL;
$forsurname = NULL;

$file = fopen($filename_clients,'r');

while(($row = fgetcsv($file ,100000,',')) !== FALSE){
    if(!$head)
        $head = $row;
    else{
        $name_array[] = $row[0];
        $surname_array[] = $row[1];
    }
}
fclose($file);
$index = 0;
while($index < 1620){
    $forname = rand(1,499);

    $forsurname = rand(1,499);
    
    $sql = "INSERT INTO clients (client_name, client_surname) VALUES ('$name_array[$forname]','$surname_array[$forsurname]');";
    
    if ($conn2->query($sql) === FALSE)
    {
        echo " ERROR Client Table \n";
    }

   
    $index = $index +1;
}

//INSERT FACILITIES

$sql_db_create_fill_facilities = "INSERT INTO facilities( facility_name,hotel_id) VALUES ('";

$spa = "spa";
$outrest= "outdoor restaurant";
$poolbar = "poolside bar";
$car = "car parking";
$jacuzzi = "jacuzzi";

$row = 0;
$min = 1;
$max = 5;
$otel = 1;
$i = 2;

while($otel <= 405)
{
    $i = 2;
    while ( $i >0)
        {
            $write = $sql_db_create_fill_facilities;
            $random = rand($min,$max);
            if( $random === 1)
                {
                    $write = $write . $spa;
                }
            if( $random === 2)
            {
                $write = $write . $outrest;
            }
            if( $random === 3)
                {
                    $write = $write . $poolbar;
                }
            if( $random === 4)
                {
                    $write = $write . $car;
                }
            if( $random === 5)
                {
                    $write = $write . $jacuzzi;
                }
            $write = $write . "','" . $otel . "');";
            
            if($conn2 ->query($write) === TRUE)
                {
                    //echo "Facilities table succesfull\n";
                }
            else
                {
                    //echo "error in facilities table" . mysqli_connect_error();
                }
            $i = $i - 1;
        }
    $otel = $otel + 1;
}


//INSERT ROOMTYPES

$filename_roomtypes = "csv/roomtypes.csv";


if(!file_exists($filename_roomtypes) || !is_readable($filename_roomtypes))
   return FALSE;

if (($handle = fopen($filename_roomtypes, 'r')) !== FALSE)
{
    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
    {
    
        $write = "INSERT INTO roomtypes (room_type, room_price) VALUES ('$row[0]' ,'$row[1]');";
        if ($conn2->query($write) === FALSE)
        {
            echo "Error Roomtypes !\n";
        }
  
    }
    fclose($handle);
}
    



//INSERT ROOM
$min=1;
$max=5;
$indexhotel=1;
$indexroom=0;
while($indexhotel <= 405){
    $indexroom=0;
    while($indexroom < 30){
        $random=rand($min, $max);
        $sql_db_create_fill_rooms = "INSERT INTO rooms(roomtype_id,hotel_id) VALUES ('". $random ."','" . $indexhotel . "');";
        if ($conn2->query($sql_db_create_fill_rooms) === FALSE)
        {
            echo "Error Room!\n";
        }
       
        $indexroom = $indexroom +1;
        
    }
    $indexhotel = $indexhotel + 1;
}

//INSER TRAVELAGENTS

$filename_travelagents = "csv/travelagents.csv";


if(!file_exists($filename_travelagents) || !is_readable($filename_travelagents))
   return FALSE;

if (($handle = fopen($filename_travelagents, 'r')) !== FALSE)
{
    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
    {
    
        $write = "INSERT INTO travelagents (travelagent_name, travelagent_price) VALUES ('$row[0]' ,'$row[1]');";
        if ($conn2->query($write) === FALSE)
        {
            echo "error travelagent table:\n";
        }
  
    }
    fclose($handle);
}

//INSERT BOOKING TABLES



$row = 0;
$filename_bookings = "csv/bookingnew.csv";


if(!file_exists($filename_bookings) || !is_readable($filename_bookings))
   return FALSE;

if (($handle = fopen($filename_bookings, 'r')) !== FALSE)
{
    while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
    {
    
        $write = "INSERT INTO bookings (booking_date, checkin_date,checkout_date,travelagent_id,client_id,room_id) VALUES ('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."','".$row[5]."');";
        if ($conn2->query($write) === FALSE)
        {
            echo "ERROR District and city added to Places Table!\n";
        }
     
    }
    fclose($handle);
}
    
$row=0;


$conn2 -> close();


?>

