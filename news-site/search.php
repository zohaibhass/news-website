<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php

                    include "config.php";
                    if (isset($_GET['search'])) {
                        $search_term = $_GET['search'];
                    }

                    ?>
                    <h2 class="page-heading"> Search result:<?php echo $search_term  ?> </h2>;


                    <?php

                    include "config.php";

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }else{
                        $page=1;
                    }
                    $limit=2;
                    $offset=($page-1)*$limit;

                    $sql = "SELECT post.post_id,title,description,post_img,post_date,username,category_name,category.category_id,post.author FROM post LEFT JOIN user ON post.author=user.username
                   LEFT JOIN category ON post.category=category.category_id WHERE post.title LIKE '%{$search_term}%' OR post.description LIKE '%{$search_term}%' ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                    $result = mysqli_query($conn,$sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php"><img src="/news-site/admin/upload/<?php echo  trim($row['post_img']); ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo  $row['post_id'] ?>'><?php echo  $row['title'] ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo  $row['category_id'] ?>'><?php echo  $row['category_name'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo  $row['username'] ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo  $row['post_date'] ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo  substr($row['description'],0,40)."..." ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.phpid=<?php echo  $row['post_id'] ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }else {
                        echo "<h1> record not found</h1>";
                    }

                    include "config.php";
                    $sql1 = "SELECT title,description,post_img,post_date,username,category_name FROM post LEFT JOIN user ON post.author=user.username
                    LEFT JOIN category ON post.category=category.category_id WHERE post.title LIKE '%{$search_term}%'";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {

                        $limit = 2;
                        $total_records = mysqli_num_rows($result1);

                        $total_page = ceil($total_records / $limit);

                        echo "<ul class='pagination'>";

                        if ($page > 1) {

                            echo "<li><a href='search.php?search= $search_term & page=" . ($page - 1) . "'>prev</a></li>";
                        }


                        for ($i = 1; $i <= $total_page; $i++) {

                            if ($i == $page) {

                                $active = "active";
                            } else {
                                $active = "";
                            }

                            echo "<li class='$active' ><a href='search.php?search= $search_term. & page={$i}'>{$i}</a></li>";
                        }
                        if ($total_page > $page) {

                            echo "<li><a href='search.php?search= $search_term & page=" . ($page + 1) . "'>next</a></li>";
                        }
                        echo "</ul>";
                    }
                    ?>

                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>