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
              <h3 class="card-title">Add Cow Eaten Foods</h3>
              <!-- error or success message -->
              <?php
                if(isset($_GET['removeFood']) && ($_GET['removeFood']=='success')){
                  echo "<p style='color:green;'>Add Eaten Food Successfully....</p>";
                }
                elseif(isset($_GET['removeFood']) && ($_GET['removeFood']=='error')){
                  echo "<p style='color:red;'>Something went wrong to add eaten food. please contact with administrator...</p>";
                }
              ?>

              <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>">
                <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">Cattle Breed</label>
                      <select name="cattle_breed_id" id="sel_cattle_breed_id" class="form-control" required>
                        <option></option>
                        <?php
                          $showCowCatQry = $conn->query("SELECT or_cattle_breed.cattle_breed_id, or_cattle_breed.cattle_breed_name FROM or_cattle_breed WHERE cattle_breed_status='1'");
                          while($showCowCatRow = mysqli_fetch_object($showCowCatQry)){
                        ?>
                          <option value="<?=$showCowCatRow->cattle_breed_id;?>"><?=$showCowCatRow->cattle_breed_name;?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Cow Name</label>
                      <select name="cow_id" id="sel_cow_id" class="form-control" required="">
                        <option>Please select a cattle breed</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Food Name</label>
                      <select id="FoodCat" name="food_cat_id" class="form-control FoodCat" required="">
                        <option></option>
                        <?php
                          $showFoodCatQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_status='1'");
                          while($showFoodCatRow = mysqli_fetch_object($showFoodCatQry)){
                        ?>
                          <option value="<?=$showFoodCatRow->cow_foodCat_id;?>"><?=$showFoodCatRow->cow_foodCat_name;?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>

                    <div class="eachFood"></div>
                </div>

                <div class="card-footer">
                  <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
                  &nbsp;&nbsp;&nbsp;
                  <button class="btn btn-primary icon-btn" type="submit" name="add_cow_eaten_food_btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add to Eaten Food</button>
                </div>
              </form>


            </div>
          </div>
          
        </div>
      </div>

<script type="text/javascript">
$(document).ready(function() {
  // food category search in select
  $('.FoodCat').select2();

  //show cow list after select cattle breed
  $("#sel_cattle_breed_id").change(function()  {
    var needShow = "cowDetails";
    var cattle_breed_id = $("#sel_cattle_breed_id").val();
    $.ajax({  
        type: 'GET',  
        url: 'controller/eatenFoodAjax.php', 
        data: { needShow: needShow, cattle_breed_id: cattle_breed_id },
        success: function(html) {
          $("#sel_cow_id").empty();
          $("#sel_cow_id").append(html);
        }
    });
  });

  // add eaten food list after select food category
  $("#FoodCat").change(function(){
    var needAdd = "eachFoodCat";
    var food_cat_id = $("#FoodCat").val();
    $.ajax({
      type: 'GET',
      url: 'controller/eatenFoodAjax.php',
      data: {needAdd: needAdd, food_cat_id: food_cat_id},
      success: function(html){
        $(".eachFood").append(html);
      }
    });
  });
});

function removeAddFood(removeId){
  var a = "#"+removeId;
  $(a).parent().parent().remove();
}

</script>
<?php include 'footer.php'; ?>  