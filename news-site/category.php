<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">


                    <?php
                    include "config.php";

                    $catid = $_GET['cid'];

                    $sql2 = "SELECT * FROM category WHERE category_id='{$catid}'";

                    $result2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result2) > 0) {

                        while ($row2 = mysqli_fetch_assoc($result2)) {

                    ?>


                            <h2 class="page-heading"><?php echo $row2['category_name'] ?> </h2>

                    <?php  }
                    } ?>

                    <?php


                    if (isset($_GET["cid"])) {

                        $catid = $_GET["cid"];
                    }

                    include "config.php";

                    if (isset($_GET['page'])) {

                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    $limit = 2;

                    $offset = ($page - 1) * $limit;

                    $sql = "SELECT post.post_id,title,description,post_date,post_img,category_name,category.category_id,user.username,post.author FROM post
                   LEFT JOIN user ON post.author =user.user_id LEFT JOIN category ON post.category=category.category_id WHERE post.category='{$catid}' LIMIT $offset,$limit";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <div class="post-content">
                                <div class="row">

                                    <div class="col-md-4">

                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>"><img src="/news-site/admin/upload/<?php echo  trim($row['post_img']); ?>" alt="" /> </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <span>
                                                <p class="description">
                                                    <?php echo substr($row['description'], 0, 80) . "...." ?>
                                                </p>
                                            </span>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php }
                    }

                    include "config.php";

                    $sql1 = "SELECT post FROM category WHERE category_id='{$catid}'";

                    $result1 = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result1)) {


                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);

                        echo "<ul class='pagination'>";

                        if ($page > 1) {

                            echo "<li><a href='category.php?cid={$catid}&page=" . ($page - 1) . "'>prev</a></li>";
                        }

                        for ($i = 1; $i <= $total_records; $i++) {

                            if ($i == $page) {

                                $active = "active";
                            } else {
                                $active = "";
                            }

                            echo "<li  class='$active'><a href='category.php?cid={$catid}&page={$i}'>{$i}</a></li>";
                        }

                        if ($total_page >= $page) {

                            echo "<li><a href='category.php?cid={$catid}&page=" . ($page + 1) . "'>next</a></li>";
                        }

                        echo "</ul>";
                    }

                    ?>


                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>