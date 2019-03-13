<nav class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="dashboard.php"><i class='fa fa-dashboard'></i> Dashboard</a></li>
      <li><a href="customers.php"><i class="fa fa-group"></i> Customers</a></li>
      <li><a href="computers.php"><i class="fa fa-desktop"></i> Inventory</a></li>
      <li><a href="work_orders.php"><i class="fa fa-wrench"></i> WorkOrders</a></li>
      <li><a href="reports.php"><i class="fa fa-bar-chart"></i> Reports</a></li>  
    </ul>
    <form class="navbar-form navbar-left">
        <input type="text" id="globalQuery" class="form-control" placeholder="Global Search">
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><img class="img-circle" src='<?php echo "$session_avatar"; ?>' height='48' width='48'></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo "$session_username"; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a id="clockid" href="#" value="<?php echo $clock_id; ?>"><i class="glyphicon glyphicon-time"></i> <span id="clockStatus"> <?php echo "$clock_status"; ?> </span></a></li>
          <li><a href="user_preferences.php"><i class="glyphicon glyphicon-cog"></i> Preferences</a></li>
          <li><a href="users.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
          <li><a href="clockin.php"><i class="glyphicon glyphicon-time"></i> Time Clockins</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div id="globalResults"></div>