<?php
  include 'header.php';
  include 'left_sidebar.php';
?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
            <p>A free and modular admin template</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><i class="fa fa-home fa-lg"></i></li>
              <li><a href="#">Dashboard</a></li>
            </ul>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="">
              <div class="card">
                <h3 class="card-title">Edit Food Category</h3>

                <?php
                  if(isset($_GET['edit_id'])){
                    $cow_foodCat_id = $_GET['edit_id'];
                  }
                  $showCowFoodNameQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_id='".$cow_foodCat_id."'");
                  if(mysqli_num_rows($showCowFoodNameQry)<1){
                    echo "<script>location.href='index.php?page=food-category&catId=notFound';</script>";
                  }
                  $showCowFoodNameRow = mysqli_fetch_object($showCowFoodNameQry);
                ?>
                <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>">
                  <div class="card-body">
                      <div class="form-group">
                        <label class="control-label">Food Name</label>
                        <input class="form-control" type="text" name="food_category_name" placeholder="Enter Food Category" value="<?php echo($showCowFoodNameRow->cow_foodCat_name); ?>" required>
                        <input type="hidden" name="food_category_id" value="<?php echo($showCowFoodNameRow->cow_foodCat_id); ?>">
                      </div>
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary icon-btn" type="submit" name="edit_food_category_btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                  </div>
                </form>

              </div>
            </div>


          </div>
        </div>
      </div>
<?php include 'footer.php'; ?>