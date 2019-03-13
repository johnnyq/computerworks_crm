<div class="row">
 
<?php
include "config.php";    
include "includes/check_login.php";
	$sql = mysqli_query($mysqli,"SELECT * FROM computer_templates ORDER BY computer_template_id DESC");

	$num = mysqli_num_rows($sql);
	while ($row = mysqli_fetch_array($sql)){
		$computer_template_id = $row['computer_template_id'];
		$type = $row['type'];
		$make = $row['make'];
		$model = $row['model'];
		$os = $row['os'];
		$processor = $row['processor'];  
		$memory = $row['memory'];
		$hard_drive = $row['hard_drive'];
		$price = $row['price'];
		if($type == 'Laptop'){
        	$type_class = 'fa fa-laptop';
        }elseif($type == 'Desktop'){
        	$type_class = 'fa fa-desktop';
        }
        echo "
		<div class='alert col-md-2' align='center' id='computerTemplateContainter_$computer_template_id '>  
		  
			<div class='panel panel-default'>
			<form id='computer_template_form_$computer_template_id'>
				<div class='panel-body'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<h2><i class='$type_class'></i></h2>
					<p>$make $model<br>
					$processor/$memory/$hard_drive<br>
					$os<br>
					$$price</p>
					
						<input type='hidden' name='type' value='$type'>
						<input type='hidden' name='make' value='$make'>
						<input type='hidden' name='model' value='$model'>
						<input type='hidden' name='os' value='$os'>
						<input type='hidden' name='processor' value='$processor'>
						<input type='hidden' name='memory' value='$memory'>
						<input type='hidden' name='hard_drive' value='$hard_drive'>
						<input type='hidden' name='price' value='$price'>
					
				</div>
				<div class='panel-footer'>
				
					<input type='submit'  value='Add'>
					
				</div>
			</form>	
			</div>
		</div>

		";
			
		} //End While

?> 
</div>