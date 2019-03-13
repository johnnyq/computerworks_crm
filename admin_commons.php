<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    if(isset($_GET['q'])){
		$q = $_GET['q'];
		$sql2 = mysqli_query($mysqli,"SELECT * FROM commons WHERE category_id = $q ORDER BY common_id DESC");
		$num2 = mysqli_num_rows($sql2);
	}

	$sql = mysqli_query($mysqli,"SELECT * FROM commons_categories ORDER BY category_id DESC");
	
	$num = mysqli_num_rows($sql);

?>

<div class="row">
	<div class="col-md-3">
		<?php include "includes/admin_nav.php"; ?>
	</div>
	<div class="col-md-2">
	<a class="btn btn-primary" href='add_common.php'><span class="glyphicon glyphicon-plus"></span></a>
	<ul class="nav nav-pills  nav-stacked well well-sm">

<?php

	while($row = mysqli_fetch_array($sql)){
		$category_id = $row['category_id'];
        $category = $row['category'];

?>
		<li <?php if($q == $category_id){ echo "class='active'"; } ?>><a href="?q=<?php echo $category_id; ?>"><?php echo "$category"; ?></a></li>
<?php
	}
?>
	</ul>
	</div>
	<div class="col-md-7">



<div id="response"></div>

<br>

<?php

if($num2 > 0) { 

?>

<table class="table" <?php if($num2 > 10){ echo "id='dataTables'"; } ?>>	
    <thead>	
        <tr>	
            <th>Name</th>
            <th>Action</th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row2 = mysqli_fetch_array($sql2)){
				$common_id = $row2['common_id'];
                $common = $row2['value'];
         
                echo "
					<tr>
						<td>$common</td>
						<td>
							<div class='btn-group'>
								<a class='btn btn-default' href='edit_common.php?id=$common_id'><span class='glyphicon glyphicon-pencil'></span></a>
								<a class='btn btn-default' href='#'><span class='glyphicon glyphicon-remove'></span></a>
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
<?php

include "includes/footer.php";

?>