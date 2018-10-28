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
            <div class="col-md-4">
              <div class="card">
                <h3 class="card-title">Add Food Category</h3>


                <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>">
                  <div class="card-body">
                      <div class="form-group">
                        <label class="control-label">Food Name</label>
                        <input class="form-control" type="text" name="food_category_name" placeholder="Enter Food Category" required>
                      </div>
                  </div>
                  <div class="card-footer">
                    <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary icon-btn" type="submit" name="add_food_category_btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                  </div>
                </form>

              </div>
            </div>

            <div class="col-md-8">
              
              <div class="card">
                <h3 class="card-title">All Food Category</h3>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Food Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      $serial = 0;
                      $showFoodCatQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_status='1' ORDER BY cow_foodCat_name");
                      while ($showFoodCatRow = mysqli_fetch_object($showFoodCatQry)) {
                    ?>

                    <tr>
                      <td><?php echo(++$serial); ?></td>

                      <td><?php echo($showFoodCatRow->cow_foodCat_name); ?></td>

                      <td>
                        <a href="<?php echo "index.php?page=food-category&edit_id=".$showFoodCatRow->cow_foodCat_id; ?>" class="btn btn-success btn-sm">Edit</a>

                        <form action="<?php echo htmlspecialchars($cur_page_link); ?>" method="post" style="display: inline;" onsubmit="return delConfirmFunction(this);">
                          <input type="hidden" name="cow_foodCat_del_id" value="<?php echo($showFoodCatRow->cow_foodCat_id); ?>">
                          <input type="submit" name="cow_foodCat_delete_btn" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                        
                      </td>
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        function delConfirmFunction(form){
          return confirm("do you want to delete??")
        }
      </script>
<?php include 'footer.php'; ?>