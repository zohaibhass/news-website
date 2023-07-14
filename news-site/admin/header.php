<?php
session_start();


if(!isset($_SESSION['username'])){
    $_SESSION['login_err']="Please Login First!";
    header("location:/news-site/admin");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">

    <link  rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-2">
                <?php

include "config.php";
$sql = "SELECT * FROM settings";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {

    if ($row['logo']=="") {

        echo '<a href="index.php"><h1>'.$row['websitename'].'</h1></a>';
       
    }else{

        echo '<a style="    width: 140px;
        padding-top: 10px;
    }" href="index.php" id="logo"><img src="'.$row['logo'].'"></a>';

    }

    

  }
}

?>

                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-offset-9  col-md-1">

                



                    <a href="logout.php" class="admin-logout">logout</a>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">








                        <li>
                            <a href="post.php">Post</a>
                        </li>
            
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>

                            <li>
                                <a href="setting.php">settings</a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
    