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
            <div class="card">
              <h3 class="card-title">Add New Food</h3>


              <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">Food Name</label>
                      <select class="form-control" name="cow_foodsCat_id" required>
                        <option></option>
                        <?php
                          $showFoodCatQry = $conn->query("SELECT * FROM or_cow_food_category");
                          if(mysqli_num_rows($showFoodCatQry)>0){
                            while($showFoodCatRow = mysqli_fetch_object($showFoodCatQry)){
                        ?>
                        <option value="<?php echo $showFoodCatRow->cow_foodCat_id; ?>"><?php echo $showFoodCatRow->cow_foodCat_name; ?></option>
                        <?php
                            }
                          }
                          else{
                            echo "<option>No Cattle Breed Found. Please add cattle breed first</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Food Quantity (k.g)</label>
                      <input class="form-control" type="text" name="cow_Foods_quantity" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Food Cost (in bd tk)</label>
                      <input class="form-control" type="text" name="cow_foods_cost" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Food Description (optional)</label>
                      <textarea class="form-control" rows="4" name="cow_foods_description" placeholder="Enter Food description"></textarea>
                    </div>

                </div>
                <div class="card-footer">
                  <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-primary icon-btn" type="submit" name="add_cow_foods_btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                </div>
              </form>


            </div>
          </div>
          
        </div>
      </div>
<?php include 'footer.php'; ?>