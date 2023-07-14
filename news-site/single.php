<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">

                    <?php

                    include "config.php";

                    $post_id = $_GET['id'];
                    $sql = "SELECT post.post_id,post.title,post.description,post.post_date,post.post_img,category.category_id,category.category_name,role,user.user_id,user.username,post.author FROM post
                    LEFT JOIN user ON post.author =user.user_id LEFT JOIN category ON post.category=category.category_id WHERE post.post_id='{$post_id}'";

                    $result = mysqli_query($conn, $sql)  or die("query failed");

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>


                            <div class="post-content single-post" style="word-wrap:break-word">
                                <h3> <a href="single.php?id=<?php echo $row['post_id'] ?>"> <?php echo $row['title'] ?>  </a></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <a href="single.php?cid=<?php echo $row['category_id'] ?>"> <?php echo $row['category_name'] ?> </a> </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'] ?>
                                            </span>
                                </div>
                                <a class="single-feature-image" href="single.php"><img src="/news-site/admin/upload/<?php echo  trim($row['post_img']); ?>" alt="" /></a>
                                <span>
                                    <p class="description">

                                        <?php echo $row['description'] ?>

                                    </p>
                                </span>
                            </div>

                    <?php }
                    } ?>
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>