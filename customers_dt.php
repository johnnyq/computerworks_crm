<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$sql = mysqli_query($mysqli,"SELECT customer_id FROM customers");
	
?>


			<a class="btn btn-primary pull-right" href='add_customer.php'><span class="glyphicon glyphicon-plus"></span></a>
		

<div id="response"></div>


<table class="table" id="dataTab">	
    <thead>	
        <tr>	
            <th>Name</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Created</th>
			<th>Stats</th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row = mysqli_fetch_assoc($sql)){
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
               
                echo "
					<tr>
						<td><a href='customer_details.php?id=$id'>$first_name $last_name $company</a></td>
						<td>$address<br><small>$city $state $zip</small></td>
						<td>$phone<br><small>$email</small></td>
						<td><a data-toggle='tooltip' title='$date_added'>$human_time</a></td>
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