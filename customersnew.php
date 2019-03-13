<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>

<table class="table table-bordered table-striped" id="customerDataTable">	
    <thead>	
        <tr>	
            <th>Name</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Created</th>
			<th>Stats</th>
		</tr>
	</thead>
</table>

<?php

include "includes/footer.php";

?>

<script>

$(document).ready(function() {
	$('#customerDataTable').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": {
	            url: 'customers_ajax.php',
	            type: 'GET'
	        },

	        "aoColumns": [ 
		        {"data": "fullname", "bSearchable": true},
		        {"data": "address", "bSearchable": true}, 
		        {"data": "contact", "bSearchable": true},
		        {"data": "date_added", "bSearchable": true}, 
		        {"data": "stats", "bSearchable": false, "orderable": false}       
			] 
	});
} );

</script>