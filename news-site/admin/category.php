<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">

                <?php

                include "config.php";

                $limit = 2;

                if (isset($_GET['page'])) {

                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $offset = ($page - 1) * $limit;

                $sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offset,$limit";

                $result = mysqli_query($conn, $sql) or die("query failed");

                if (mysqli_num_rows($result) > 0) {

                ?>


                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                                <tr>
                                    <td class='id'><?php echo $row['category_id'] ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['post'] ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>

                            <?php  }
                            ?>

                        </tbody>

                    </table>


                <?php  }




                include "config.php";

                $sql1 = "SELECT * FROM category";

                $result1 = mysqli_query($conn, $sql1) or die("failed");

                if (mysqli_num_rows($result1)) {



                    $total_records = mysqli_num_rows($result1);

                    $total_page = ceil($total_records / $limit);

                    echo "<ul class='pagination admin-pagination'>";

                    if ($page > 1) {

                        echo "<li><a href='category.php?page=".($page - 1)."'>previous</a></li>";
                    }



                    for($i= 1; $i<= $total_page; $i++) {

                        if($i == $page){
                            $active="active";
                        } else{
                            $active="";
                        }

                        echo "<li class=".$active."> <a href='category.php?page=".($i)."'>".($i)."</a></li>";
                    }

                    if($total_page > $page){

                        echo "<li><a href='category.php?page=".($page + 1)."'>next</a></li>";
    
                    }
                   
                }
                echo "</ul>";
                ?>


                <!-- <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li> -->

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>