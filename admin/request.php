<?php

	require('connect.php');
	session_start();

	if(isset($_SESSION['loginemail']))
	{
		$admin = $_SESSION['loginemail'];
		$pwd = $_SESSION['loginpwd'];

		if($admin != "skprajapati.shivu@gmail.com" || $pwd != "iamadmin")
		{
			header("location:http://localhost/Blog/index.php");
		}

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			$sql = "SELECT * FROM contact_request WHERE request_id = '".$id."'";
			$result = mysqli_query($conn,$sql);

			if(!$result)
			{
				echo '<script language="javascript">';
			    echo 'alert("Problem Loading Requests.")';
			    echo '</script>';
			}
			else
			{	
				$request = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$email = $request['blogger_username'];
				$subject = $request['request_sub'];
				$message = $request['request_msg'];
				$date = $request['request_date'];
				$seen = $request['seen'];

			}
		}
		
		
		}	
?>

<!doctype html>
<html lang = "en">

<head>
<title>Request</title>
<meta charset = "UTF-8" />
<meta name = "viewport" content = "width=device-width, initial-scale=1.0" />

<link href = "http://localhost/Blog/css/bootstrap.min.css" rel = "stylesheet"/>
<link href = "http://localhost/Blog/css/style.css" rel = "stylesheet"/>


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
      	   <a href = "adminhome.php" class = "navbar-brand">MyBlog</a>
    	</div>

    	<!-- Collect the nav links, forms, and other content for toggling -->
    	<div class="collapse navbar-collapse" id="bs-myBlog-navbar-collapse-1">
      		

          <ul class = "nav navbar-nav navbar-right">
            <li><a href="adminhome.php"><span class="glyphicon glyphicon-home"></span>  Admin Home</a></li>
            <li><a href = "bloggers.php"><span class="glyphicon glyphicon-list"></span>  All Bloggers</a></li>
            <li class="active"><a href = "contacts.php"><span class="glyphicon glyphicon-inbox"></span>  Contact Requests</a></li>
            <li><a href = "http://localhost/Blog/logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
          </ul>
		</div>

	</div>	
</nav>
<!-- navigation bar ends-->

<div class = "container">
	<div class = "rows">
		<div class = "col-md-6 col-md-push-3">
			<p class = "h4">Request Detail</p>
			<hr>
			<div class = "well">
				<p class = "h4"><?php echo $subject; ?></p>
				<div style="clear: both;">
				<p class = "h4 alignleft"><small><span class = "glyphicon glyphicon-time">  </span><?php echo '  '.$date.'</small></p><p class = "h4 alignright"><small>'; echo '     <span class = "glyphicon glyphicon-user"></span>  '.$email; ?></small></p></div><br/><br/><br/>
				<p class = "text-justify"><?php echo $message; ?></p><br/>
				<form method = "post" action="seen.php?id=<?php echo $id; ?>">
				<center><button name = "seen" class = "<?php if($seen == 1) echo 'btn unblock_button'; else echo 'btn block_button'?>" value = "<?php echo $seen; ?>" id = "seen" type = "submit" ><?php if($seen == 1) echo 'Marked as seen'; else echo 'Mark as seen'; ?></button></center>
				</form>
			</div>
			
    		
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

mysqli_close($conn);
?>
