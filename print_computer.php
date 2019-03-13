<?php 
	
include "config.php";
include "includes/header.php"; 
include "includes/check_login.php";
include "includes/nav.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$sql = mysqli_query($mysqli,"SELECT * FROM computers WHERE computer_id = $id");

$row = mysqli_fetch_array($sql);
$system_number = $row['system_number'];
$type = $row['type'];
$make = ucwords($row['make']);
$model = ucwords($row['model']);
$type = $row['type'];
$serial = $row['serial'];
$os = $row['os'];
$processor = $row['processor'];
$memory = $row['memory'] / 1024;
$hard_drive = $row['hard_drive'];
$date_added = date($date_format,$row['date_added']);
$price = $row['price'];
if($price >= 249.99){
	$warranty = "1 Year Warranty";
}else{
	$warranty = "90 Day Warranty";
}
if($make == "Dell"){
	$make_logo = "<img height='150' width='150' src='img/dell-logo.jpg'>";
}elseif($make == "HP"){
	$make_logo = "<img height='150' width='150' src='img/hp-logo.png'>";
}elseif($make == "Apple"){
	$make_logo = "<img height='150' width='130' src='img/apple-logo.png'>";
}elseif($make == "Lenovo"){
	$make_logo = "<img height='150' width='500' src='img/lenovo-logo.jpg'>";
}elseif($make == "Sony"){
	$make_logo = "<img height='150' width='500' src='img/sony-logo.jpg'>";
}elseif($make == "Toshiba"){
	$make_logo = "<img height='150' width='400' src='img/toshiba-logo.png'>";
}elseif($make == "Asus"){
	$make_logo = "<img height='150' width='400' src='img/asus-logo.png'>";
}elseif($make == "Acer"){
	$make_logo = "<img height='150' width='500' src='img/acer-logo.png'>";
}
if($os == "Windows 10 Home 64bit"){
	$os = "<img height='50' width='250' src='img/windows10-logo.png'>";
}

?>

<div class="row">
	<div class="col-xs-12" align="center">
		<h1><?php echo "$make_logo"; ?></h1>
		<h1><?php echo "$make $model"; ?></h1>
		<h1><?php echo "<strong>$$price</strong>"; ?></h1>
		<h3><?php echo "$processor"; ?></h3>
		<h3><?php echo "<strong>$memory</strong>GB Memory <strong>$hard_drive</strong>GB Hard Drive"; ?></h3>
		<h3><?php echo "$os"; ?></h3>
		
		<h2><?php echo "$warranty"; ?></h2>
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		<h4><strong>15%</strong> Senior (Over 55)</h4>
	</div>
	<div class="col-xs-4">
		<h4><center><strong>15%</strong> Military</center></h4>
	</div>
	<div class="col-xs-4">
		<h4 class="pull-right"><strong>10%</strong> College Student</h4>
	</div>
</div>
<hr>
<br><br><br><br><br>

<div class="row">
	<div class="col-xs-6">
		<?php echo "$serial / $system_number"; ?>
	</div>
	<div class="col-xs-6">
		<?php echo "<div class='pull-right'>$date_added</div>"; ?>
	</div>
</div>

<?php include "includes/footer.php"; ?>