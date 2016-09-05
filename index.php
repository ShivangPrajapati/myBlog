<?php
require('connect.php');




$sql = "SELECT * FROM blog_master WHERE blog_is_active = '1' ORDER BY blog_id DESC";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    echo '<script language="javascript">';
    echo 'alert("Problem Loading Blogs")';
    echo '</script>';
}
else
{
  
  

?>


<!doctype html>
<html lang = "en">

<head>
<title>myBlog - Home</title>
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
            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href = "contact.php"><span class="glyphicon glyphicon-earphone"></span>  Contact us</a></li>
            <li><a href = "login.php"><span class="glyphicon glyphicon-log-in"></span>  Login</a></li>
            <li><a href = "signup.php"><span class="glyphicon glyphicon-user"></span>  Sign Up</a></li>
          </ul>
		</div>

	</div>	
</nav>
<!-- navigation bar ends-->

<div class = "container">
  <div class = "rows">
  <div class = "col-md-10 col-md-push-1 margin">
      <p class = "h3">All Blogs</p>
      <hr>
      <p class = "h3"><small>
        <?php
          $row_cnt = mysqli_num_rows($result);
          if($row_cnt == 0)
          {
            echo 'No blogs are published yet.';
          }
          else
          {
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {
              $id1 = $row['blog_id'];
              $id = $row['blogger_id'];
              $title = $row['blog_title'];
              $category = $row['blog_category'];
              $description = $row['blog_desc'];
              $author = $row['blog_author']; 
              $date = $row['creation_date'];

              $query = "SELECT * FROM blog_detail WHERE blog_id = '$id1'";
              $image_result = mysqli_query($conn, $query);
              $image_row = mysqli_fetch_array($image_result, MYSQLI_ASSOC);
              $image = $image_row['img_name'];
              $path = $image_row['img_path'];
              
        
      echo '</small></p>';
      echo '<div class = "well">';
      echo '<p class = "h4">';
      echo $title;
      echo '</p><br/>';
      echo '<div>';
        echo '<img src = "'.$path.$image.'" class = "img-responsive" width = "100%" />';
      echo '</div>';
      echo '<p class = "h4">';
        
          
        
         echo '<br/><small><span class="glyphicon glyphicon-tag"></span>  '.$category.'&nbsp&nbsp<span class="glyphicon glyphicon-time"></span>  '.$date.'</small></p>';
      
        echo '<p class = "text-justify">'.$description.'</p>';
        echo '<footer class = "text-right h4"><small> - by <a href = "profile.php?id='.$id.'">'.$author.'</a></small></footer>';
        echo '</div>';
        echo '<br/><br/>';
        }
        echo '<br/>';
        echo '</div>';
          
      
    ?>
    <div class = "col-md-1 col-md-pull-10"> 
      
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
      mysqli_close($conn);
    }
  }
?>
