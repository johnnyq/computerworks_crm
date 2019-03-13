<?php 
	
	include "config.php";
	include "includes/header.php";
	include "includes/check_login.php";
	include "includes/nav.php";

	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}

	$sql = mysqli_query($mysqli,"SELECT * from customers WHERE customer_id = $id");

	$row = mysqli_fetch_array($sql);
	
	$company = $row['company'];
    $last_name = ucwords($row['last_name']);
    $first_name = ucwords($row['first_name']);
    $address = ucwords($row['address']);
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $phone = $row['phone'];
    if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
    $mobile = $row['mobile'];
    if(strlen($mobile)>2){ $mobile = substr($row['mobile'],0,3)."-".substr($row['mobile'],3,3)."-".substr($row['mobile'],6,4);}
    $email = $row['email'];
    $date_added = date($date_format,$row['date_added']);
    $human_time = human_time($row['date_added']);

?>
<div class="row">
	<div class="col-md-3">
		<table class="table table-bordered">
			<tr>
				<th><h4><i class="fa fa-user"></i> <?php echo "$first_name $last_name<br><div class='pull-right text-info'>$company</div>"; ?></h4></th>
			</tr>
			<tr>
				<td><a href="https://maps.google.com?q=<?php echo "$address $zip"; ?>" target="_blank" class="text-info"><?php echo "$address<br>$city $state $zip"; ?></a>
<a class='btn btn-default pull-right' id='printCustomerAddressLabel_<?php echo $id; ?>'><span class='glyphicon glyphicon-barcode'></span></a>
				</td>
			</tr>
			<tr>
				<td>
					<?php 
					if($phone <> ''){ echo "<p><i class='fa fa-phone'></i> $phone</p>"; }
					if($mobile <> ''){ echo "<p><i class='glyphicon glyphicon-phone'></i> $mobile</p>"; }
					if($email <> ''){ echo "<p><i class='fa fa-envelope'></i> <small><a href='https://facebook.com/search.php?q=$email' target='_blank' class='text-info'>$email</small></p>"; } 
					?>
				</td>
			</tr>
			<tr>	
				<td><i class='fa fa-clock-o'></i> <?php echo "$human_time"; ?></td>
			</tr>
		</table>	
	</div>
	<div class="col-md-9">
		<div id="response"></div>	
		<div class='btn-group'>
			<button data-toggle="collapse" data-parent="#accordion" href="#collapseSale" class="tip btn btn-primary" title="Make Sale"><i class="glyphicon glyphicon-shopping-cart"></i> Sale</button>
			<button data-toggle="collapse" data-parent="#accordion" href="#collapseWorkOrder" class="tip btn btn-default" title="New Work Order"><i class="glyphicon glyphicon-wrench"></i> WorkOrder</button>
			<button data-toggle="collapse" data-parent="#accordion" href="#collapseNote" class="tip btn btn-default" title="New Note"><i class="glyphicon glyphicon-edit"></i> Note</button>
		</div>
		<a href="edit_customer.php?id=<?php echo $id; ?>" class="btn btn-default tip pull-right" title="Edit Customer"><i class="fa fa-pencil"> Edit</i></a>
		<div id="accordion">
			<div id="collapseSale" class="panel-collapse collapse">
				<br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New Sale</h3>
					</div>
					<div class="panel-body">
					    <form id="formSale" class="form form-horizontal" autocomplete="off">
					      <input type="hidden" name="customer_id" value="<?php echo $id; ?>">
					      <input type="hidden" name="new_sale">
					      <div class="form-group">
					        <div class="col-md-6">
						        <input type="text" class="form-control input-lg" name="system_number" placeholder="System Number" autofocus required>
						    </div>
						    <div class="col-md-6">
						        <select class="form-control input-lg" name="warranty" required>
						        	<option value="90">90 Day Warranty</option>
						        	<option value="365">1 Year Warranty</option>
						        	<option value="0">No Warranty</option>
						        </select>
						    </div>
						  </div>
						  <div class="form-group">
					        <div class="col-md-9">
						        <input type="date" class="form-control input-lg" name="purchase_date" placeholder="Purchase Date ex MM/DD/YYYY (Optional)">
						    </div>
						    <div class="col-md-3">
					       		<button class="btn btn-primary btn-lg btn-block"><i class="glyphicon glyphicon-shopping-cart"></i> Make Sale</button>
					       	</div>
					      </div>
					    </form>
					</div>
				</div>
			</div>
			<div id="collapseWorkOrder"  class="panel-collapse collapse">
				<br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New Work Order</h3>
					</div>
					<div class="panel-body">
					    <form id="formWorkOrder" class="form" autocomplete="off">
					      <input type="hidden" name="new_work_order">
					      <input type="hidden" name="customer_id" value="<?php echo $id; ?>">
					      <div class="form-group">
					        <label>Scope</label>
					        <select class="form-control input-lg" name="scope" autofocus required>
					       		<option></option>
					       		
					       		<?php
					       			
					       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'work_order_type' ORDER BY value ASC");
									while($row = mysqli_fetch_array($sql)){
						                $value = $row['value'];

						            	echo "<option>$value</option>";
						            }

						        ?>
						    </select>
					      </div>
					      <div class="form-group">
					        <label>Asset Type</label>
					        <select class="form-control input-lg" name="asset_type" required>
					       		<option></option>
					       		
					       		<?php
					       			
					       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'computer_type' ORDER BY value ASC");
									while($row = mysqli_fetch_array($sql)){
						                $value = $row['value'];

						            	echo "<option>$value</option>";
						            }

						        ?>
						    </select>
					      </div>
					      <div class="form-group">
					        <label>Make</label>
					        <select class="form-control input-lg" name="make" required>
					       		<option></option>
					       		
					       		<?php
					       			
					       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'make' ORDER BY value ASC");
									while($row = mysqli_fetch_array($sql)){
						                $value = $row['value'];

						            	echo "<option>$value</option>";
						            }

						        ?>
						    </select>
					      </div>
					      <div class="form-group has-feedback">
					        <label>Model</label>
					        <input type="text" class="form-control input-lg" name="model" required>
					        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
					      </div>
					      <div class="form-group has-feedback">
					        <label>Serial</label>
					        <input type="text" class="form-control input-lg" name="serial" required>
					        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
					      </div> 
					      <div class="form-group">
					        <label>Takin Notes</label>
					        <textarea class="form-control input-lg" name="takein_notes" rows="4" required></textarea>
					        <br>
					        <button class="btn btn-primary btn-lg">Bookin</button>
					      </div>
					    </form>
					</div>
				</div>
			</div>
			<div id="collapseNote" class="panel-collapse collapse">
				<br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">New Note</h3>
					</div>
					<div class="panel-body">
					    <form id="formNote" class="form form-horizontal" autocomplete="off">
					      <input type="hidden" name="customer_id" value="<?php echo $id; ?>">
					      <input type="hidden" name="new_customer_note">
					      <div class="form-group">
					        <div class="col-md-12">
						        <textarea class="form-control input-lg" name="note"></textarea>
						    	<br>
						    	<button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Add</button>
						    </div>
						  </div>
					    </form>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div id="salesHistory">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>
		<div id="returnsHistory">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>
		<div id="openWorkOrders">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>
		<div id="workOrderHistory">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>
		<div id="notesHistory">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>
	</div>
</div>




<div class="modal fade" id="customerAddressLabelModal" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Print Customer Address Label</h4>
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




<?php 
	
	include "includes/footer.php";

?>

<script>

$(document).ready(function() {	
	reloadAll();
	$('#accordion').on('show.bs.collapse', function () {
    $('#accordion .in').collapse('hide');
	});
});

function reloadAll(){
    	loadSalesHistory(<?php echo $id; ?>);
		loadReturnsHistory(<?php echo $id; ?>);
		loadOpenWorkOrders(<?php echo $id; ?>);
		loadWorkOrderHistory(<?php echo $id; ?>);
		loadNotes(<?php echo $id; ?>);
}

</script>