<?php

require('connect.php');

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


if(isset($_POST['subject']))
		{
			$b_email = $_POST['email'];
			$subject = $_POST['subject'];
			$msg = $_POST['msg'];
			$date = date("Y-m-d");

			$query = "INSERT INTO contact_request (blogger_username, request_sub, request_msg, request_date) VALUES ('$b_email', '$subject', '$msg', '$date')";
			$resulta = mysqli_query($conn,$query);

			if(!$resulta)
			{
				echo '<script language="javascript">';
			    echo 'alert("Request not sent")';
			    echo '</script>';
			    header("refresh: 2; url = contact.php");
			}
			else
			{
				echo '<script language="javascript">';
			    echo 'alert("Request successfully sent")';
			    echo '</script>';
			    header("refresh: 2; url = index.php");
			}

		}
?>

<!doctype html>
<html lang = "en">

<head>
<title>Contact us</title>
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
            <li  class="active"><a href = "contact.php"><span class="glyphicon glyphicon-earphone"></span>  Contact us</a></li>
            <li><a href = "login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
            <li><a href = "signup.php"><span class="glyphicon glyphicon-user"></span>  Sign Up</a></li>
          </ul>
		</div>

	</div>	
</nav>
<!-- navigation bar ends-->


<div class = "container">
  <div class = "rows">
  <div class = "col-md-6 col-md-push-4">
  	<div class="panel panel-primary">

	  <div class = "panel-heading">
	  <h4 class = "panel-title">Contact us</h4>
	  </div>

	  <div class = "panel-body">
	    
	    <form role = "form" method = "post" action = "contact.php" name = "contactForm" id = "contactForm" onSubmit = "return validatePassword()">

	      <div class = "form-group" id = "c_e">
	        <label for = "email" class = "label-control">Email</label>
	        
	        <input name = "email" id = "email" type = "email" class = "form-control" placeholder = "Enter your email"/>
	        <span id="e_span" class="form-control-feedback glyphicon"></span>
	      </div>
	      
	      <div class = "form-group" id = "sub">
	        <label for = "subject" class = "label-control">Subject</label>
	        
	        <input name = "subject" id = "subject" type = "text" class = "form-control" placeholder = "Enter Subject"/>
	        <span id="sub_span" class="form-control-feedback glyphicon"></span>
	      </div>
	      
	      <div class = "form-group" id = "desc">
	        <label for = "description" class = "label-control">Message</label>
	        
	        <textarea name = "msg" id = "msg" class = "form-control" placeholder = "Write your message" rows = "7"></textarea>
	        <span id="msg_span" class="form-control-feedback glyphicon"></span>
	      </div>

	      
	      
	      <center><input type = "submit" name = "submitBtn" id = "submitBtn" class = "btn btn-info" value = "Send" /></center>
	      
	    </form>
	  </div>  
  </div>

  
  </div>
  <div class = "col-md-3 col-md-pull-5"> 
      <div class = "panel panel-primary">
      	<div class = "panel-heading">
      	<h4 class = "panel-title">Contact Address</h4>
      	</div>
      	<div class = "panel-body">
      		<b>skprajapati developers,</b><br/>
      		Swami Vivekanand Bhavan,<br/>
      		SVNIT,<br/>
      		Surat,<br/>
      		Gujarat,India.<br/>
      		PIN:395007.
      	</div>
      </div>
      <!--<footer class = "text-right"><a href = "https://www.facebook.com/shivang.prajapati.3" target="_blank">Facebook</a> | <a href = "https://twitter.com/shivang_skp/" target = "blank">Twitter</a> | <a href="https://plus.google.com/u/0/116598069836798527884" target = "blank">Google+</a></footer><br/><br/><br/>-->
      <center><a href = "https://www.facebook.com/shivang.prajapati.3" target = "blank"><img src = "images/facebook.png" height="50px" width="50px"/></a><a href = "https://twitter.com/shivang_skp/" target = "blank"><img src = "images/twitter.png" height="50px" width="50px"/></a><a href = "https://plus.google.com/u/0/116598069836798527884" target = "blank"><img src = "images/google.png" height="50px" width="50px"/></a></center>
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


  if(!validateText("email","c_e","e_span"))
  {
    return false;
  }
  
  if(!validateText("subject","sub","sub_span"))
  {
    return false;
  }
    

  if(!validateText("msg","desc","msg_span"))
  {
    return false;
  }

 
  return true;
}

 </script>

<!-- validation ends-->

</body>
</html>
