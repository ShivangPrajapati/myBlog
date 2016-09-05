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

		if(isset($_GET['status']) && isset($_GET['id']))
		{
			$id = $_GET['id'];
			$status = $_GET['status'];

			if($status)
			{
				$n_status = 0;
			}
			else
			{
				$n_status = 1;
			}

			$sql = "UPDATE blogger_info SET blogger_is_active = '".$n_status."' WHERE blogger_id = '".$id."'";
			$result = mysqli_query($conn,$sql);

			$sql = "UPDATE blog_master SET blog_is_active = '".$n_status."' WHERE blogger_id = '".$id."'";
			$result = mysqli_query($conn,$sql);	

			mysqli_close($conn);

			header('location:bloggers.php');


		}
	}
?>