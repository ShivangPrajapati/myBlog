<?php
require('connect.php');
session_start();


if(isset($_SESSION["loginemail"]))
{
  $email = $_SESSION["loginemail"];
  
  if(isset($_GET["bid"]) && isset($_POST["title"]))
  {
      echo "I am";
      $id = $_GET["bid"];
      $title = $_POST['title'];
      $category = $_POST['category'];
      $description = $_POST['content'];
      $update_date = date("Y-m-d");

      $query = "UPDATE blog_master SET blog_title = '".$title."', blog_category = '".$category."', blog_desc = '".$description."', updated_date = '".$update_date."' WHERE blog_id = '".$id."'";
      $resulta = mysqli_query($conn,$query);

      if(!$resulta)
      {
        echo '<script type = "text/javascript">';
        echo 'alert("Some Problem Occured.Blog not updated.")';
        echo '</script>'; 
        $loc = 0;
      }
      else
      {
        echo '<script type = "text/javascript">';
        echo 'alert("Blog successfully updated")';
        echo '</script>'; 
        $loc = 1;
      }

      if($loc)
      {
        header('location:userhome.php');
      }
      else
      {
        header('location:updateblog.php?bid='.$id);
      }

      
  }
  
  if(isset($_GET["bid"]))
  {   

      $id = $_GET["bid"];

      $query = "SELECT * FROM blog_master WHERE blog_id = '".$id."'";

      $resulta = mysqli_query($conn,$query);

      $blog = mysqli_fetch_array ($resulta,MYSQLI_ASSOC);

      $title = $blog['blog_title'];
      $category = $blog['blog_category'];
      $description= $blog['blog_desc'];
  }
    
  
  

  
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
      echo 'alert("You are not active now.")';
      echo '</script>';
      header("Location:userhome.php");
    }
    else
    {

?>

<!doctype html>
<html lang = "en">

<head>
<title>Update Blog</title>
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
    <?php
    echo '<form role = "form" id = "updateblog" method = "post" action = "updateblog.php?bid='.$id.'">
      <div class = "form-group">
      
        <label for = "title" class = "label-control">Title</label>
        
        <input id = "title" type = "text" class = "form-control" name = "title" placeholder = "Blog Title" value = "'.$title.'"/>
        
      </div>
      <div class = "form-group">
        <label for = "category" class = "label-control">Category</label>
        
        <input id = "category" type = "text" class = "form-control" name = "category" placeholder = "Type Category" value = "'.$category.'"/>
        
      </div>
      <div class = "form-group">
        <label for = "content" class = "label-control">Content</label>
        
        <textarea id = "content" class = "form-control" name = "content" placeholder = "Start writing your blog here..." rows = "5">'.$description.'</textarea>
        
      </div>
      <center><button type = "button" class = "btn btn-primary" id = "addBlogbtn">Update</button></center>';
      ?>
      
    </form>
  </div>  
  </div>
  </div>
  <div class = "col-md-2 col-md-pull-6"> 
    <h4>Quick Access</h4>
    <ul>
      <li><a href = "addblog.php">Add Blog</a></li>
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
<script>

function validateText(id)
{
  if( $("#"+id).val() == null || $("#"+id).val() == "" )
  {
    var div = $("#"+id).closest("div");
    div.removeClass("has-success");
    div.addClass("has-error has-feedback");
    div.append('<span id = "glypcn'+id+'" class = "glyphicon glyphicon-remove form-control-feedback"></span>');
    return false;
  }
  else
  {
    var div = $("#"+id).closest("div");
    div.removeClass("has-error");
    div.addClass("has-success has-feedback");
    $("#glypcn"+id).remove();
    div.append('<span id = "glypcn'+id+'" class = "glyphicon glyphicon-ok form-control-feedback"></span>');
    return true;  
  }
}

$(document).ready(

  function()
  {
    $("#addBlogbtn").click(function()
    {
      if(!validateText("title"))
      {
        return false;
      }
      
      if(!validateText("category"))
      {
        return false;
      }

      if(!validateText("content"))
      {
        return false;
      }
      

      $("form#updateblog").submit();
    });
  }

  );
</script>
<!-- validation ends-->
</body>
</html>

<?php

  }
}

?>