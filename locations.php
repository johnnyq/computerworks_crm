<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$sql = mysqli_query($mysqli,"SELECT * FROM locations ORDER BY location_id DESC");

	$num_rows = mysqli_num_rows($sql);

?>

<div class="row">
	<div class="col-md-3">
		<?php include "includes/admin_nav.php"; ?>
	</div>
	<div class="col-md-9">
		<div id="response"></div>

		<?php

		if($num_rows > 0) { 

		?>

		<table class="table table-bordered table-hover" id="dataTables">	
		    <thead>	
		        <tr>	
		            <th><span class="glyphicon glyphicon-home"></span> Location</th>
					<th><span class="glyphicon glyphicon-th"></span> Action</th>
				</tr>
			</thead>
		    <tbody>
				
		        <?php

					while($row = mysqli_fetch_array($sql)){
						$id = $row['location_id'];
		                $location = $row['location'];
		                
		                echo "
							<tr>
								<td>$location</td>
								<td>
									<div class='btn-group'>
									    <a class='btn btn-default' href='edit_location.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
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
		    url: "post.php?delete_location="+id+"",       
		}).success(function(response) {
		    $('#tr_'+id).addClass("danger");
		    $( "#tr_"+id ).fadeOut();
		    $("#response").html(response);
		    $("form:not(.filter) :input:visible:enabled:first").focus();
		    $("#pagei").load();
		});
	});

</script>