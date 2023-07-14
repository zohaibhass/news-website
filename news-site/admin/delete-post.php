<?php 

include "config.php";

$postid= $_GET['id'];

$sql="DELETE FROM post WHERE post_id={$postid}";

if(mysqli_query($conn,$sql)){

    header("location: {$hostname}/admin/post.php");
}else{
    echo "<p style='color:red; margin: 10px 0;'>can't delete</p>";
}

mysqli_close($conn);

?>
