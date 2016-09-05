<?php
require('connect.php');
session_start();

if(isset($_SESSION["loginemail"]))
{
  $email = $_SESSION["loginemail"];

  if(isset($_POST["oldpwd"]))
  {
      $date = date("Y-m-d");
      $newpass = $_POST["newpwd"];
      $sql = "UPDATE blogger_info SET blogger_password = '".$newpass."', blogger_updated_date = '".$date."' WHERE blogger_username = '".$email."'";
      $result = mysqli_query($conn,$sql);
      if(!$result)
      {
        echo '<script language="javascript">';
        echo 'alert("Some Problem Occured. Password not changed.")';
        echo '</script>';
        $loc = 0;
      }
      else
      {
        echo '<script language="javascript">';
        echo 'alert("Password changed succesfully.")';
        echo '</script>';
        $loc = 1;
      }

      if($loc)
        {
            header('location:userprofile.php');
        }
        else
        {
            header('location:changepwd.php');
        }
  }
  else
  {
  
    $sql = "SELECT * FROM blogger_info WHERE blogger_username = '".$email."'";

    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_array ($result,MYSQLI_ASSOC)) 
    {
      $dispname = $row['blogger_name'];
      $password = $row['blogger_password'];
    }
?>
<!doctype html>
<html lang = "en">

<head>
<title>Change Password</title>
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
            <li><a href = "userprofile.php"><span class="glyphicon glyphicon-user"></span> 
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
  <div class = "col-md-4">
  </div>

  <!-- Userdetail Start -->
  <div class = "col-md-4">
  
  <div class="panel panel-primary">

  <div class = "panel-heading">
  <h4 class = "panel-title">Change Password</h4>
  </div>

  <div class = "panel-body">
    
    <form role = "form" method = "post" action = "changepwd.php" name = "pwdForm" id = "pwdForm" onSubmit = "return validatePassword()">
      <div class = "form-group" id = "op">
        <label for = "oldpwd" class = "label-control">Current Password</label>
        
        <input name = "oldpwd" id = "oldpwd" type = "password" class = "form-control" placeholder = "Current Password"/>
        <span id="o_pwspan" class="form-control-feedback glyphicon"></span>
      </div>
      
      <div class = "form-group" id = "np">
        <label for = "newpwd" class = "label-control">New Password</label>
        
        <input name = "newpwd" id = "newpwd" type = "password" class = "form-control" placeholder = "New Password"/>
        <span id="n_pwspan" class="form-control-feedback glyphicon"></span>
      </div>

      <div class = "form-group" id = "cnp">
        <label for = "cnewpwd" class = "label-control">Confirm New Password</label>
        
        <input name = "cnewpwd" id = "cnewpwd" type = "password" class = "form-control" placeholder = "Re-enter New Password"/>
        <span id="cn_pwspan" class="form-control-feedback glyphicon"></span>
      </div>
      
      <center><input type = "submit" name = "submitBtn" id = "submitBtn" class = "btn btn-info" value = "Change" /></center>
      
    </form>
  </div>  
  </div>
  
  </div>
  <!-- user detail ends -->
  
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


  var op = document.getElementById("oldpwd");
  var np = document.getElementById("newpwd");
  var cnp = document.getElementById("cnewpwd");
  var div = document.getElementById("cnp");
  var span = document.getElementById("cn_pwspan");
  var divo = document.getElementById("op");
  var spano = document.getElementById("o_pwspan");
  var divn = document.getElementById("np");
  var spann = document.getElementById("n_pwspan");

  if(!validateText("oldpwd","op","o_pwspan"))
  {
    alert("All fields are required.");
    return false;
  }

  <?php
    echo 'if(op.value != '.$password.') {';
  ?>

    
  alert("Current Password entered is wrong.");
  divo.className = "form-group has-feedback has-error";
  spano.className = "form-control-feedback glyphicon glyphicon-remove";
    
  return false;
  }

  if(!validateText("newpwd","np","n_pwspan"))
  {
    alert("All fields are required.");
    return false;
  }

  if(np.value.length < 8 || np.value.length > 20)
  {
    alert("Password must be in the range of 8-20.");
    divn.className = "form-group has-feedback has-error";
    spann.className = "form-control-feedback glyphicon glyphicon-remove";
    return false;
  }



  if(!validateText("cnewpwd","cnp","cn_pwspan"))
  {
    alert("All fields are required.");
    return false;
  }
  

  
  if(cnp.value != np.value)
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

<!-- validation ends-->
</body>
</html>

<?php
  
  }
}

?>