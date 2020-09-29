<!DOCTYPE html>
<html lang="en" dir="ltr">
    <body>
    <head>
        <meta charset="utf-8">
        <title>Homepage</title>
        <link rel="stylesheet" href="event.css">
        <script src="https://kit.fontawesome.com/1e3aac4abd.js" ></script>
    </head>
    <body>
        <div class="container">
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times"id="cancel"></i>
        </label>
        <div class="slidebar">
            <header>Menu</header>
            <ul>
                <li><a href="homepage.php"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="esp-chart1.php"><i class="fas fa-qrcode"></i>Dashboard</a></li> 
                <li><a href="esp-outputs.php"><i class="fas fa-stream"></i>Actions</a></li> 
                <li><a href="#"><i class="fas fa-calendar-week"></i>Events</a></li> 
                <li><a href="about.html"><i class="fas fa-question-circle"></i>About</a></li> 
                <li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li> 
                <li><a href="index.php"><i class="fas fa-sign-out-alt"></i>Sign out</a></li>    
            </ul>
        </div>

        <section>
        <h2>NTN DHT11 data </h2>
        <div class="first"></div>
           
<?php


$servername = "localhost";

// REPLACE with your Database name
$dbname = "id14858847_esp32";
// REPLACE with Database user
$username = "id14858847_nam";
// REPLACE with Database user password
$password = "Truyentranh8.net";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, temperature, humidity, created_at FROM esp32_data ORDER BY id DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td>         
        <td>Temperature (dC)</td> 
       <td>Humidity (%)</td>  
        <td>At</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];       
        $row_temperature = $row["temperature"];
          $row_humidity = $row["humidity"];
        
        $row_created_at = $row["created_at"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_temperature . '</td>
                  <td>' . $row_humidity . '</td>
                <td>' . $row_created_at . '</td> 
               
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</section>
</body>
</html>