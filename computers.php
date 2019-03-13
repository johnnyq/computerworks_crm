<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    if (isset($_GET['p'])){
	    $p = intval($_GET['p']);
	    $record_from = (($p)-1)*10;
	    $record_to =  10;
	}else{
		$record_from = 0;
		$record_to = 10;
		$p = 1;
	}

    if (isset($_GET['q'])){
		$q = $_GET['q'];
		$type = $_GET['type'];
		$status = $_GET['status'];
		$location = $_GET['location'];
	}

	$sql = mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM computers, locations
			WHERE computers.location = locations.location_id
			AND computers.status LIKE '%$status%'
			AND locations.location_id LIKE '%$location%'
			AND computers.type LIKE '%$type%'
			AND (system_number LIKE '%$q%'
			OR make LIKE '%$q%'
			OR model LIKE '%$q%'
			OR CONCAT(make,' ',model) LIKE '%$q%'
			OR serial LIKE '%$q%'
			OR os LIKE '%$q%'
			OR processor LIKE '%$q%')
			ORDER BY computer_id DESC LIMIT $record_from, $record_to"
    );
	
	$num = mysqli_num_rows($sql);

	$num_rows = mysqli_fetch_row(mysqli_query($mysqli,"SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / 10);

?>

<form class="well well-sm form-inline" autocomplete="off">
	<div class="row">
		<div class="col-md-8">
			<input type="text" class="form-control" name="q" value="<?php if(isset($q)){echo $q;} ?>" placeholder="Search Inventory" autofocus>
			<select class="form-control" name="type">
				<option value="">Type</option>
				<?php
					$sql2 = mysqli_query($mysqli,"SELECT * FROM commons WHERE category_id = 5");
					while($row2 = mysqli_fetch_array($sql2)){
						$common = ucwords($row2['value']);
						if($common == $_GET['type']){
							echo "<option selected='selected'>$common</option>";
						}else{
							echo "<option>$common</option>";
						}
					}
				?>
			</select>
			<select class="form-control" name="status">
				<option value="">Status</option>
				<?php
					$sql2 = mysqli_query($mysqli,"SELECT * FROM commons WHERE category_id = 4");
					while($row2 = mysqli_fetch_array($sql2)){
						$common = ucwords($row2['value']);
						if($common == $_GET['status']){
							echo "<option selected='selected'>$common</option>";
						}else{
							echo "<option>$common</option>";
						}
					}
				?>
			</select>
			<select class="form-control" name="location">
				<option value="">Location</option>
				<?php
					$sql3 = mysqli_query($mysqli,"SELECT * FROM locations");
					while($row3 = mysqli_fetch_array($sql3)){
						$location_id = $row3['location_id'];
						$location = $row3['location'];
						if($location_id == $_GET['location']){
							echo "<option selected='selected' value='$location_id' >$location</option>";
						}else{
							echo "<option value='$location_id'>$location</option>";
						}
					}
				?>
			</select>
			<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
		</div>
		<div class="col-md-4">
			<a class="btn btn-primary pull-right" href='add_computer.php'><span class="glyphicon glyphicon-plus"></span></a>
		</div>
	</div>
</form> 

<div id="response"></div>

<?php

if($total_found_rows > 0) { 

?>

<table class="table">	
    <thead>	
        <tr>	
            <th>#</th>
			<th>Item</th>
			<th>Description</th>
			<th>Status</th>
			<th>Price</th>
			<th>Added</th>
			<th>Location</th>
			<th></th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row = mysqli_fetch_array($sql)){
				$id = $row['computer_id'];
                $system_number = $row['system_number'];
                $type = ucwords($row['type']);
                if($type == 'Laptop'){
                	$type = 'fa fa-laptop fa-2x';
                }elseif($type == 'Desktop'){
                	$type = 'fa fa-desktop fa-2x';
                }
                $make = ucwords($row['make']);
                $model = ucwords($row['model']);
                $serial = $row['serial'];
                $os = $row['os'];
                $processor = $row['processor'];
                $hard_drive = $row['hard_drive'];
                $memory = $row['memory'];
                $price = $row['price'];
                $status = $row['status'];
                $human_time = human_time($row['date_added']);
                $date_added = date($date_format,$row['date_added']);
                $label_printed = $row['label_printed'];
		        if($label_printed == 1){
		            $print_label = "btn btn-default"; 
		        }else{
		            $print_label = "btn btn-danger";
		        }
                if($status == 'sold'){
                	$sql2 = mysqli_query($mysqli,"SELECT * FROM computer_sales, customers WHERE computer_sales.customer_id = customers.customer_id AND computer_sales.computer_id = $id ");
                	$row2 = mysqli_fetch_array($sql2);
                	$customer_id = $row2['customer_id'];
                	$last_name = ucwords($row2['last_name']);
    				$first_name = ucwords($row2['first_name']);
    				$sale_date = human_time($row2['sale_date']);
                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a> - $sale_date</small>";
                }elseif($status == 'returned'){
                	$sql2 = mysqli_query($mysqli,"SELECT * FROM computer_returns, customers WHERE computer_returns.customer_id = customers.customer_id AND computer_id = $id");
                	$row2 = mysqli_fetch_array($sql2);
                	$customer_id = $row2['customer_id'];
                	$last_name = ucwords($row2['last_name']);
    				$first_name = ucwords($row2['first_name']);
                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a></small>";
                }else{
                	$display = "";
                }
                $location = $row['location'];

                echo "
					<tr>
						<td><i class='$type'></i> $system_number</td>
						<td>$make $model<br><small>$serial</small></td>
						<td>$processor<br><small>$memory MB / $hard_drive GB</small></td>
						<td>$status $display</td>
						<td>$$price</td>
						<td>$human_time</td>
						<td>$location</td>
						<td>
							<div class='btn-group'>
							    <a class='btn btn-default $print_label' id='printComputerLabel_$id'><span class='glyphicon glyphicon-barcode'></span></a>
							    <a class='btn btn-default' href='edit_computer.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
							    <a class='btn btn-default' href='print_computer.php?id=$id'><span class='glyphicon glyphicon-print'></span></a>
                            </div>
						</td>
					</tr>
				";
			}
		?>
	
    </tbody>
</table>

<div class="modal fade" id="computerLabelModal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Print Computer Label</h4>
      </div>
      <div class="modal-body">
      	<div id="computerLabelContent">
			<div align="center well">
				<img id='labelImage' alt='label preview'>
			</div>
			<br>
			<div class="input-group">
			  <select class="form-control input-lg" id='printersSelect'></select>
			  <span class="input-group-btn">
			    <button class="btn btn-default btn-primary btn-lg" type="button" id='printButton'><i class="glyphicon glyphicon-print"></i></button>
			  </span>
			</div><!-- /input-group -->	
      	</div>
      </div>    
    </div>
  </div>
</div>

<?php include("pagination.php"); ?>

<?php

	}else{
		echo "<div class='alert alert-warning'>No records found.</div>";
	}

include "includes/footer.php";

?>