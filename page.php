<?php
require_once "mysql_connect.php";

$role 		= $_GET['id'];
$career 	= $_GET['career_id'];

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>Inspired Careers - CREST</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />	
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
    <?php
	
	$q = 'SELECT name, description, color FROM role r, career c WHERE '.$role.' = r.id AND career_id = c.id';	
	$rs = @mysqli_query($dbc, $q);

	if ($r = @mysqli_fetch_array($rs)) {	
		
	echo "<style type=\"text/css\">
		<!--
	
		body {
			background-color: #{$r['color']};
		}
	
		-->
		
		</style>";
		
		}
		
		?>
</head>

<body>


<div id="wrapper">
	<div id="contentWrapper">
  	<ul>
	<?php
	$q = 'SELECT * FROM role WHERE '.$career.' = career_id';	
	$results = @mysqli_query($dbc, $q);
		
		if ($results) {
		
		while ($row = @mysqli_fetch_array($results)) {

		echo "<li class=\"roles_list\"><a class=\"roles_list\" href=\"page3.php?id={$row['id']}\">{$row['name']}</a></li>";}
		
		} else {
			
		echo "<p>Currently no description</p>";
			
			
		}
    ?>
    </ul>

</div><!-- #end contentWrapper -->
</div><!-- #end wrapper -->

	



</body>
</html>
