
<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">settings</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <!-- Form -->

        <?php

        include "config.php";
        $sql = "SELECT * FROM settings";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

        ?>



            <form action="save_settings.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="website_name">website_name</label>
                <input type="text" name="website_name" class="form-control" autocomplete="off" value="<?php echo $row['websitename'] ?>" required>
              </div>

              <div class="form-group">
                <label for="logo">logo</label>
                <input type="file" name="logo">
                <img src="<?php echo trim($row['logo'])?>">
                <input type="hidden" name="old_logo" value="<?php echo trim($row['logo'])?>">
              </div>

              <div class="form-group">
                <label for="footer_description"> footer_Description</label>
                <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $row['footerdesc'] ?></textarea>
              </div>
              <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
            </form>

        <?php }
        }
        ?>
        <!--/Form -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>