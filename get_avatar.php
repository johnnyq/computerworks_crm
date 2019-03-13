<?php

include "config.php";

if(isset($_GET['q'])){
	$q = $_GET['q'];
	$sql = mysqli_query($mysqli,"SELECT * FROM users WHERE username = '$q' OR user_email = '$q'");
	if(mysqli_num_rows($sql) == 1){

		while($row = mysqli_fetch_array($sql)){
			$avatar = $row['avatar'];

			echo "<div align='center'><img class='img-circle' src='$avatar' height='142' width='142'></img></div><br>";
		}
	}
}

?>