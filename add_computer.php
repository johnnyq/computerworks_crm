<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="computers.php">Computers</a></li>
  <li class="active">Add Computer</li>
</ol>    

<div id="response"></div>
<div class="col-md-5">
    <form id="formAddComputer" class="form-horizontal" autocomplete="off">
      <input type="hidden" name="add_computer" id="add_computer">
      <div class="form-group">
        <label class="control-label col-sm-3">System</label>
        <div class="col-sm-9">
        	<input type="text" class="form-control input-lg" name="system_number" id="systemNumber" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Type</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="type" id="type" autofocus required>
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
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Make</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="make" id="make" required>
	       		<option></option>	       		
	       		<?php
	       			
	       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'make' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
                <option>Other</option>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Model</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="model" id="model" required>
	    </div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3" id="serial">Serial</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="serial" id="serial" required>
	        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
	    	<div id="dupSerial"></div>
	    </div>

      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" >OS</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="os" id="os"  required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'os' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">COA</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="coa">
	    </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Processor</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="processor" id="processor" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'processor' ORDER BY value ASC");
					while($row = mysqli_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" >Memory</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="memory" id="memory" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'memory' ORDER BY ABS(value) ASC");
					while($row = mysqli_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" >Hard Drive</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="hard_drive" id="hard_drive" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysqli_query($mysqli,"SELECT * FROM commons WHERE category = 'harddrive' ORDER BY ABS(value) ASC");
					while($row = mysqli_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option value='$value'>$value GB</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" >Price</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="price" id="price" required> 
	    </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3" >Notes</label>
        <div class="col-sm-9">
	        <textarea class="form-control input-lg" name="notes" id="notes"></textarea>
	        <br>
			<div class="checkbox">
			    <label class="control-label">
			    	<input type="checkbox" name="save_template"> Save as template
			    </label>
			</div>
			<br>
			<button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Add</button>
	    </div>
      </div>
    </form>
</div>



<div id="computerTemplatesList"><div align='center'><img src='img/loading.gif'></div></div>







<?php include "includes/footer.php"; ?>

<script>

$(document).ready(function() {		
	generateSystemNumber();
	
    $('#processor').on('change', function() {
        var CPU = this.value;
        if(CPU == 'Core 2 Duo'){
            $("#price").val('179.99');
        } else if(CPU == 'Pentium Dual-core') {
            $("#price").val('179.99');
        } else if(CPU == 'Pentium Dual-core') {
            $("#price").val('179.99');
        } else if(CPU == 'Core i3') {
            $("#price").val('199.99');
        } else if(CPU == 'Core i5') {
            $("#price").val('249.99');
        } else if(CPU == 'Core i7') {
            $("#price").val('299.99');
        } else {
            $("#price").val('');
        }    
    });
    $('#hardDrive').on('change', function() {
        var HDD = this.value;
        if(HDD == '80'){
            $("#price").val('149.99');
        } 
    });

 loadComputerTemplateList(); 

})

</script>