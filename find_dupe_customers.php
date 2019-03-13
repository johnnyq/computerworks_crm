<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";


	$sql = mysqli_query($mysqli,"SELECT
    y.customer_id,y.first_name,y.last_name,y.email
    FROM customers y
        INNER JOIN (SELECT
                        customer_id,first_name,last_name,email, COUNT(*) AS CountOf
                        FROM customers
                        GROUP BY first_name,email
                        HAVING COUNT(*)>1
                    ) dt ON y.email=dt.email");
	
?>

<form class="well well-sm" autocomplete="off">
	<div class="row">
		<div class="col-md-4">
			<div class="input-group">
				<input type="text" class="form-control" name="q" value="<?php if(isset($q)){echo $q;} ?>" placeholder="Search Customers" autofocus>
				<span class="input-group-btn">
					<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</div>
		<div class="col-md-8">
			<a class="btn btn-primary pull-right" href='add_customer.php'><span class="glyphicon glyphicon-plus"></span> New Customer</a>
		</div>
	</div>
</form> 

<div id="response"></div>



<table class="table">	
    <thead>	
        <tr>	
            <th>id</th>
            <th>Name</th>
			<th>Email</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Created</th>
			<th>Stats</th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row = mysqli_fetch_array($sql)){
				$id = $row['customer_id'];
                $company = $row['company'];
                $last_name = ucwords($row['last_name']);
                $first_name = ucwords($row['first_name']);
                $address = ucwords($row['address']);
                $city = $row['city'];
                $state = $row['state'];
                $zip = $row['zip'];
                $phone = $row['phone'];
                if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
                $email = $row['email'];
                $human_time = human_time($row['date_added']);
                $date_added = date($date_format,$row['date_added']);
                
                $total_sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales WHERE customer_id = $id"));
                if($total_sales > 0){
                	$display_sales = "$total_sales <i class='glyphicon glyphicon-shopping-cart'></i>";
                }else{
                	$display_sales = '';
                }
                $total_returns = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_returns WHERE customer_id = $id"));
                if($total_returns > 0){
                	$display_returns = "$total_returns <i class='glyphicon glyphicon-refresh'></i>";
                }else{
                	$display_returns = '';
                }
                $total_work_orders = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE customer_id = $id"));
                if($total_work_orders > 0){
                	$display_work_orders = "$total_work_orders <i class='glyphicon glyphicon-wrench'></i>";
                }else{
                	$display_work_orders = '';
                }
                $total_customer_notes = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customer_notes WHERE customer = $id"));
                if($total_customer_notes > 0){
                	$display_customer_notes = "$total_customer_notes <i class='glyphicon glyphicon-pencil'></i>";
                }else{
                	$display_customer_notes = '';
                }
                echo "
					<tr>
						<td>$id</td>
						<td><a href='customer_details.php?id=$id'>$first_name $last_name $company</a></td>
						<td>$email</td>
						<td>$address<br><small>$city $state $zip</small></td>
						<td>$phone<br><small>$email</small></td>
						<td>$human_time</td>
						<td>$display_sales $display_returns $display_work_orders $display_customer_notes</td>
					</tr>
				";
			}
		?>
	
    </tbody>
</table>
<?php

include "includes/footer.php";

?>