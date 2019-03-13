<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>

	<select class="form-control" name="type" id="select-type">
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

<table class="table table-bordered table-striped" id="computersDataTable">	
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
</table>

<?php

include "includes/footer.php";

?>

<script>

$(document).ready(function() {
	$('#computersDataTable').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": {
	            url: 'computers_ajax.php',
	            type: 'GET'
	        },

	        "aoColumns": [ 
		        {"data": "systemnumber", "bSearchable": true},
		        {"data": "item", "bSearchable": true}, 
		        {"data": "description", "bSearchable": true},
		        {"data": "status", "bSearchable": true}, 
		        {"data": "price", "bSearchable": true}, 
		        {"data": "dateadded", "bSearchable": true}, 
		        {"data": "location", "bSearchable": true}, 
		        {"data": "actions", "bSearchable": false, "orderable": false}       
			] 
	});


	  var dTable;
      dTable = $('#computersDataTable').dataTable();

      



      $('#select-type').change( function() { 
            dTable.fnFilter( $(this).val() ); 
       });

var table = $('#computersDataTable').DataTable();
 
table.columns().indexes().flatten().each( function ( i ) {
    var column = table.column( i );
    var select = $('<select><option value=""></option></select>')
        .appendTo( $(column.footer()).empty() )
        .on( 'change', function () {
            // Escape the expression so we can perform a regex match
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );
 
            column
                .search( val ? '^'+val+'$' : '', true, false )
                .draw();
        } );
 
    column.data().unique().sort().each( function ( d, j ) {
        select.append( '<option value="'+d+'">'+d+'</option>' )
    } );
} );


} );

</script>