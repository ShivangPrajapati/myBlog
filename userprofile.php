<?php
require('connect.php');
session_start();

if(isset($_SESSION["loginemail"]))
{
  $email = $_SESSION["loginemail"];
  $sql = "SELECT * FROM blogger_info WHERE blogger_username = '".$email."'";

  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_array ($result,MYSQLI_ASSOC)) 
    {
      $dispname = $row['blogger_name'];
      $creation_date = $row['blogger_creation_date'];
      $expiry_date = $row['blogger_end_date'];
      $status = $row['blogger_is_active'];
    }
?>
<!doctype html>
<html lang = "en">

<head>
<title>My profile</title>
<meta charset = "UTF-8" />
<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />

<link href = "css/bootstrap.min.css" rel = "stylesheet"/>
<link href = "css/style.css" rel = "stylesheet"/>


</head>

<body>

<!--navigation bar starts -->

<nav class = "navbar navbar-inverse navbar-static-top">
	<div class = "container">
    
		<!-- myBlog and toggle get grouped for better mobile display -->
    	<div class="navbar-header">
      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-myBlog-navbar-collapse-1" aria-expanded="false">
        		<span class="sr-only">Toggle navigation</span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
      	   <a href = "userhome.php" class = "navbar-brand">MyBlog</a>
    	</div>

    	<!-- Collect the nav links, forms, and other content for toggling -->
    	<div class="collapse navbar-collapse" id="bs-myBlog-navbar-collapse-1">
      		

          <ul class = "nav navbar-nav navbar-right">
            <li  class = "active"><a href = "userprofile.php"><span class="glyphicon glyphicon-user"></span> 
              <?php
                echo $dispname;  
              ?>
            </a></li>
            <li><a href="userhome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="contactus.php"><span class="glyphicon glyphicon-earphone"></span>  Contact</a></li>
            <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>  Log out</a></li>
          </ul>
		</div>

	</div>	
</nav>
<!-- navigation bar ends-->

<div class = "container">


<div class = "rows">
    <div class = "col-md-6 col-md-push-3">
      <p class = "h4">Your Profile</p>
      <hr>
      
        <p><b>Name : </b>
          <?php
            echo $dispname;
          ?>
        </p><br/>
        
        <p><b>Email id : </b>
          <?php
            echo $email;
          ?>
        </p><br/>
        
        <p><b>Status : </b>
          <?php
            if($status)
            {
              echo 'Active';
            }
            else
            {
              echo 'Blocked';
            }
          ?>
        </p><br/>
        
        <p><b>Account created on : </b>
          <?php
            echo $creation_date;
                      ?>
        </p><br/>
        <p><b>Account ends on : </b>
          <?php
            echo $expiry_date;
                      ?>
        </p><br/><br/>

        <center><p><a href = "changepwd.php">Change Password</a></p></center>
    </div>
    <div class = "col-md-3 col-md-pull-3">
    </div>    
    <div class = "col-md-3">
    </div>
  </div>

</div>


<!--footer starts-->

<div class = "navbar my-footer navbar-fixed-bottom">
  <div class = "navbar-inner">
    <div class = "container">
      <p class = "muted pull-left">© Copyright SkPrajapati Group 2016</p>
      <p class = "muted pull-right">Created by Shivang Prajapati</p>
    </div>
  </div>

</div>

<!--footer ends-->
<script src = "js/jquery-3.1.0.min.js"></script>
<script src = "js/bootstrap.min.js"></script>

</body>
</html>

<?php

}

?>