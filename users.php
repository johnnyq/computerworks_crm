<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$sql = mysqli_query($mysqli,"SELECT * FROM  users, locations WHERE users.location = locations.location_id");

	$num = mysqli_num_rows($sql);

?>

<div class="row">
	<div class="col-md-3">
		<?php include "includes/admin_nav.php"; ?>
	</div>
	<div class="col-md-9">

	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-primary pull-right" href='add_user.php'><span class="glyphicon glyphicon-plus"></span></a>
		</div>
	</div>

	<div id="response"></div>

	<?php

	if($num > 0) { 

	?>

	<table class="table table-bordered table-hover" id="dataTables">	
	    <thead>	
	        <tr>	
	            <th></th>
	            <th><span class="glyphicon glyphicon-user"></span> User</th>
				<th><span class="glyphicon glyphicon-lock"></span> Access</th>
				<th><span class="glyphicon glyphicon-home"></span> Location</th>
				<th><span class="glyphicon glyphicon-time"></span> Last Login</th>
				<th><span class="glyphicon glyphicon-th"></span> Action</th>
			</tr>
		</thead>
	    <tbody>
			
	        <?php

				while($row = mysqli_fetch_array($sql)){
					$id = $row['user_id'];
	                $username = ucwords($row['username']);
	                $user_first_name = ucwords($row['user_first_name']);
	                $user_last_name = ucwords($row['user_last_name']);
	                $avatar = $row['avatar'];
	                $location = ucwords($row['location']);
	                $date_added = date('g:ia D M j Y ',$row['user_date_added']);
	                $online = date('g:ia D M j Y ',$row['online']);
	                if($row['online'] == 0){
	                	$online = "No Data";
	                }
	                $security_level = $row['security_level'];
	                if($security_level == 0){
	                	$security_level = "<div class='text-danger'><b>Deactivated</b></div>";
	                }elseif($security_level == 1){
	                	$security_level = "User";
	                }else{
	                	$security_level = "Admin";
	                }

	                echo "
						<tr id='tr_$id'>
							<td><img class='img-circle' height='60' width='60' src='$avatar'></td>
							<td>$username<br><small class='text-muted'>$user_first_name $user_last_name</small></td>
							<td>$security_level</td>
							<td>$location</td>
							<td>$online</td>
							<td>
								<div class='btn-group'>
								    <a class='btn btn-default' href='edit_user.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
	                                <button id='del_$id' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button>
	                            </div>
							</td>
						</tr>
					";
				}
			?>
		
	    </tbody>
	</table>

	<?php

		}else{
			echo "<div class='alert alert-warning'>No records found.</div>";
		}

	?>

	</div>
</div>

<?php include "includes/footer.php"; ?>

<script>

	$( '[id^="del_"]' ).click(function() {
		var id = this.id;
 		id = id.split("_");
 		id = id[1];
		
		$.ajax({
		    url: "post.php?delete_user="+id+"",       
		}).success(function(response) {
		    $('#tr_'+id).addClass("danger");
		    $( "#tr_"+id ).fadeOut();
		    $("#response").html(response);
		    $("form:not(.filter) :input:visible:enabled:first").focus();
		});
	});

</script>