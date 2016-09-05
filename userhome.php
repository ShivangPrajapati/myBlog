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
    }

    $query = "SELECT * FROM blog_master WHERE blog_author = '".$dispname."' ORDER BY blog_id DESC";
    $userblogs = mysqli_query($conn,$query);

?>

<!doctype html>
<html lang = "en">

<head>
<title><?php echo $dispname?></title>
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
            <li class = "active"><a href="userhome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href = "contactus.php"><span class="glyphicon glyphicon-earphone"></span>  Contact</a></li>
            <li><a href = "logout.php"><span class="glyphicon glyphicon-log-out"></span>  Log out</a></li>
          </ul>
		</div>

	</div>	
</nav>
<!-- navigation bar ends-->

<div class = "container">
  <div class = "rows">
  <div class = "col-md-8 col-md-push-2">
  <p class = "h3">All Blogs</p>
      <hr>
      <p class = "h3"><small>
  <?php
      $row_cnt = mysqli_num_rows($userblogs);
          if($row_cnt == 0)
          {
          echo 'No blogs by you.';

          }
          echo '</small></p>';
      while($blog = mysqli_fetch_array($userblogs,MYSQLI_ASSOC))
      { 
        $id = $blog['blog_id'];
        $title = $blog['blog_title'];
        $category = $blog['blog_category'];
        $description = $blog['blog_desc'];
        $date = $blog['creation_date'];

        $query = "SELECT * FROM blog_detail WHERE blog_id = '$id'";
        $image_result = mysqli_query($conn, $query);
        $image_row = mysqli_fetch_array($image_result, MYSQLI_ASSOC);
        $image = $image_row['img_name'];
        $path = $image_row['img_path'];

        echo '<div class = "well">';
        echo '<p class = "h4">'.$title.'</p>';
        echo '<div>';
          echo '<img src = "'.$path.$image.'" class = "img-responsive" width = "100%" />';
        echo '</div>';
        echo '<p class = "h4"><small><span class="glyphicon glyphicon-tag"></span>  '.$category.'&nbsp&nbsp<span class="glyphicon glyphicon-time"></span>  '.$date.'</small></p>';
      
        echo '<p class = "text-justify">'.$description.'</p>';
        echo '<footer class = "text-right h4"><small><a href = "updateblog.php?bid='.$id.'"><span class = "glyphicon glyphicon-edit"></span>  Edit</a> | <a href = "removeblog.php?id='.$id.'"> <span class = "glyphicon glyphicon-remove has-error"></span>  Remove</a></small></footer>';
        echo '</div>';
        echo '<br/><br/>';
    }
    echo '<br/>';
    echo '</div>';
    ?>
    <div class = "col-md-2 col-md-pull-8"> 
      <h4>Quick Access</h4>
      <ul>
      <li><a href = "addblog.php">Add Blog</a></li>
      <li><a href = "contactus.php">Contact us</a></li>
      </ul>
    </div>
    <br/><br/><br/>
    
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