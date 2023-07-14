<?php include "header.php";

if(isset($_POST['submit'])) {

include "config.php";

$id = mysqli_real_escape_string($conn, $_POST['post_id']);
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);


$sql1 = "UPDATE post SET post_id={$id}, title='{$title}', description='{$desc}',category='{$category}' WHERE post_id='{$id}' ";



if (mysqli_query($conn, $sql1) > 0) {
    header("location: {$hostname}/admin/post.php");
}
}



?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->

                <?php

                include "config.php";

                $post_id = $_GET['id'];

                $sql = "SELECT post.title,post.description,post.post_img,post.category FROM post WHERE post_id='{$post_id}'";

                $result = mysqli_query($conn,$sql);

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                ?>


                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5"><?php echo $row['description'] ?></textarea>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputCategory">category</label>
                                <select class="form-control" name="category" value="">

                                    <option value="" disabled> Select Category</option>


                                    <?php

                                    include "config.php";

                                    $sql2 = "SELECT * FROM category";
                                    $result2 = mysqli_query($conn, $sql2);

                                    if (mysqli_num_rows($result2) > 0) {

                                        while ($row2 = mysqli_fetch_assoc($result2)) {



                                            echo " <option value='{$row2['category_id']}'> {$row2['category_name']} </option> ";
                                        }
                                    }

                                    ?>
                                    </option>

                            </div>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="file" name="new-image">
                                <img src="upload/<?php echo $row['post_img']; ?>" height="150px">
                                <!-- <input type="hidden" name="old-image" value=""> -->
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                        <!-- Form End -->
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>