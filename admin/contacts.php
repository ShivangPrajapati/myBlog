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
		
		$sql = "SELECT * FROM contact_request ORDER BY request_id DESC";
		$result = mysqli_query($conn,$sql);

		if(!$result)
		{
			echo '<script language="javascript">';
		    echo 'alert("Problem Loading Requests.")';
		    echo '</script>';
		}
		else
		{

			$row_cnt = mysqli_num_rows($result);
			if(!$row_cnt)
			{
				echo '<script language="javascript">';
			    echo 'alert("No requests were found.")';
			    echo '</script>';
			}
?>

<!doctype html>
<html lang = "en">

<head>
<title>Contact Requests</title>
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
		<div class = "col-md-5 col-md-push-3">
			<div class="panel panel-default table-responsive">
  			<!-- Default panel contents -->
  				<div class="panel-heading">Contact Requests</div>

  				<!-- Table -->
  				<table class="table table-hover">
    				<tr>
    					<th>Id</th>
    					<th>Email Id</th>
    					<th></th>
    				</tr>

    				<?php

    					while($request = mysqli_fetch_array($result,MYSQLI_ASSOC))
    					{
    						$id = $request['request_id'];
							$email = $request['blogger_username'];
							

							echo '<tr>';
								echo '<td>'.$id.'</td>';
								echo '<td>'.$email.'</td>';
								echo '<td><a href = "request.php?id='.$id.'"><span class = "glyphicon glyphicon-open"></span> Detail</a></td>';
							echo '</tr>';

    					}
    				?>
  				</table>

			</div>
			<br/><br/><br/>
		</div>
		<div class = "col-md-2 col-md-pull-4">
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
}
?>