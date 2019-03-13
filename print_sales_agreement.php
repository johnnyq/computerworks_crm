<?php 
	
include "config.php";
include "includes/header.php"; 
include "includes/check_login.php";
include "includes/nav.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$sql = mysqli_query($mysqli,"SELECT * FROM users, computer_sales, customers, computers
	WHERE computer_sales.employee_id = users.user_id
	AND computer_sales.computer_id = computers.computer_id
	AND computer_sales.customer_id = customers.customer_id
	AND sale_id = $id"
);

$row = mysqli_fetch_array($sql);
$system_number = $row['system_number'];
$type = $row['type'];
$make = ucwords($row['make']);
$model = ucwords($row['model']);
$type = $row['type'];
$serial = $row['serial'];
$coa = $row['coa'];
$os = $row['os'];
$processor = $row['processor'];
$memory = $row['memory'];
$hard_drive = $row['hard_drive'];
$price = $row['price'];
$user_first_name = ucwords($row['user_first_name']);   
$warranty = $row['warranty'];
$sale_date = date('M d, Y',$row['sale_date']);
$sale_time = date('h:i A',$row['sale_date']);
$company = $row['company'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$address = $row['address'];
$city = $row['city'];
$state = $row['state'];
$zip = $row['zip'];
$email = $row['email'];
$phone = $row['phone'];
if(strlen($phone)>2){ 
	$phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);
}
$customer_id = $row['customer_id'];

?>

<div class="row">
	<div class="col-xs-2 col-sm-1">
		<img src="http://crm.goodwillcomputerworks.org/img/gwlogogray.png">
	</div>
	<div class="col-xs-6 col-sm-7">
		<h3><?php echo $main_company_name; ?>
		<small><address><?php echo "$main_company_address $main_company_city $main_company_state $main_company_zip<br>$main_company_phone $main_company_website" ?></address></small>
		</h3>
	</div>
</div>
<div class="row">
	<div class="col-xs-7 col-sm-8">
		<?php 
		echo "
			<h4>$first_name $last_name <small>$company</small></h4>
			<address>$address<br>$city $state $zip<br>$phone</address>
		";
		?>
	</div>
	<div class="col-xs-5 col-sm-4">
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>Date</th>
					<td><?php echo "$sale_date $sale_time"; ?></td>
				</tr>
				<tr>
					<th>Sales Rep</th>
					<td><?php echo $user_first_name; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<small>
				<table class="table">
					<thead>
						<tr>
							<th>Computer</th>
							<th>System #</th>
							<th>OS</th>
							<th>Serial</th>
							<th>Warranty</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "$make $model $type"; ?></td>
							<td><?php echo "$system_number"; ?></td>
							<td><?php echo "$os"; ?></td>
							<td><?php echo "$serial<br>$coa"; ?></td>
							<td><?php echo "$warranty Days"; ?></td>
							<td><?php echo "$$price"; ?></td>
						</tr>
					</tbody>
				</table>
			</small>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<small>
					<?php echo $warranty_info; ?>
					<?php echo $return_policy; ?>
					<center><?php echo $sales_footer; ?></center>
				</small>	
			</div>
		</div>
	</div>
</div>
	
<?php include "includes/footer.php"; ?>