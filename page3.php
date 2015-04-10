<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CREST Careers</title>
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/dashboard.js"></script>

</head>

<body>
<?php
require_once "mysql_connect.php";

// Get user selection
$role = $_GET['id'];

$q = 'SELECT name, description, color FROM role r, career c WHERE '.$role.' = r.id AND career_id = c.id';	
$rs = @mysqli_query($dbc, $q);


if ($r = @mysqli_fetch_array($rs)) {	

	echo 
	"<header style='background-color: #{$r['color']}'>
		<div class='separator'>
			<h1>{$r['description']}</h1>
			<p>{$r['name']}</p>
		</div>
		<p class='pheader'>For more information please click on the links below...</p>
	</header>";
		
		
}
?>

<div id="wrapper">
	<div id="imagewrap"> <img class="imageMap" src="image.png" usemap="#map"/>
	  <map name="map" id="map" >
		<area shape="poly" coords="1119, 326, 1121, 496, 1214, 479, 1211, 331" data-modal="7" />
		<area shape="poly" coords="862, 307, 860, 497, 1041, 512, 1040, 285" data-modal="6" />
		<area shape="poly" coords="786, 373, 833, 371, 832, 462, 786, 458" data-modal="5" />
		<area shape="poly" coords="681, 369, 681, 455, 775, 458, 774, 362" data-modal="4" />
		<area shape="poly" coords="540, 348, 540, 461, 638, 455, 636, 351" data-modal="3" />
		<area shape="poly" coords="3, 292, 2, 546, 91, 541, 86, 295" data-modal="1" />
		<area shape="poly" coords="438, 435, 195, 445, 195, 291, 439, 309" data-modal="2" />
	  </map>
	
	<div class='modal1 1' style='background-color:#<?php echo $r['color']?>;'>
		
		<?php	
			$q = 'SELECT id, name, definition FROM role WHERE id = '.$role;	
			$results = @mysqli_query($dbc, $q);
			
			if ($results) {
			
				while ($row = @mysqli_fetch_array($results)) {

					echo "<h2>{$row['name']}</h2>
					<p>{$row['definition']}</p>";
				
				}
			
			} 
			else {
				
				echo "<p>Currently no description</p>";
				
			}
		?>
	  </div>
	
	<div class='modal2 2' style='background-color:#<?php echo $r['color']?>;'>
		  <h1>Job Board</h1>
		
	<?php	
			$q = 'SELECT v.description, j.name, location, company FROM vacancy v, jobtype j, role_vacancy rv WHERE '.$role.' = rv.role_id AND v.id = rv.vacancy_id AND v.job_type = j.id ORDER BY closing_date';
			$results = @mysqli_query($dbc, $q);
		
			
			if ($results) {
			
				while ($row = @mysqli_fetch_array($results)) {

					echo "<h2><a href=''>{$row['description']}</a></h2>
					<p>Type: {$row['name']}</p>
					<p>Location: {$row['location']}</p>";
					
					if (!empty($row['company'])) {
						echo "<p>Company: {$row['company']}</p>";
					}
				}
				
				
			} 
			else {
				
				echo "<p>No jobs available.</p>";
				
				
			}
		?>
	  </div>
	  <div class="modal3 3" style="background-color:#<?php echo $r['color'];?>">
		
		<h1>Social Media</h1>
	  
	  <?php
		
			$q = 'SELECT image, url, message FROM socialmedia WHERE '.$role.' = role_id';	
			$results = @mysqli_query($dbc, $q);
			
			if ($results) {
			
				echo "<table class='dashboard'>";
				while ($row = @mysqli_fetch_array($results)) {

					echo 
					"<tr>
					<td><img class='social' src='{$row['image']}'></td>
					<td><a href='{$row['url']}'>{$row['message']}</a></td>
					</tr>";
				
				}
			
			} 
			else {
				
				echo "<p>Currently no social media links</p>";
				
			}
			echo '</table>';
	?>
	  </div>
	<div class="modal4 4" style="background-color:#<?php echo $r['color'];?>">
	<?php
		echo "<a href='qualifications.php?id={$role}'>List of Courses</a>";
	?>
	</div>
	
	<div class="modal5 5" style="background-color:#<?php echo $r['color'];?>">
		<h1>Events</h1>
	<?php
	
		echo 
		"<ul>
		<li><a href='events.php?id={$role}'>List of info sec events</a></li>
		<li><a href='#'>Other video/material</a></li>
		<li><a href='#'>On Line Specialist subject presentations</a></li>
		<li><a href='#'>List of subject presentations</a></li>
		</ul>";
		
		
	?>	
	</div>
	  <div class="modal6 6" style="background-color:#<?php echo $r['color'];?>">
		<h1>Day in the life films</h1>
		
		<?php
			
			$q = 'SELECT title, url, imageurl FROM video v, role_video rv WHERE '.$role.' = rv.role_id AND rv.video_id = v.id';	
			$results = @mysqli_query($dbc, $q);
			
			if ($results) {
			
			echo "<table class='dashboard'>";
				while ($row = @mysqli_fetch_array($results)) {

				echo 
				"<tr>
				<td><a href='{$row['url']}'><img class='vid_thumbnail' src='{$row['imageurl']}'></a></td>
				<td style='text-align: left;'><p>{$row['title']}</p></td>
				</tr>";
				
			}
			echo '</table>';
			
			} else {
				
				echo "<p>Currently no videos</p>";
				
			}
	?>
	  </div>
	  <div class="modal7 7" style="background-color:#<?php echo $r['color'];?>">
		<h1>Potential career paths</h1>
		<ul>
		  <li>Options</li>
		  <li>Alternative Options</li>
		</ul>
	  </div>
	</div>
	<!-- #end imagewrap -->

</div><!-- #end wrapper -->
<?php mysqli_close($dbc); ?>
</body>
</html>
