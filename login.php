<?php

session_start();

if(isset($_SESSION['loginemail']))
{
  $email = $_SESSION['loginemail'];
  if($email == "skprajapati.shivu@gmail.com")
  {
    header('location:admin/adminhome.php');
  }
  else
  {
    header('location:userhome.php');
  }
}


if(isset($_POST['loginemail']) && isset($_POST['loginpwd']))
{

    $email = $_POST['loginemail'];
    $pwd = $_POST['loginpwd'];

    if($email == "skprajapati.shivu@gmail.com")   
    {
        if($pwd == "iamadmin")
        {
          $_SESSION["loginemail"]=$_POST["loginemail"];
          $_SESSION["loginpwd"]=$_POST["loginpwd"];
          header('location:admin/adminhome.php');
        }
        else
        {
          echo '<script language="javascript">';
          echo 'alert("Password is incorrect")';
          echo '</script>';
        }
    }

    
    

    
    else
    {
      $_SESSION["loginemail"]=$_POST["loginemail"];
      $_SESSION["loginpwd"]=$_POST["loginpwd"];

      $temp = 0;
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "blog";

      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $db);

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT * FROM blogger_info";
      $user = mysqli_query($conn,$sql);

      while($row = mysqli_fetch_array ($user,MYSQLI_ASSOC)) 
      {
        if($email == $row["blogger_username"])
        {
          $temp = 1;
          if($pwd == $row["blogger_password"])
          {
            $temp = 2;
            break;
          }
          else
            break;
        }
      } 

      if($temp==0)
      {
        echo '<script language="javascript">';
        echo 'alert("Username is incorrect.")';
        echo '</script>';
        
      }
      else
      {
        if($temp==1)
        {
          echo '<script language="javascript">';
          echo 'alert("Password is incorrect.")';
          echo '</script>';
        }
      
        if($temp==2)
        {
          header('Location:userhome.php');
        }
      }
  mysqli_close($conn);
    }
    
}

?>
<!doctype html>
<html lang = "en">
<head>
<title>Login</title>
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
      	    <a href = "index.php" class = "navbar-brand">MyBlog</a>
    	</div>

    	<!-- Collect the nav links, forms, and other content for toggling -->
    	<div class="collapse navbar-collapse" id="bs-myBlog-navbar-collapse-1">
      		

          <ul class = "nav navbar-nav navbar-right">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>  
            <li><a href = "contact.php"><span class="glyphicon glyphicon-earphone"></span>  Contact us</a></li>
            <li class="active"><a href = "login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
            <li><a href = "signup.php"><span class="glyphicon glyphicon-user"></span>  Sign Up</a></li>
          </ul>
		</div>

	</div>	
</nav>

<!-- navigation bar ends-->

<div class = "container">
<div class = "rows">
  <div class = "col-md-4">
  </div>

  <!-- Log in Form Start -->
  <div class = "col-md-4">
  
  <div class="panel panel-primary">

  <div class = "panel-heading">
  <h4 class = "panel-title">Login</h4>
  </div>

  <div class = "panel-body">
    
    <form role = "form" method = "post" action = "login.php" id = "loginForm" onSubmit = "return validatePassword()">
      <div id = "l_e" class = "form-group">
        <label for = "loginEmail" class = "label-control">Email</label>
        
        <input id = "loginEmail" name = "loginemail" type = "email" class = "form-control" placeholder = "Enter Email"/>
        <span id="e_span" class="form-control-feedback glyphicon"></span>
        
      </div>
      
      <div id = "l_p" class = "form-group">
        <label for = "loginPassword" class = "label-control">Password</label>
        
        <input id = "loginPassword" name = "loginpwd" type = "password" class = "form-control" placeholder = "Enter Password"/>
        <span id="p_span" class="form-control-feedback glyphicon"></span>
        
      </div>
      
      <center><button type = "submit" class = "btn btn-info" id = "loginBtn">Login</button></center>
      
    </form>
  </div>  
  </div>
  <center><p>New to MyBlog ?</p></center>
  <center><p><a href = "signup.php">Click to register</a></p></center>
  </div>
  <!-- Login form ends -->
  
  <div class = "col-md-4">
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
<!-- validation starts-->
<script type = "text/javascript">

function validateText(id,id_p,id_s)
{
  var input = document.getElementById(id).value;
  var div = document.getElementById(id_p);
  var span = document.getElementById(id_s);

  

  if(input == null || input == "")
  {
    div.className = "form-group has-feedback has-error";
    span.className = "form-control-feedback glyphicon glyphicon-remove";
    return false;
  }
  else
  {
    div.className = "form-group has-feedback has-success";
    span.className = "form-control-feedback glyphicon glyphicon-ok";
    return true;
  }
  
}

function validatePassword()
{ 


  var loginemail = document.getElementById("loginEmail").value;
  var pass = document.getElementById("loginPassword").value;
  
  

  if(!validateText("loginEmail","l_e","e_span"))
  {
    alert("All fields are required.");
    return false;
  }

  if(!validateText("loginPassword","l_p","p_span"))
  {
    alert("All fields are required.");
    return false;
  }  
    
  
  return true;
}

</script>
<!-- validation ends-->

</body>
</html>