<?php
	
	require('connect.php');

	session_start();

	if(isset($_SESSION['loginemail']))
	{
		$admin = $_SESSION['loginemail'];
		$pwd = $_SESSION['loginpwd'];
		if($admin != "skprajapati.shivu@gmail.com" && $pwd != "iamadmin")
		{
			header("location:http://localhost/Blog/index.php");
		}
		
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];

			$sql = "DELETE FROM blog_master WHERE blog_id = '".$id."'";
			$result = mysqli_query($conn,$sql);

			$sql = "DELETE FROM blog_detail WHERE blog_id = '".$id."'";
			$result = mysqli_query($conn,$sql);

			if(!$result)
			{
				echo '<script language = "javascript">';
				echo 'alert("Blog not deleted . Please try again later.");';
				echo '</script>';
			}
			else
			{
				echo '<script language = "javascript">';
				echo 'alert("Blog successfully deleted.");';
				echo '</script>';
			}
			
			header('refresh:2; url=adminhome.php');
			

		}
	}
	else
	{
		header("refresh:3; url=http://localhost/Blog/login.php");
	}
	mysqli_close($conn);
?>