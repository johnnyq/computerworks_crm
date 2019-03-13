	</div>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src='js/DYMO.Label.Framework.js'></script>
	<script src='js/PreviewAndPrintLabel.js'></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/bootstrap-editable.min.js"></script>
  </body>
</html>

<?php 
	
	//LOGGING PAGE VIEWS
	$page = $_SERVER["REQUEST_URI"];
	$ip = $_SERVER['REMOTE_ADDR'];
	$sql = "INSERT INTO logs VALUES('','Page View','$ip','$session_user_id',UNIX_TIMESTAMP(now()),'page \\<\\a href\\=\\$page\\>\\$page\\<\\/a\\>\\ viewed')";
	mysqli_query($mysqli,$sql);
		
?>