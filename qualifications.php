<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CREST Careers</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/dashboard.js"></script>
	<link rel="stylesheet" type="text/css" href="css/qualifications.css">

</head>
<?php
require_once "mysql_connect.php";

// Get user selection
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
		
		
		<h1>Academic</h1>
		<?php
			
				$q = 'SELECT title, aq.description, qual_type, u.name url FROM ac_qualification aq, university u WHERE '.$r['career_id'].' = aq.career_id AND aq.university_id = u.id';	
				$results = @mysqli_query($dbc, $q);
				
				if ($results) {
				
					while ($row = @mysqli_fetch_array($results)) {

						echo "<h2>{$row['title']}</h2>
						<ul>
							<li>{$row['qual_type']}</li>
						</ul>
						<p>{$row['description']}</p>";
					
					}
				
				}
				else {
					
					echo "<p>Currently no course links</p>";
					
				}
		?>
		<h1>Professional</h1>
		 <?php
				
				$q = 'SELECT title, pq.description, qual_type, provider, url FROM pro_qualification pq WHERE '.$r['career_id'].' = pq.career_id';	
				$results = @mysqli_query($dbc, $q);
				
				if ($results) {
				
					while ($row = @mysqli_fetch_array($results)) {

					echo "<h2>{$row['title']}</h2>
					<ul>
						<li>{$row['qual_type']}</li>
					</ul>
					<p>{$row['description']}</p>";
					
					}
				
				} else {
					
					echo "<p>Currently no course links</p>";
					
				}
		?>
	</div>
		</div>

</div>