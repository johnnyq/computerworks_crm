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



$sql = "SELECT * FROM ( SELECT customer_id, first_name, last_name, CONCAT(first_name, ' ', last_name) AS fullname, company, address, city, state, zip, CONCAT(city, ' ', state, ' ', zip) AS address2, phone, email, CONCAT(phone, email) AS contact, date_added FROM customers ) a";

    function getData($sql){ 
        $query = mysqli_query($mysqli,$sql) OR DIE("Mysql Error : " . mysqli_connect_error());;
        $data = array();

        while($row = mysqli_fetch_array($query)){
                  //$data[] = "customername: ". $row['customername'] ;

                $id = $row['customer_id'];
                $company = $row['company'];
                $last_name = ucwords($row['last_name']); 
                $first_name = ucwords($row['first_name']);
                $fullname = $row['fullname'];
                $customer_name = "<a href='customer_details.php?id=$id'>$fullname $company</a>";
                $address = ucwords($row['address']);
                $city = $row['city'];
                $state = $row['state'];
                $zip = $row['zip'];
                $customer_address = "$address<br><small>$city $state $zip</small>";
                $phone = $row['phone']; 
                if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
                $email = $row['email'];
                $contact = "$phone<br><small>$email</small>";
                $human_time = human_time($row['date_added']);
                $date_added = date($date_format,$row['date_added']);
                $date_added = "<a data-toggle='tooltip' title='$date_added'>$human_time</a>";

                $total_sales = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_sales WHERE customer_id = $id"));
                if($total_sales > 0){
                    $display_sales = "$total_sales <i class='glyphicon glyphicon-shopping-cart'></i>";
                }else{
                    $display_sales = '';
                }
                $total_returns = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM computer_returns WHERE customer_id = $id"));
                if($total_returns > 0){
                    $display_returns = "$total_returns <i class='glyphicon glyphicon-refresh'></i>";
                }else{
                    $display_returns = '';
                }
                $total_work_orders = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM work_orders WHERE customer_id = $id"));
                if($total_work_orders > 0){
                    $display_work_orders = "$total_work_orders <i class='glyphicon glyphicon-wrench'></i>";
                }else{
                    $display_work_orders = '';
                }
                $total_customer_notes = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM customer_notes WHERE customer = $id"));
                if($total_customer_notes > 0){
                    $display_customer_notes = "$total_customer_notes <i class='glyphicon glyphicon-pencil'></i>";
                }else{
                    $display_customer_notes = '';
                }
   
                $stats = "$display_sales $display_returns $display_work_orders $display_customer_notes";    
                  $data[]  = array(
                    "fullname"=>$customer_name, 
                    "address"=>$customer_address, 
                    "contact"=>$contact,  
                    "date_added"=>$date_added,
                    "stats"=>$stats
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