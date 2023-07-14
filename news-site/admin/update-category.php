<?php
if(isset($_POST['sumbit'])){

  include "config.php";

  $cid=mysqli_real_escape_string($conn,$_POST['cat_id']);
  $cname= mysqli_real_escape_string($conn,$_POST['cat_name']);
  $sql="UPDATE category SET category_name='{$cname}' WHERE category_id={$cid}";

  if(mysqli_query($conn,$sql)){

    header("location: {$hostname}/admin/category.php");
  }

}

?>

<?php include "header.php";?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="adin-heading"> Update Category</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">

      <?php
      
      include "config.php";

      $catid= $_GET['id'];

      $sql="SELECT * FROM category WHERE category_id='{$catid}'";

      $result=mysqli_query($conn,$sql) or die("query failed");

      if(mysqli_num_rows($result)){

        while ($row=mysqli_fetch_assoc($result)) {

      ?>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
              <div class="form-group">
                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
              </div>
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
              </div>
              <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
            </form>

            <?php }
           } ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>