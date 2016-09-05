
<!doctype html>
<html lang = "en">

<head>
<title>Sign Up</title>
<meta charset = "UTF-8" />
<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />

<link href = "css/bootstrap.min.css" rel = "stylesheet"/>
<link href = "css/style.css" rel = "stylesheet"/>


</head>

<body>

<!-- start of navigation bar-->

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
	          <li><a href = "login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
	          <li class="active"><a href = "signup.php"><span class="glyphicon glyphicon-user"></span>  Sign Up</a></li>
          </ul>
		</div>

	</div>	
</nav>

<!-- End of navigation bar -->

<div class = "container">
<div class = "rows">
	<div class = "col-md-4">
	</div>

	<!-- Sign up Form Start -->
	<div class = "col-md-4">
	
		<div class="panel panel-primary">

		<div class = "panel-heading">
  			<h4 class = "panel-title">Sign Up</h4>
  		</div>

		<div class = "panel-body">
		
		<form role = "form" id = "signupForm" method = "post" action="insert.php" onSubmit = "return validatePassword()">
			<div class = "form-group" id="s_e">
				<label for = "signupEmail" class = "label-control">Email</label>
				
				<input id = "signupEmail" type = "email" class = "form-control" name = "semail" placeholder = "Enter Email here"/>
				<span id="e_span" class="form-control-feedback glyphicon"></span>
				
			</div>
			<div class = "form-group" id = "s_n">
				<label for = "signupName" class = "label-control">Name</label>
				
				<input id = "signupName" type = "text" class = "form-control" name = "sname" placeholder = "Enter name here"/>
				<span id="n_span" class="form-control-feedback glyphicon"></span>
			</div>
			<div class = "form-group" id = "s_p">
				<label for = "signupPassword" class = "label-control">Password</label>
				
				<input id = "signupPassword" type = "password" class = "form-control" name = "spwd" placeholder = "Enter Password"/>
				<span id="p_span" class="form-control-feedback glyphicon"></span>
			</div>
			<div class = "form-group" id = "s_cp">
				<label for = "signupConfirmPassword" class = "label-control">Confirm Password</label>
				
				<input id = "signupConfirmPassword" type = "password" class = "form-control" name = "scpwd" placeholder = "Re-enter Password"/>
				<span id="cp_span" class="form-control-feedback glyphicon"></span>
			</div>
			<center><button type = "submit" class = "btn btn-primary" id = "signupBtn">Sign Up</button></center>
		</form>
	</div>	
	</div>
	<center><p>Already registered ?</p></center>
  	<center><p><a href = "login.php">Click to Login</a></p></center>
	</div>
	<!-- Sign up form ends -->
	
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

<!-- validating form-->
<script type="text/javascript">

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


  
  var p = document.getElementById("signupPassword");
  var cp = document.getElementById("signupConfirmPassword");
  var div = document.getElementById("s_cp");
  var span = document.getElementById("cp_span");
  
  var divn = document.getElementById("s_p");
  var spann = document.getElementById("p_span");

  if(!validateText("signupEmail","s_e","e_span"))
  {
    alert("All fields are required.");
    return false;
  }

  

  if(!validateText("signupName","s_n","n_span"))
  {
    alert("All fields are required.");
    return false;
  }


  if(!validateText("signupPassword","s_p","p_span"))
  {
    alert("All fields are required.");
    return false;
  }


  if(p.value.length < 8 || p.value.length > 20)
  {
    alert("Password must be in the range of 8-20.");
    divn.className = "form-group has-feedback has-error";
    spann.className = "form-control-feedback glyphicon glyphicon-remove";
    return false;
  }



  if(!validateText("signupConfirmPassword","s_cp","cp_span"))
  {
    alert("All fields are required.");
    return false;
  }
  

  
  if(cp.value != p.value)
  {
    alert("Password must match");
    div.className = "form-group has-feedback has-error";
    span.className = "form-control-feedback glyphicon glyphicon-remove";
    return false;
  }
  
  div.className = "form-group has-feedback has-success";
  span.className = "form-control-feedback glyphicon glyphicon-ok";
  return true;
}

</script>
<!--validation ends-->

</body>


</html>