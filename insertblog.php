<?php
	
require('connect.php');


session_start();

if(isset($_SESSION["loginemail"]))
{

  $email = $_SESSION["loginemail"];	
  $sql = "SELECT * FROM blogger_info WHERE blogger_username = '".$email."'";

  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_array ($result,MYSQLI_ASSOC);
    
  $name = $row['blogger_name'];
  $id = $row['blogger_id'];

  $date = date("Y-m-d");
  $one = 1;
  $title = $_POST["title"];
  $category = $_POST["category"];
  $description = $_POST["content"];
  $file="images/".$_FILES["image"]["name"];
  $temp_name = $_FILES['image']['tmp_name'];
  move_uploaded_file($temp_name, $file);
  $img_name = addslashes($_FILES['image']['name']);
  /*$image = addslashes($_FILES['image']['tmp_name']);
  $image = file_get_contents($image);
  $image = base64_encode($image);
  

  echo $email;
  echo $title;
  echo $name;
  echo $id;
  echo $category;
  echo $description;*/

  

  $query = "INSERT INTO blog_master (blogger_id, blog_title, blog_category, blog_desc, blog_author, blog_is_active, creation_date) VALUES ('$id', '$title', '$category', '$description', '$name', '$one', '$date')";

  $resulta = mysqli_query($conn, $query);
  $last_id = mysqli_insert_id($conn);
  echo $last_id;
    
  $query = "INSERT INTO blog_detail (blog_id, img_name, img_path) VALUES ('$last_id', '$img_name', 'images/')";
  $result = mysqli_query($conn, $query);

  if(!$result || !$resulta)
  {
    if(!$result && !$resulta)
    {
      echo '<script language="javascript">';
      echo 'alert("Some Problem Occured.Blog not inserted.")';
      echo '</script>'; 
      header('refresh:2; url=addblog.php');
    }
    else if(!$result)
    {
      $sql = "DELETE FROM blog_master WHERE blog_id = '$last_id'";
      $resultb = mysqli_query($conn, $sql);
      echo '<script language="javascript">';
      echo 'alert("Problem uploading image.Blog not added.")';
      echo '</script>';
      header('refresh:2; url=addblog.php');
    }
    else
    {
      $sql = "DELETE FROM blog_detail WHERE blog_id = '$last_id'";
      $resultb = mysqli_query($conn, $sql);
      echo '<script language="javascript">';
      echo 'alert("Problem occured.Blog not added.")';
      echo '</script>';
      header('refresh:2; url=addblog.php');
    }

	}
  else
  {

      echo '<script language="javascript">';
      echo 'alert("Blog successfully inserted")';
      echo '</script>'; 
      header('refresh:1; url=userhome.php');
    /*$last_id = mysqli_insert_id($conn);
    echo $last_id;
    
    $query = "INSERT INTO blog_detail (blog_id, img_name, blog_detail_image) VALUES ('$last_id', '{$img_name}', '{$image}')";
    $result = mysqli_query($conn, $query);
    if(!$result)
    {
      echo '<script language="javascript">';
      echo 'alert("Image was not uploaded.")';
      echo '</script>'; 
      
    }
    else
    {*/
      
      
    //}

   	
  }

   

}

?>