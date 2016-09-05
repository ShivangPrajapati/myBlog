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

		if(isset($_POST['seen']) && $_GET['id'])
		{	
			$id = $_GET['id'];
			
			$seen = $_POST['seen'];

			if($seen)
			{
				echo '<script language = "javascript">';
				echo 'alert("You cannot mark it as unread");';
				echo '</script>';
				header('refresh:3; url=request.php?id='.$id);
			}
			else
			{
				$n_seen = 1;
				$sql = "UPDATE contact_request SET seen = '".$n_seen."'";
				$result = mysqli_query($conn,$sql);
			}

				

			mysqli_close($conn);

			header('location:request.php?id='.$id);


		}
	}
?>