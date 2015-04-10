<?php # mysql_connect.php


	//This file contains the database access information.
	//This file also establishes a connection to MySql and selects the database.
	
	
	//Set the database access information as constants.
	DEFINE ('DB_USER', 'i7230428');
	DEFINE ('DB_PASSWORD', '6dc06cf183ab3e0734e4feea83e1e5df');
	DEFINE ('DB_HOST', '127.0.0.1');
	DEFINE ('DB_NAME', 'i7230428');

	if ($dbc = ($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST,  DB_USER,  DB_PASSWORD))) { //Make the connection.
	
		if (!((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . constant('DB_NAME')))) { //If it can't select the database.
		
			//Handle the error.
			trigger_error("Could not select the database!\n<br />MySql Error: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
			
			
			//Print a message to the user, include footer, and kill the script.
			exit();
			
		} //End of mysql_select_db IF.
		
	} else { //If it couldn't connect to MySql.
	
		//Print a message to the user, include footer, and kill the script.
		trigger_error("Could not connect to MySql!\n<br />MySql Error: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
		exit();
		
	} //End of $dbc IF.
	
	//Create a function for escaping the data.
	function escape_data ($data) {
	
		//Address Magic Quotes.
		if (ini_get('magic_quotes_gpc')) {
			$data = stripslashes($data);
		}
		
		
		//Check for mysql_real_escape_string() support.
		if (function_exists('mysqli_real_escape_string')) {
			global $dbc; //Need the connection.
			$data = mysqli_real_escape_string( $dbc, trim($data));
			
		} else {
		
			$data = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], trim($data)) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
		}
		
		
		//Return the escaped value.
		return $data;
		
	} //End of function


?>
