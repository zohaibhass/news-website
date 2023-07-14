<?php 

include "config.php";

$catid= $_GET['id'];

$sql="DELETE FROM category WHERE category_id={$catid} ";

if(mysqli_query($conn,$sql)){

    header("location: {$hostname}/admin/category.php");

}
else{
    echo "<div> cant delete</div>";
}




?>