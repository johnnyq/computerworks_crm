<?php

  include "config.php";
  include "includes/functions.php";

    $draw = $_GET["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_GET['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_GET['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    //if ($orderBy == 0) {$orderBy  = 1;}
    $orderType = $_GET['order'][0]['dir']; // ASC or DESC
    $start  = $_GET["start"];//Paging first record indicator.
    $length = $_GET['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

//

    	$q = "1";
		$type = "Laptop";
		$status = "stock";
		$location = "3";

$sql = "SELECT * FROM ( SELECT computer_id, system_number, system_number AS systemnumber, type, make, model, serial,  CONCAT(make, ' ', make,' ', serial) AS item, os, processor, hard_drive, memory, CONCAT(processor, ' ', memory, ' ', hard_drive) AS description,  price, status, date_added, date_added AS dateadded, label_printed, locations.location FROM computers, locations WHERE computers.location = locations.location_id
			AND computers.status LIKE '%$status%'
			AND locations.location_id LIKE '%$location%'
 ) a";


    function getData($sql){ 
        $query = mysqli_query($mysqli,$sql) OR DIE("Mysql Error : " . mysqli_connect_error());;
        $data = array();

        while($row = mysqli_fetch_array($query)){
                  //$data[] = "customername: ". $row['customername'] ;
				$id = $row['computer_id'];
                $system_number = $row['system_number'];
                $type = ucwords($row['type']);
                if($type == 'Laptop'){
                	$type = 'fa fa-laptop fa-2x';
                }elseif($type == 'Desktop'){
                	$type = 'fa fa-desktop fa-2x';
                }elseif($type == 'All-in-one'){
                	$type = 'fa fa-desktop fa-2x';
                }  
                $make = ucwords($row['make']);
                $model = ucwords($row['model']);
                $serial = $row['serial'];
                $os = $row['os'];
                $processor = $row['processor'];
                $hard_drive = $row['hard_drive'];
                $memory = $row['memory'];
                $price = $row['price'];
                $status = $row['status'];
                $human_time = human_time($row['date_added']);
                $date_added = date($date_format,$row['date_added']);
                $label_printed = $row['label_printed'];
		        if($label_printed == 1){
		            $print_label = "btn btn-default"; 
		        }else{
		            $print_label = "btn btn-danger";
		        }
                if($status == 'sold'){
                	$sql2 = mysqli_query($mysqli,"SELECT * FROM computer_sales, customers WHERE computer_sales.customer_id = customers.customer_id AND computer_sales.computer_id = $id ");
                	$row2 = mysqli_fetch_array($sql2);
                	$customer_id = $row2['customer_id'];
                	$last_name = ucwords($row2['last_name']);
    				$first_name = ucwords($row2['first_name']);
    				$sale_date = human_time($row2['sale_date']);
                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a> - $sale_date</small>";
                }elseif($status == 'returned'){
                	$sql2 = mysqli_query($mysqli,"SELECT * FROM computer_returns, customers WHERE computer_returns.customer_id = customers.customer_id AND computer_id = $id");
                	$row2 = mysqli_fetch_array($sql2);
                	$customer_id = $row2['customer_id'];
                	$last_name = ucwords($row2['last_name']);
    				$first_name = ucwords($row2['first_name']);
                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a></small>";
                }else{
                	$display = "";
                }
                $location = $row['location'];  


                $system_number ="<i class='$type'></i> $system_number";
                $item = "$make $model<br><small>$serial</small>";
                $description = "$processor<br><small>$memory MB / $hard_drive GB</small>";
                $status = "$status $display";
                //$dateadded = $human_time;
                $actions = "<div class='btn-group'>
							    <a class='btn btn-default $print_label' id='printComputerLabel_$id'><span class='glyphicon glyphicon-barcode'></span></a>
							    <a class='btn btn-default' href='edit_computer.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
							    <a class='btn btn-default' href='print_computer.php?id=$id'><span class='glyphicon glyphicon-print'></span></a>
                            </div>";

              
                  $data[]  = array(
                    "systemnumber"=>$system_number, 
                    "item"=>$item, 
                    "description"=>$description,  
                    "status"=>$status,
                    "price"=>$price,
                    "dateadded"=>$human_time,
                    "location"=>$location,
                    "actions"=>$actions
                    );
        }          
        return $data;
    }


    function getRecordsTotal($sql){ 
        $result = mysqli_query($mysqli,$sql);
        $recordsTotal = mysqli_num_rows($result);
        return $recordsTotal;
    }    


$recordsTotal = getRecordsTotal($sql);


 /* SEARCH CASE : Filtered data */
    if(!empty($_GET['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i<count($_GET['columns']);$i++){
            if ($_GET['columns'][$i]['searchable'] == 'true'){    
                $column = $_GET['columns'][$i]['data'];//we get the name of each column using its index from POST request
                $where[]="$column like '%".$_GET['search']['value']."%'";
                //$where[]=" MATCH(".$column.") AGAINST('".$_GET['search']['value']."') "; 
            }    
        }
        
            $where = "AND ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
            $constantWhere = " WHERE 1=1 ";
            /* End WHERE */

            $sql = sprintf("%s %s %s", $sql ,$constantWhere, $where);//Search query without limit clause (No pagination)
            //echo "1- ".$sql;

            $recordsFiltered = getRecordsTotal($sql);//Count of search result

            /* SQL Query for search with limit and orderBy clauses*/
            $sql = sprintf("%s %s ORDER BY %s %s limit %d , %d ", $sql , $where ,$orderBy, $orderType ,$start, $length);
            //echo "2- ".$sql;
            $data = getData($sql);
         
    } 
    /* END SEARCH */
    else {
        $sql = sprintf("%s %s ORDER BY %s %s limit %d , %d ", $sql ,$constantWhere, $orderBy,$orderType, $start , $length);
        //echo "3- ".$sql;
        $data = getData($sql);

        $recordsFiltered = $recordsTotal;
    }



    
    /* Response to client before JSON encoding */
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );

    echo json_encode($response);

?>