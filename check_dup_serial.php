<?php

include "config.php";

if(isset($_GET['q'])){
	$q = $_GET['q'];
	$sql = mysqli_query($mysqli,"SELECT serial FROM computers WHERE serial = '$q'");
	$num_rows = mysqli_num_rows($sql);
	if($num_rows > 0 ){
	  	$sql = mysqli_query($mysqli,"SELECT * FROM computers WHERE serial = '$q'");
	  	$row = mysqli_fetch_array($sql);
		$computer_id = $row['computer_id'];
		$system_number = $row['system_number'];
		$type = ucwords($row['type']);
		$make = ucwords($row['make']);
		$model = ucwords($row['model']);
  	  	echo "<div class='alert alert-danger'>Computer $make $model $system_number: Already Exists with the serial $q<br><a href='computers.php#q=$system_number'>CLick</a></div>";
  	}
}

?>