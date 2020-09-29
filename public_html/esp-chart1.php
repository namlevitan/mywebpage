<!--
  
-->
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

$data1 = '';
$data2 = '';
$data3 = '';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT id, temperature, humidity, created_at FROM esp32_data order by created_at desc limit 40";

$result = $conn->query($sql) or die($conn->error);

while ($data = $result->fetch_assoc()){
   // extract $data;
  // $data["created_at"] *=1000;
  $data1 = $data1 . '"'. $data['id'].'",';
  $data2 = $data2 . '"'. $data['temperature'] .'",';
  $data3 = $data3 . '"'. $data['humidity'] .'",';
}
$data1 = trim($data1,",");
	$data2 = trim($data2,",");
	$data3 = trim($data3,",");


// ******* Uncomment to convert readings time array to your timezone ********
/*$i = 0;
foreach ($created_at as $at){
    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    //$created_at[$i] = date("Y-m-d H:i:s", strtotime("$reading - 1 hours"));
    // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
    $created_at[$i] = date("Y-m-d H:i:s", strtotime("$at + 7 hours"));
    $i += 1;
}*/

/*$value1 = json_encode(array_reverse(array_column($esp32_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($esp32_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($esp32_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);*/
/*echo $value1;
echo $value2;
echo $value3;
echo $reading_time;*/

$result->free();
$conn->close();
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="esp.css">
<script src="https://kit.fontawesome.com/1e3aac4abd.js" ></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
<!--<script src="../Highcharts/code/highcharts.js"></script>
<script src="../Highcharts/code/modules/annotations.js"></script>
<script src="../Highcharts/code/modules/exporting.js"></script>
<script src="../Highcharts/code/modules/export-data.js"></script>
<script src="../Highcharts/code/modules/accessibility.js"></script>-->
  <style type="text/css">
    body {
      min-width: 310px;
    	max-width: 1280px;
    	height: 500px;
      margin: 0 auto;
      background-color:#d1abcf;

      font-family: Arial;
			   
			    
			    color: #000;
			   
			   
    }
    h2 {
      font-family: Arial;
      font-size: 2.5rem;
      text-align: center;
    }
    
#container {
    height: 450px;
}

			.container {
				color: #000;
				background: #fff;
				border: #555652 1px solid;
				padding: 10px;
			}
		
  </style>
  <body>
  
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
                <li><a href="event.php"><i class="fas fa-calendar-week"></i>Events</a></li> 
                <li><a href="about.html"><i class="fas fa-question-circle"></i>About</a></li> 
                <li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li> 
                <li><a href="index.php"><i class="fas fa-sign-out-alt"></i>Sign out</a></li>    
            </ul>
        </div>
 <section>
    <div></div>
    <h2>NTN Environmental Surveillance </h2>
    <canvas id="chart" style="width: 100%; height: 65vh; background: #fff; border: 1px solid #fff; margin-top: 10px;"></canvas>
    
       
<script type="text/javascript">
    function addData(chart, label, data) {
   				 chart.data.labels.push(label);
  				  chart.data.datasets.forEach((dataset) => {
    			    dataset.data.push(data);
   				 });
    				chart.update();
				}
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
				   // labels: [1,2,3,4,5,6,7,8,9],
				   labels:[<?php echo $data1; ?>],
		            datasets: 
		            [{
						label:'humidity',
						
		                data: [<?php echo $data3; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
						borderWidth: 3
						//addData(myChart,'humidity',data)
		            },

		            {
						label: 'temperature',
					
		                data: [<?php echo $data2; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(255,99,132)',
						borderWidth: 3
						//addData(myChart,'humidity',data)	
		            }]
		        },
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
		        }
		    });

</script>
</section>
</body>
</html>