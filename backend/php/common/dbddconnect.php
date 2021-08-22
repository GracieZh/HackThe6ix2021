<?php

	$host_name = 'localhost';
	$database = 'darwynn_db_debug';
	$user_name = 'darwynnuser';
	$password = 'ThePassword';

	$con=mysqli_connect($host_name,$user_name,$password,$database);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>