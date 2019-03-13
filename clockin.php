<?php
// USAGE:  UTimeFromTo($unit, $time_from, $time_to)
// $unit =  "day", "week", "month", "year".
// EXAMPLE USAGE: UTimeFromTo('day', -2, 0) 		// Return UTIME from two days ago to today.
//				  UTimeFromTo('day', 1, 1) 		// Return UTIME of tomorrow.
//				  UTimeFromTo('day', 0, 0) 		// Return UTIME for today
//				  UTimeFromTo('week', -1, -1) 	// Return Last week NOT including this week
//				  UTimeFromTo('week', -1, 0) 	// Return Last week AND this week
//				  UTimeFromTo('month', 0, 0) 	// Return This month only.
//				  UTimeFromTo('year', 0, 0) 	// current year.
//				  UTimeFromTo('year', -1, 0)	    // last year and this year.
//								decade coming soon!! LOL.

function UTimeFromTo($unit, $time_from, $time_to){
	//Get time variables (current day, month, and year)
	$time_from = ($time_from * -1);
	$time_to = ($time_to * -1);

	$timenow = time();
	$timedays  = date('j',$timenow);
	$timemonths  = date('n',$timenow);
	$timeyears  = date('Y',$timenow);

    $start_time = mktime(0, 0,1 , $timemonths, $timedays, $timeyears);


	    switch ($unit) {
	    case "day":
				$utime_from = mktime(0, 0,1 , $timemonths, ($timedays - $time_from), $timeyears);
			    $utime_to = mktime(0, 0,-1 , $timemonths, ($timedays - $time_to)+1  , $timeyears);
	        break;
	    case "week":
	   		    //$utime_from = mktime(0, 0,1 , $timemonths, ($timedays - (($time_from+1) * 7)) +1, $timeyears);
			    //$utime_to = mktime(0, 0,-1 , $timemonths, ($timedays - ($time_to * 7)) + 1 , $timeyears);
			    $utime_from = weekUTime($time_from);
			    $utime_to = weekUTime($time_to) +(7*24*60*60)-2;
			    //$utime_to =  $utime_from + ((7*24*60*60)-2) * ((abs($time_from)+1)/(abs($time_from)+1));
			    //echo "<big>".((abs($time_from)+1)/(abs($time_from)+1))."</big>";
			    //echo "<big> from ".$time_from." time to ".$time_to."</big>";
	        break;
	    case "month":
				$utime_from = mktime(0, 0,1 , ($timemonths  - $time_from) , 1 , $timeyears);
			    $utime_to = mktime(0, 0,-1 , ($timemonths  - $time_to) + 1, 1 , $timeyears);
	        break;
	    case "year":
				$utime_from = mktime(0, 0,1 , 1 , 1 , ($timeyears  - $time_from));
			    $utime_to = mktime(0, 0,-1 , 1, 1 , ($timeyears - $time_to) + 1);
	        break;
	    }


	$time = array();
    $time['from'] = $utime_from;
    $time['to'] = $utime_to;

	return $time;


}


function weekUTime($weekutime){
    //$weekutime = $weekutime * 1 ;
  	$timenow = time() ;
	$timedays  = date('j',$timenow);
	$timemonths  = date('n',$timenow);
	$timeyears  = date('Y',$timenow);

    $uweek_start = mktime(1, 0,1 , $timemonths, $timedays -1, $timeyears);

    //echo "<font  color='red'><b><br>utime".$weekutime."<-<br></b></font>";
    //$uweek_start = $uweek_start +  ($weekutime * 24*60*60) ;
    //echo ">>".date('l F j, Y g:ia', $uweek_start)."<<";
			//Get time variable when the week start date/time.

            //check where the week start
            if ((date('N',$uweek_start)<>7)){$week = -1;}else{$week = 0;}

   	                 //1         -1
			while($week < $weekutime) {
			$uweek_start = $uweek_start-(24*60*60);
			   if (date("N",$uweek_start)==7){$week++;}
			 //echo "<font  color='red'><b><br>->ooouweek_start".date('l F j, Y g:ia',$uweek_start)."<-<br></b></font>";

			}

	        $week = 0;
	        		//1         -1
 			while(($week > $weekutime)  ) {
			$uweek_start=$uweek_start+(24*60*60);

			 if (date('N',$uweek_start)==7){$week--;}
			 //echo "<br>".date('N',$uweek_start)." == week<br>";
		   //echo "<font  color='blue'><b><br>->pppuweek_start".date('l F j, Y g:ia',$uweek_start)."<-<br></b></font>";
			}

			$week = 0;
 			while(($week == $weekutime)  AND (date('N',$uweek_start)<>7) ) {
			$uweek_start=$uweek_start-(24*60*60);

			 if (date('N',$uweek_start)==7){$week--;}
			 //echo "<br>".date('N',$uweek_start)." == week<br>";
		      //echo "<font  color='yellow'><b><br>->pppuweek_start".date('l F j, Y g:ia',$uweek_start)."<-<br></b></font>";
			}

     return $uweek_start;


}

 function getPayDay($time){
 //$payday =  $timenow ;
 $first_week_utime = (5*60*60) + (4*24*60*60) - 1;
$time = $time + $first_week_utime ;


 //echo "<br><b><big>UnixTime</big>";
 //echo date("l F j, Y g:ia",$first_week_utime);
  //echo "<br><big>END</big></b>";


 $time = $time  /  (7*24*60*60)  ;
		if($time&1) {

		return  true;
		} else {

		return false;
		}

   //5*60*60
 //start
 //1361077201
 //- (7*24*60*60)

 }

?>


<?php
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";




//include("functions/utimefromto.php");

 //$utime  = UTimeFromTo('week', 0, 0);
//$time_from =  $utime['from'];
//$time_to =  $utime['to'];
//echo  "<b><big>".date('l F j, Y, g:i a',$time_from)." To ".date('l F j, Y, g:i a',$time_to)."</big></b>";

$selfserverself = $_SERVER['PHP_SELF'];
$selfserveruri = $_SERVER['REQUEST_URI'];
$time_now = time() / (7*24*60*60);
if(isset($_GET["user_id"])){
	$user_id =$_GET["user_id"];
}else{
	$user_id = $session_user_id;
}

 if(isset($_GET["week"])){
 	  	$selectedweek =$_GET["week"];
 }else{
		$week_start = UTimeFromTo('week', 0, 0 );
		$week_from  = $week_start['from'];
		$week_to = $week_start['to'];
		//echo date("l F j, Y g:ia",$week_from);
       // echo getPayDay($week_from+1); echo "zbbz<br>";

        if (getPayDay($week_from+1) == true){
        	$selectedweek = 1;
        }else{
        	$selectedweek = 0;
        }
      }

if(isset($_GET['search']) ){
	$user_id = $_GET['user_id'];
		 if((isset($_GET["date"])) AND ($_GET['date'] == "")){
		 	$search_date = time();
	     }else{
     	 	$search_date = strtotime($_GET['date']);
     	 	$search_current_day = date("N",$uweek_start);
     	 	$search_date = strtotime($_GET['date'])-($search_current_day*24*60*60);
     	 }
 	$search_date = $search_date / (7*24*60*60)+1;

 	//echo "<b><b>".$search_date."</b></b><br>";
 	$time_now = time() / (7*24*60*60);
 	$search_date = (floor((($time_now - $search_date)) +1)*-1);
 	//echo $search_date;
 	$selectedweek = $search_date;
}

?>

<form class='form-inline well' action="<?php echo $selfserverself; ?>" method="GET">
	<select class='form-control' name='user_id'>
		<?php
		$sql = mysqli_query($mysqli,"SELECT * FROM users");
		while($row = mysqli_fetch_array($sql))
		{
		 //echo "<option value='".$row2['store_id']."'>".$row2['store'];
		 if ($row['user_id'] == $user_id)
		 {echo "<option value=\"".$row['user_id']."\" selected='selected'>".$row['user_first_name']." ".$row['user_last_name']."\n  ";}
		 else{echo "<option value=\"".$row['user_id']."\">".$row['user_first_name']." ".$row['user_last_name']."\n  ";}
		}
		?>
	</select>

	<input class='form-control' name='date' placeholder='date' id='dp1' type='text'>
	<button class='btn btn-primary' type='submit' name='search'><i class='glyphicon glyphicon-search'></i></button>
</form>


<?php

	     $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE user_id = ".$user_id." ");
		 while ($row = mysqli_fetch_array($sql)){
		   $user_id = $row['user_id'];
		   $user_first_name = $row['user_first_name'];
		   $user_last_name = $row['user_last_name'];
		 }
 // loop two weeks, 1 = 2 weeks (can be 0 (for one week) or  1 (for two weeks)
 	 $total_weeks = 1 ;
     for ($j = 0; $j<=$total_weeks; $j++) {
        //$selectedweek = $selectedweek  ;
			$week_start = UTimeFromTo('week', ($selectedweek + $j) - 1, ($selectedweek + $j) -1 );
			$week_from  = $week_start['from'];
			$week_to = $week_start['to'];

			//if (getPayDay($week_from+1) == 1){}

?>

		   <h4> <?php echo date('l F j, Y',$week_start['from']).",".date('l F j, Y',$week_start['to'])." - ".$user_first_name." ".$user_last_name; ?></h4>
		   <table class='table table-striped table-bordered'>

			  <table class='table table-striped table-bordered'>
			  <tr>


		       <th colspan='2'>Sunday</th>
		       <th colspan='2'>Monday</th>
		       <th colspan='2'>Tuesday</th>
		       <th colspan='2'>Wednesday</th>
		       <th colspan='2'>Thursday</th>
		       <th colspan='2'>Friday</th>
			   <th colspan='2'>Saturday</th>



			   <th>Total</th>
			  </tr>
			  <tr>
			    <th>In</th>
			    <th>Out</th>
			    <th>In</th>
			    <th>Out</th>
			    <th>In</th>
			    <th>Out</th>
			    <th>In</th>
			    <th>Out</th>
			    <th>In</th>
			    <th>Out</th>
			    <th>In</th>
			    <th>Out</th>
			    <th>In</th>
			    <th>Out</th>
			    <th>Total</th>
			  </tr>
			  <tr>
		<?php

					$total_hours = 0;
					$day_clock_arr = array();
					$day_clock_note_arr = array();
		            for ($i = 0; $i<=6; $i++) {
		              $day_start_time = $week_from + ($i*24*60*60);
		              $day_end_time = $day_start_time + ((24*60*60) -2);

		             // echo date("l F j, Y g:ia",$day_start_time)." start".$day_start_time;
		             // echo getPayDay($day_start_time); echo "<br>";
		             // echo date("l F j, Y g:ia",$day_end_time)." end".$day_end_time;
		             //  echo getPayDay($day_end_time); echo "<br>";
		              $date_clock_in  = date("F j, Y,",$day_start_time);
		              $sql = mysqli_query($mysqli,"select * from employee_clockin_clockout
		              WHERE clock_in >= $day_start_time AND clock_in <= $day_end_time AND user_id=$user_id");
					 	  if (mysqli_num_rows($sql) == 0)
					 	  {
					 	  	//echo "<td>--</td><td>--</td>";
                          array_push($day_clock_arr, "--");
                          array_push($day_clock_note_arr, "");

					 	  echo "<td><div ><p align='center' rel='inline' id='clockintime_".$i.$j."' data-type='text' data-pk='7777'
					 	  		 data-params='{\"add_clock_in\": \"$date_clock_in\"}'
								 data-url='post.php' data-original-title='Moidfy Time' data-name='add_clock_in'>--</p></div></td>";

					 	  echo "<td><div><p>--</p></div></td>";
					 	   }
					 	  else{
						 	  while($row = mysqli_fetch_array($sql))
								{
								$clock_in=$row['clock_in'];
								$clock_out=$row['clock_out'];
		                        $clock_id=$row['clock_id'];
                                $clock_note=$row['clock_note'];
								}
			                    if ( ($clock_in <> 0) AND  ($clock_out <> 0) AND  ($clock_out > $clock_in) )
									{
										 $day_hours = $clock_out - $clock_in;
									     $total_hours = $total_hours + ($clock_out - $clock_in);

									     			$day_minutes = ($day_hours / (60));
													$day_hours = floor($day_hours/(60*60));
													$day_minutes = ($day_minutes % 60);
													$day_minutes =  str_pad($day_minutes, 2, "0", STR_PAD_LEFT);
													$day_hours = $day_hours.":".$day_minutes;
									} else{$day_hours = "--";}

                          array_push($day_clock_arr, $day_hours);
                          array_push($day_clock_note_arr, $clock_note);  

						  $clock_in  = date("g:ia",$clock_in);
						  if ($clock_out == 0){$clock_out = "??";}else{$clock_out = date("g:ia",$clock_out);}

					 	  echo "<td><div><p align='center' id='clockintime_".$i.$j."' data-type='text' data-pk='".$clock_id."'
					 	  		 data-params='{\"modify_clock_in\": \"1\",\"clock_in_date\": \"$date_clock_in\",\"clock_in_time\": \"$clock_in\",\"clock_in_id\": \"$clock_id\"}'
								 data-url='post.php' data-original-title='Moidfy Time'   data-name='modify_clock_in'>".$clock_in."</p></div></td>";

					 	  echo "<td><div><p id='clockouttime_".$i.$j."' data-type='text' data-pk='".$clock_id."'
					 	  		 data-params='{\"modify_clock_out\": \"1\",\"clock_out_date\": \"$date_clock_in\",\"clock_out_id\": \"$clock_id\"}'
								 data-url='post.php' data-original-title='Moidfy Time' data-name='modify_clock_out'>".$clock_out."</p></div>
								";




						  //echo "<td><div id='me2'>".$clock_out."</div></td>";


						  //echo "<td colspan='2'>Total: ".$total_hours."</td>";
					 	  }
		            }

		?>
		
		<?php
			$total_minutes = ($total_hours / (60));
			$total_hours = floor($total_hours/(60*60));
			$total_minutes = ($total_minutes % 60);
			$total_minutes =  str_pad($total_minutes, 2, "0", STR_PAD_LEFT);
		?>
			  	<td><?php echo $total_hours.":".$total_minutes; ?></td>
			  </tr>
			  <tr>
       <?php
        for ($i = 0; $i<=6; $i++) {
        echo "<th colspan='2' ><div class='pagination-centered'><small>".$day_clock_arr[$i]."</small>";

        				    if ($day_clock_note_arr[$i] <> ""){
						  	$short_clock_note = substr($day_clock_note_arr[$i], 0, 3)."...";
						  	echo "<p data-original-title='".$day_clock_note_arr[$i]."' rel='tooltip'> <span class='label label-info'>".$short_clock_note."</span>
						  	 </p>";}
        echo "</div></th>";
        }
       ?>

 
			    <th>Total</th>
			  </tr>



			</table>
			</table>
<?php

}

?>


	<ul class='pager pull-left'>
      <li><a href='<?php echo $selfserverself."?user_id=".$user_id."&week=".($selectedweek - 2); ?>'>Previous Week</a></li>
      <li><a href='<?php echo $selfserverself."?user_id=".$user_id."&week=".($selectedweek + 2); ?>'>Next Week</a></li>
    </ul>
	<br><br>

<?php include('includes/footer.php'); ?>

<script>
$(document).ready(function() {

	    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     

    $('[id^="clockintime_"]').editable();
    $('[id^="clockouttime_"]').editable();
     
});

</script> 