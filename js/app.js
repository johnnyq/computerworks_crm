

	$("#globalQuery").keyup(function(){
		var q = $("#globalQuery").val();
		q = "q="+q+"";
		globalSearch(q);	
	});

	function globalSearch(q){		
		$.ajax({
			url: "global_search_ajax.php?"+q+"",      
		}).success(function(response) {
			$("#globalResults").html(response);
		});
	}

	$('[id^="printComputerLabel_"]').click(function(){
		//Show Print Label Modal	
		var computerID = this.id;
		computerID = computerID.split("_");
	 	computerID = computerID[1];
		previewAndPrint('computerLabel',computerID);
		$('#computerLabelModal').modal("show");
		//Change Print Label Button Color
		$.ajax({
	    	url: "post.php?change_print_label_status=1&id="+computerID+"",       
		}).success(function(response){
	  		cancelEdit(computerID);
	  		$("#printComputerLabel_"+computerID).removeClass("btn-danger");
		});
	});



	$('[id^="printCustomerAddressLabel_"]').click(function(){
		//Show Print Label Modal	
		var customerID = this.id;
		customerID = customerID.split("_");
	 	customerID = customerID[1];
		previewAndPrint('customerAddressLabel',customerID); 
		$('#customerAddressLabelModal').modal("show");

	 
		
	});



	$('[id^="printWorkOrderLabel_"]').click(function(){
		//Show Print Label Modal	
		var workOrderID = this.id;
		workOrderID = workOrderID.split("_");
	 	workOrderID = workOrderID[1]; 
		previewAndPrint('workOrderLabel',workOrderID);
		$('#workOrderLabelModal').modal("show"); 

	 
		
	});

	
	 function computerTemplateListReady(){
	 	//Delete Computer Template
	    $('[id^="computerTemplateContainter_"]').on('closed.bs.alert', function () {
	    	var computerTemplateID = this.id;
			computerTemplateID = computerTemplateID.split("_");
		 	computerTemplateID = computerTemplateID[1];
	  		

	  		$.ajax({
		    	url: "post.php?delete_computer_template="+computerTemplateID+"",       
			}).success(function(response){
		  		$("#response").html(response); 
			});

		})
		//add Template
		$('[id^="computer_template_form_"]').submit(function(e)
		 {
				var postData = $(this).serializeArray();	  

				for (var i = 0, l = postData.length; i < l; i++) { 

					dataID = postData[i].name.toString(); 
					if( $('#'+dataID).length )         // Check if id exists
					{
					   $('#'+dataID).val(postData[i].value);
					}	    
				}

			    e.preventDefault(); //STOP default POST action
		});

	}

	function loadSalesHistory(customerId){
		$.ajax({
	    	url: "customer_details_sales.php?id="+customerId+"",      
		}).success(function(response){
			$("#salesHistory").html(response); 		
		});
	}

	function loadReturnsHistory(customerId){
		$.ajax({
	    	url: "customer_details_returns.php?id="+customerId+"",      
		}).success(function(response){
			$("#returnsHistory").html(response); 		
		});
	}

	function loadOpenWorkOrders(customerId){
		$.ajax({
	    	url: "customer_details_open_work_orders.php?id="+customerId+"",      
		}).success(function(response) {
			$("#openWorkOrders").html(response); 		
		});
	}

	function loadWorkOrderHistory(customerId){	
		$.ajax({
	    	url: "customer_details_work_order_history.php?id="+customerId+"",      
		}).success(function(response) {
			$("#workOrderHistory").html(response); 		
		});
	}

	function loadNotes(customerId){
		$.ajax({
	    	url: "customer_details_notes.php?id="+customerId+"",      
		}).success(function(response) {
			$("#notesHistory").html(response); 		
		});
	}

	$("#formSale").submit(function(e){
		var postData = $(this).serializeArray();	   
	    $.ajax({
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
				$("#response").html(response);
	        	$('#collapseSale').collapse('toggle');
	        	$("#formSale")[0].reset();
				reloadAll();
	        	
			}, 	
	    });
	    
		e.preventDefault(); //STOP default POST action
	});

	$("#formWorkOrder").submit(function(e){
		var postData = $(this).serializeArray();	   
	    $.ajax({
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            $('#collapseWorkOrder').collapse('toggle');
	        	$("#formWorkOrder")[0].reset();
				reloadAll();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	$("#formNote").submit(function(e){
		var postData = $(this).serializeArray();	   
	    $.ajax({
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            $('#collapseNote').collapse('toggle');
	        	$("#formNote")[0].reset();
				reloadAll();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	function collapseExtendWarranty(id){	
		$( "#collapseExtendWarranty_"+id ).removeClass("hide");
		$( "#collapseExtendWarranty_"+id ).hide();
		$( "#collapseExtendWarranty_"+id ).fadeIn( "slow", function() {});
	}

	function cancelExtendWarranty(id){	
		$( "#collapseExtendWarranty_"+id ).addClass("hide");
		$( "#collapseExtendWarranty_"+id ).fadeIn( "slow", function() {});
	}

	function processExtendWarranty(id){	
		var warranty = $( "#warranty_"+id ).val();
		$.ajax({
	    	url: "post.php?extend_warranty="+id+"&warranty="+warranty+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelExtendWarranty(id);
			reloadAll();
		});
	}

	function collapseReturn(id){	
		$( "#collapseReturn_"+id ).removeClass("hide");
		$( "#collapseReturn_"+id ).hide();
		$( "#collapseReturn_"+id ).fadeIn( "slow", function() {});		
	}

	function cancelReturn(id){	
		$( "#collapseReturn_"+id ).addClass("hide");
		$( "#collapseReturn_"+id ).fadeIn( "slow", function() {});
	}

	function processReturn(id){	
		var reason = $( "#reason_"+id ).val();
		$.ajax({
	    	url: "post.php?computer_return="+id+"&reason="+reason+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelReturn(id);
			reloadAll();
		});
	}

	function collapseInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).removeClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).hide();
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
	}

	function cancelInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).addClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
	}

	function processInsideWorkOrder(id){	
		var customer = $( "#customer_"+id ).val();
		var type = $( "#type_"+id ).val();
		var make = $( "#make_"+id ).val();
		var model = $( "#model_"+id ).val();
		var serial = $( "#serial_"+id ).val();
		var scope = $( "#scope_"+id ).val();
		var takeInNotes = $( "#takein_notes_"+id ).val();
		$.ajax({
	    	url: "post.php?new_inside_work_order="+id+"&scope="+scope+"&takein_notes="+takeInNotes+"&type="+type+"&make="+make+"&model="+model+"&serial="+serial+"&customer_id="+customer+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelInsideWorkOrder(id);
			reloadAll();
		});
	}

	function deleteNote(id){	
		$.ajax({
	    	url: "post.php?delete_customer_note="+id+"",       
		}).success(function(response) {
	  		$( "#note_"+id ).slideUp( "slow", function() {
			});
		});
	}

	function editNote(id){	
		$( "#noteCol2_"+id ).addClass("hide");
		$( "#noteEditCol2_"+id ).removeClass("hide");
		$( "#noteEditCol2_"+id ).hide();
		$( "#noteEditCol2_"+id ).fadeIn( "slow", function() {});
	}

	function cancelEdit(id){
		$( "#noteEditCol2_"+id ).addClass("hide");
		$( "#noteCol2_"+id ).removeClass("hide");
		$( "#noteCol2_"+id ).hide();
		$( "#noteCol2_"+id ).fadeIn( "slow", function() {});
	}

	function processEditNote(id){	
		var note = $( "#txtNote_"+id ).val();
		$.ajax({
	    	url: "post.php?edit_customer_note="+id+"&note="+note+"",       
		}).success(function(response) {
	  		cancelEdit(id);
	  		$( "#noteHolder_"+id ).html($( "#txtNote_"+id ).val());
		});
	}

	$("#cannedResponses").change(function() {
			$("textarea[name=note]").val($(this).val());
	});

	$("#formWorkOrderNote").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            reloadWorkOrderNotes();
	            $('#collapseNote').collapse('toggle');
	        	$("#formWorkOrderNote")[0].reset();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	function removeWorkOrderBtnClass(){
		$("#TBI").removeClass("btn-primary");
		$("#IP").removeClass("btn-primary");
		$("#OH").removeClass("btn-primary");
		$("#RFC").removeClass("btn-primary");
		$("#PU").removeClass("btn-primary");
	}

	function updateStatusTBI(id){
		$.ajax({
	    	url: "post.php?update_work_order_status&id="+id+"&status=To Be Inspected",      
		}).success(function(response) {
	 		 removeWorkOrderBtnClass();
			 $("#TBI").addClass("btn-primary");
			 loadWorkOrderNotes(id);
		});
	}

	function updateStatusIP(id){	
		$.ajax({
	    	url: "post.php?update_work_order_status&id="+id+"&status=In Progress",      
		}).success(function(response) {
	 		 removeWorkOrderBtnClass();
			 $("#IP").addClass("btn-primary");
			 loadWorkOrderNotes(id);
		});
	}

	function updateStatusOH(id){	
		$.ajax({
	    	url: "post.php?update_work_order_status&id="+id+"&status=On Hold",      
		}).success(function(response) {
	 		removeWorkOrderBtnClass();
			$("#OH").addClass("btn-primary");
			loadWorkOrderNotes(id);
		});
	}

	function updateStatusRFC(id){	
		$.ajax({
	    	url: "post.php?update_work_order_status&id="+id+"&status=Ready For Collection",      
		}).success(function(response) {
	 		removeWorkOrderBtnClass();
			$("#RFC").addClass("btn-primary");
			loadWorkOrderNotes(id);
		});
	}

	function updateStatusPU(id){	
		$.ajax({
	    	url: "post.php?update_work_order_status&id="+id+"&status=Picked Up",      
		}).success(function(response) {
	 		removeWorkOrderBtnClass();
			$("#PU").addClass("btn-primary");
			loadWorkOrderNotes(id);
		});
	}

	function loadWorkOrderNotes(workOrderId){
		$.ajax({
	    	url: "wo_notes.php?id="+workOrderId+"",      
		}).success(function(response) {
			$("#work_order_notes").html(response); 		
		});
	}

	function loadComputerTemplateList(){
		$('#computerTemplatesList').html("<div align='center'><img src='img/loading.gif'></div>");	
	  	 
		$.ajax({
	    	url: "computer_templates.php",      
		}).success(function(response) {
			$("#computerTemplatesList").html(response); 
			computerTemplateListReady(); 	
		});
	}


	function deleteWorkOrderNote(id){	
		$.ajax({
	    	url: "post.php?delete_work_order_note="+id+"",       
		}).success(function(response) {
	  		$( "#workOrderNote_"+id ).slideUp( "slow", function() {
			});
		});
	}

	function editWorkOrderNote(id){	
		$( "#workOrderNoteCol2_"+id ).addClass("hide");
		$( "#workOrderNoteEditCol2_"+id ).removeClass("hide");
		$( "#workOrderNoteEditCol2_"+id ).hide();
		$( "#workOrderNoteEditCol2_"+id ).fadeIn( "slow", function() {});	
	}

	function cancelWorkOrderEdit(id){
		$( "#workOrderNoteEditCol2_"+id ).addClass("hide");
		$( "#workOrderNoteCol2_"+id ).removeClass("hide");
		$( "#workOrderNoteCol2_"+id ).hide();
		$( "#workOrderNoteCol2_"+id ).fadeIn( "slow", function() {});
		
	}

	function processEditWorkOrderNote(id){	
		var note = $( "#note_"+id ).val();
		$.ajax({
	    	url: "post.php?edit_work_order_note="+id+"&note="+note+"",       
		}).success(function(response) {
	  		cancelEdit(id);
	  		$( "#noteHolder_"+id ).html($( "#note_"+id ).val());
			reloadWorkOrderNotes();  
		});
	}

	function generateSystemNumber(){
		$.ajax({
		url: "generate_system_number.php"       
		}).success(function(response) {
	  		$( "#systemNumber" ).val(response);
		});

	}

	$("#serial").keyup(function(){
		var q = $("#serial").val();
		$.ajax({
		    url: "check_dup_serial.php?q="+q+"",      
		}).success(function(response) {
		    $("#dupSerial").html(response);
		});		
	});

	$("#formAddComputer").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {     
	            $("#response").html(response);
	            $("#formAddComputer")[0].reset();
	            generateSystemNumber();
	            loadComputerTemplateList();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	$("#ajaxform").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            $("#ajaxform")[0].reset();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});
	$("#ajaxEditForm").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});


 






	$("#clockid").click(function(){
		var clockID = $("#clockid").attr("value");
		$.ajax({
		    url: "post.php?clock_id="+clockID+"",      
		}).success(function(response) {
				if ($("#clockStatus").text().trim() == "Clockin"){
		  		  $("#clockStatus").text("Clock Out");
		  		}else{
		  		  $("#clockStatus").text("Clocked Out for the Day");		
		  		}
		   $("#globalResults").html(response);
		});		
	});

	$(function() {
	    // Highlight the active nav link.
	    var url = window.location.pathname;
	    var filename = url.substr(url.lastIndexOf('/') + 1);
	    $('.navbar a[href$="' + filename + '"]').parent().addClass("active");
	});

	$(function() {
	    // Highlight the active nav link.
	    var url = window.location.pathname;
	    var filename = url.substr(url.lastIndexOf('/') + 1);
	    $('.nav a[href$="' + filename + '"]').parent().addClass("active");
	});

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});

	$('#dataTables').DataTable({
		stateSave: true
	});
	$('#dataTables2').DataTable({
		stateSave: true,
		aaSorting: []

	});
	$('#dataTables3').DataTable({
		stateSave: true
	});
	$('#dataTables4').DataTable({
		stateSave: true
	});
	$('#dataTables5').DataTable({
		stateSave: true
	});

	$('#dTa').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "customers_ajax.php"
    } );