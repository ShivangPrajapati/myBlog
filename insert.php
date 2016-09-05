<?php

if(isset($_POST['semail']))
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "blog";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conn) 
	{
	    die("Connection failed: " . mysqli_connect_error());
	}

    $temp = 0;
	$name = $_POST['sname'];
	$email = $_POST['semail'];
	$password = $_POST['spwd'];
	$start_date = date("Y-m-d");
	$end_date = date('Y-m-d', strtotime('+5 years'));
	$one = 1;

	

	$sql_t = "SELECT * FROM blogger_info";
    $user = mysqli_query($conn,$sql_t);

	while($row = mysqli_fetch_array ($user,MYSQLI_ASSOC)) 
    {
      if($email == $row["blogger_username"])
      {
        $temp = 1;
        break;
      }
    }

    if($temp == 1)
    {
    	echo "<script language=\"javascript\">";
    	echo "alert(\"Username already exists.\")";
    	echo "</script>";
    	header('Location:signup.php');
    }
    else
    {
    	$sql = "INSERT INTO blogger_info (blogger_username, blogger_password, blogger_name, blogger_creation_date, blogger_is_active, blogger_end_date) VALUES ('".$email."', '".$password."' , '".$name."' , '".$start_date."', '".$one."', '".$end_date."')"; 


		$result = mysqli_query($conn, $sql);
		
    	if(!$result)
    	{
    		echo "<script language=\"javascript\">";
    		echo "alert(\"Record not inserted.\")";
    		echo "</script>";	
    		header('refresh:2; url=signup.php');
    	}
    	else
    	{
    		echo "<script language=\"javascript\">";
    		echo "alert(\"Successfully registered.\")";
    		echo "</script>";
            header('refresh:2; url=login.php');
    	}

            }

	mysqli_close($conn);
}

?>
<html>
</html>