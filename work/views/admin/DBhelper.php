<?php
	class DBhelper{
		//This class is used to connect the database.
		function getCoon(){
			$ini_array = parse_ini_file("config.ini");
			$mysqli = mysqli_connect($ini_array["location"],$ini_array["name"],$ini_array["pwd"],$ini_array["table"],3306);
			//Read the local database info from the local file.
			if(mysqli_connect_errno()){
				printf("Connect Failed: %s/n",mysqli_connect_error());
				exit();
			}
			$mysqli->query("SET NAMES 'UTF8'");
			return $mysqli;
		}
	}
		
	
?>