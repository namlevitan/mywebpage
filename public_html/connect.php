<html>
<body>

<?php

$dbname = 'id14858847_esp32';
$dbuser = 'id14858847_nam';  
$dbpass = 'Truyentranh8.net'; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";

$temperature = $_GET["temperature"];
$humidity = $_GET["humidity"];


$query = "INSERT INTO esp32_data (temperature,humidity) VALUES ('$temperature','$humidity')";
$result = mysqli_query($connect,$query);

echo "Insertion Success!<br>";

?>
</body>
</html>