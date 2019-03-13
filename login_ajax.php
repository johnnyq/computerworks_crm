 <?php

 include "config.php";
 include "includes/functions.php";
 session_start();


 if(isset($_POST['login'])){

      $usr = mysqli_real_escape_string($mysqli,$_POST['username']);
      $pas = mysqli_real_escape_string($mysqli,$_POST['password']);

      $sql = mysqli_query($mysqli,"SELECT * FROM users WHERE (username = '$usr' OR user_email = '$usr') AND password = '$pas' AND security_level > 1 LIMIT 1");

      //LOGGING
      $ip = $_SERVER['REMOTE_ADDR'];
      $log_date = time();

      if(mysqli_num_rows($sql) == 1){
          $row = mysqli_fetch_array($sql);
          session_start();
          $_SESSION['logged'] = TRUE;
          $_SESSION['user_id'] = $row['user_id'];
          $session_user_id = $row['user_id'];
          $start_page = $row['start_page'];
          //LOGGING PAGE VIEWS
          $sql = mysqli_query($mysqli,"INSERT INTO logs SET log_type = 'Login Success', ip = '$ip', log_date = $log_date, log_details = 'User $usr Logged in Successfully', user_id = $session_user_id");
          echo "<script> window.location.href = '$start_page'; </script>";
          //header("Location: $start_page");
          exit;
      }else{
          $sql = mysqli_query($mysqli,"INSERT INTO logs SET log_type = 'Login Failed', ip = '$ip', log_date = $log_date, log_details = 'Login Failed using username $usr', user_id = 1");  
          echo "<div class='alert alert-warning'><strong>Invalid Username/Email Address or Password.</strong><button class='close' data-dismiss='alert'>&times;</button></div>";
      }
  }

  ?>