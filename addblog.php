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
      $status = $row['blogger_is_active'];     
    }

    if(!$status)
    {
      echo '<script language="javascript">';
      echo 'alert("You are not allowed to insert the blog")';
      echo '</script>';
      header("Location:userhome.php");
    }
    else
    {

?>

<!doctype html>
<html lang = "en">

<head>
<title>Add Blog</title>
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
  <div class = "col-md-6 col-md-push-3">
      <div class="panel panel-primary">

    <div class = "panel-heading">
        <h4 class = "panel-title">Add Blog</h4>
      </div>

    <div class = "panel-body">
    
    <form role = "form" id = "addblog" method = "post" action="insertblog.php" enctype="multipart/form-data" onSubmit = "return validatePassword()">
      <div class = "form-group" id = "b_t">
        <label for = "title" class = "label-control">Title</label>
        
        <input id = "title" type = "text" class = "form-control" name = "title" placeholder = "Blog Title"/>
        <span id="t_span" class="form-control-feedback glyphicon"></span>
      </div>
      <div class = "form-group" id = "b_c">
        <label for = "category" class = "label-control">Category</label>
        
        <input id = "category" type = "text" class = "form-control" name = "category" placeholder = "Type Category"/>
        <span id="c_span" class="form-control-feedback glyphicon"></span>
      </div>
      <div class = "form-group" id = "b_i">
        <label for = "image" class = "label-control">Upload Image</label>
        
        <input id = "image" type = "file" class = "form-control" name = "image" />
        <span id="i_span" class="form-control-feedback glyphicon"></span>
      </div>
      <div class = "form-group" id = "b_d">
        <label for = "content" class = "label-control">Content</label>
        
        <textarea id = "content" class = "form-control" name = "content" placeholder = "Start writing your blog here..." rows = "7"></textarea>
        <span id="d_span" class="form-control-feedback glyphicon"></span>
      </div>
      
      <center><button type = "submit" class = "btn btn-primary" id = "addBlogbtn">Add blog</button></center>
    </form>
  </div>  
  </div>
  <br/><br/><br/>
  </div>
  <div class = "col-md-2 col-md-pull-6"> 
    <h4>Quick Access</h4>
    <ul>
      <li><a href = "#">Add Blog</a></li>
      <li><a href = "contactus.php">Contact us</a></li>
    </ul>
  </div>
  <br/><br/><br/><br/>
    
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

  var img = document.getElementById("image");
  var div = document.getElementById("b_i");
  var span = document.getElementById("i_span");

  if(!validateText("title","b_t","t_span"))
  {
    alert("All fields are required.");
    return false;
  }

  if(!validateText("category","b_c","c_span"))
  {
    alert("All fields are required.");
    return false;
  }

  if(!validateText("image","b_i","i_span"))
  {
    alert("Please upload image.");
    return false;
  }

  if(!/(\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(img.value)) {
        alert("Invalid image file type.");      
        div.className = "form-group has-feedback has-error";
        span.className = "form-control-feedback glyphicon glyphicon-remove";      
        return false;   
    }  

  if(!validateText("content","b_d","d_span"))
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

<?php

  }
}

?>