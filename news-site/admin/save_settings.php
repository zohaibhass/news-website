<?php
include "config.php";

if(isset($_FILES['logo'] ['name'])){

    $file_name=$_POST['old_logo'];

}

    else{

    

  $errors= array();

  $file_name= $_FILES['logo'] ['name'];
  $file_size= $_FILES['logo'] ['size'];
  $file_tmp= $_FILES['logo'] ['tmp_name'];
  $file_type= $_FILES['logo'] ['type'];
  $file_exp=explode(".", $file_type);
  $file_ext= end($file_exp);
  $extensions= array("jepg","jpg","png");

  if(in_array($file_ext,$extensions) === false ){

      $errors[]="this format is not allowed please upload jepg,jpg or png image";
}

if( $file_size > "2097152"){
  $errors[]=" file size is large please upload size of file 2mb or below";
}
if(empty($errors) == 0) {
  move_uploaded_file( $file_tmp,"images/".$file_name);
}  
else{
  print_r($errors);

  die();
}


}

$website_name=mysqli_real_escape_string($conn,$_POST['websitename']);
$footer_desc=mysqli_real_escape_string($conn,$_POST['footerdesc']);
$sql="UPDATE settings SET websitename='{$_POST['website_name']}',logo='{$file_name}',footerdesc='{$_POST['footer_desc']}'";
if(mysqli_multi_query($conn,$sql)){

    header("location: {$hostname}/admin/setting.php");
}
else{
    echo "query failed";
} 


?>