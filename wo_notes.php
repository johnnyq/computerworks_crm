<?php

include("config.php");
include("includes/check_login.php");
include "includes/functions.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];
      
	$sql = mysqli_query($mysqli,"SELECT * FROM users, work_order_notes
		WHERE users.user_id = work_order_notes.employee
		AND work_order_id = $id
		AND work_order_notes.active = 1
		ORDER BY work_order_note_id DESC
	");

	$num = mysqli_num_rows($sql);
	if($num == 0){
		echo "No Notes";
	}else{

	while ($row = mysqli_fetch_array($sql)){
		$work_order_note_id = $row['work_order_note_id'];
		$note = $row['note'];
		$human_time =  human_time($row['date_added']);
		$date_posted =  date('D', $row['date_added']);
		$time_posted = date('g:i A', $row['date_added']);
		$date_modified = date('D g:i A', $row['date_modified']);
		$user_id = $row['employee'];
		$username = ucwords($row['username']);
		$avatar = $row['avatar'];
		if ($avatar == '') {
			$avatar = "img/avatar/anon.png";
		};

?>
<div class="row" id="workOrderNote_<?php echo $work_order_note_id; ?>">
	<div class="col-md-1" align="center">
		<img class="img-circle" src='<?php echo "$avatar"; ?>' height='48' width='48'>
		<small class="text-muted"><?php echo "$username"; ?></small>
	</div>
	<div class="col-md-11" id="workOrderNoteCol2_<?php echo $work_order_note_id; ?>">
    		<?php if($session_user_id == $user_id){ ?>
    		<div class='btn-group pull-right'>
				<button class="btn btn-default btn-sm" onclick="editWorkOrderNote(<?php echo $work_order_note_id; ?>)"><span class="glyphicon glyphicon-edit"></span></button>
				<button class="btn btn-default btn-sm" onclick="deleteWorkOrderNote(<?php echo $work_order_note_id; ?>)"><span class="glyphicon glyphicon-trash"></span></button>
			</div>
			<?php } ?>
	    	<p id="noteHolder_<?php echo $work_order_note_id; ?>"><?php echo "$note"; ?></p>
	    	<small class='text-muted'><span class="glyphicon glyphicon-time"></span> <?php echo "$human_time"; ?></small>
	    	
	    	<?php if($date_modified != 0){ ?>
	    		<br><small class='text-muted'><span class="glyphicon glyphicon-time"></span> <?php echo "$date_modified"; ?></small>
	    	<?php } ?>
	    	<hr>   
	</div>
	<div class="col-md-11 hide" id="workOrderNoteEditCol2_<?php echo $work_order_note_id; ?>">
	    	<textarea id="note_<?php echo $work_order_note_id; ?>" class="form-control input-lg"><?php echo "$note"; ?></textarea>
	    	<br>
	    	<small class='text-muted pull-left'><span class="glyphicon glyphicon-time"></span> <?php echo "$human_time"; ?></small>
	    	<div class='btn-group pull-right'>
				<button class="btn btn-default btn-sm" onclick="cancelWorkOrderEdit(<?php echo $work_order_note_id; ?>)"><span class="glyphicon glyphicon-remove"></span></button>
				<button class="btn btn-default btn-sm" onclick="processEditWorkOrderNote(<?php echo $work_order_note_id; ?>)"><span class="glyphicon glyphicon-ok"></span></button>
			</div>
			<br>
	    	<hr>   
	</div>
</div>

<?php 
	
	} //End While
 } //END num rows = 0
} //End Isset

?>