<!DOCTYPE html>

<html>

<head>



	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Events</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="js/dashboard.js"></script>

	<link rel="stylesheet" type="text/css" href="css/qualifications.css">



</head>

<?php

require_once "mysql_connect.php";

$role = $_GET['id'];

$q = 'SELECT name, description, color, r.career_id FROM role r, career c WHERE '.$role.' = r.id AND career_id = c.id';	

$rs = @mysqli_query($dbc, $q);

if ($r = @mysqli_fetch_array($rs)) {	



	echo 

	"<header style='background-color: #{$r['color']}'>

		<div class='separator'>

			<h1>{$r['description']}</h1>

			<h3>{$r['name']}</h3>

		</div>

		<p class='pheader'>For more information please click on the links below...</p>

	</header>";
	}
			
			
?>



<div class="wrapper">



	<div class='content'>	

		<h1>Events</h1>
		<br>

		<?php

			
		$q = 'SELECT name, start_date, end_date, location, url FROM event e, role_event re WHERE '.$role.' = re.role_id AND e.id = re.event_id';	
			$results = @mysqli_query($dbc, $q);
			
			
			
			if ($results) {
				
				
			
				while ($row = @mysqli_fetch_array($results)) {

				$st_date = date_create($row['start_date']);	
				$end_date = date_create($row['end_date']);
					
				$sd = date_format($st_date, 'l jS F Y');
				$ed = date_format($end_date, 'l jS F Y');
					
				echo "<h2>{$row['name']}</h2>";
				if($sd === $ed) {
					echo "<p><b>Dates:</b> {$sd}</p>";
				}
				else {
					echo "<p><b>Dates:</b> {$sd} - {$ed}</p>";
				};
				echo "<p><b>Location:</b> {$row['location']}</p>
				<a href='{$row['url']}'>Find out more about {$row['name']}</a>
				<br>
				<br>";
				
			}
			
			} else {
				
				echo "<p>Currently no events</p>";
				
			}
				

		?>

	</div>

		</div>



</div>