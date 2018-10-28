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
              <h3 class="card-title">Add New Cow</h3>


              <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">Cattle breed</label>
                      <select class="form-control" name="cattle_breed" required>
                        <option></option>
                        <?php
                          $showCattleBreedQry = $conn->query("SELECT * FROM or_cattle_breed");
                          if(mysqli_num_rows($showCattleBreedQry)>0){
                            while($showCattleBreedRow = mysqli_fetch_array($showCattleBreedQry)){
                        ?>
                        <option value="<?php echo $showCattleBreedRow['cattle_breed_id']; ?>"><?php echo $showCattleBreedRow['cattle_breed_name']; ?></option>
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
                      <label class="control-label">Cow Name</label>
                      <input class="form-control" type="text" name="cow_name" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Cow Image 1</label>
                      <input class="form-control" type="file" name="cow_image1" accept="image/*">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Cow Image 2</label>
                      <input class="form-control" type="file" name="cow_image2" accept="image/*">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Cow From</label>
                      <select class="form-control" name="cow_from" required>
                        <option></option>
                        <option value="1">Previous Cow</option>
                        <option value="2">Buy</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Cows cost (in bd tk)</label>
                      <input class="form-control" type="text" name="cow_cost" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Fare Cost (in bd tk)</label>
                      <input class="form-control" type="text" name="fare_cost" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Cow Description</label>
                      <textarea class="form-control" rows="4" name="cow_description" placeholder="Enter Cow description"></textarea>
                    </div>

                </div>
                <div class="card-footer">
                  <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-primary icon-btn" type="submit" name="add_new_cow_btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                </div>
              </form>


            </div>
          
          </div>
          
        </div>
      </div>
<?php include 'footer.php'; ?>