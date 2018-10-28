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
              <h3 class="card-title">View Eaten Foods</h3>
              <?php
                // show error or success messages
                if((isset($_GET['check'])) && ($_GET['check']=='success')){
                  echo "<p style='color:green;'>You checked all eaten foods.....</p>";
                }
                elseif((isset($_GET['check'])) && ($_GET['check']=='error1')){
                  echo "<p style='color:red;'>something went wrong to insert remaining foods.....</p>";
                }
                elseif((isset($_GET['check'])) && ($_GET['check']=='error2')){
                  echo "<p style='color:red;'>something went wrong to delete previous foods.....</p>";
                }
              ?>
              <?php
                $showEatenFoodQry = $conn->query("SELECT 
                  or_cow_eaten_foods.*, 
                  or_cow_food_category.cow_foodCat_name, 
                  or_cow_info.cow_name 
                  FROM or_cow_eaten_foods 
                    INNER JOIN or_cow_info
                  ON or_cow_eaten_foods.cowEF_cowId=or_cow_info.cow_id
                    INNER JOIN or_cow_food_category
                  ON or_cow_eaten_foods.cowEF_foodCatId=or_cow_food_category.cow_foodCat_id
                    WHERE or_cow_eaten_foods.cowEF_status='1'");
                if(mysqli_num_rows($showEatenFoodQry)>0){
              ?>
              <table class="table table-hover table-bordered" id="viewEatenFoodsTable">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>Cow Name</th>
                    <th>Food Name</th>
                    <th>Food Quantity</th>
                    <th>Date</th>
                    <th>Time</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $serial = 1;
                    while ($showEatenFoodRow = mysqli_fetch_object($showEatenFoodQry)) {
                  ?>
                  <tr>
                    <td><?=$serial++;?></td>
                    <td><?=$showEatenFoodRow->cow_name;?></td>
                    <td><?=$showEatenFoodRow->cow_foodCat_name;?></td>
                    <td><?=$showEatenFoodRow->cowEF_foodQuantity;?></td>
                    <td><?=date('d M, Y', strtotime($showEatenFoodRow->cowEF_Date));?></td>
                    <td><?=date('h:i A', strtotime($showEatenFoodRow->cowEF_Time));?></td>
                  </tr>
                <?php 
                // end table data while loop
                  } 
                ?>
                </tbody>
              </table>
              <!-- start check eaten food form -->
              <form method="post" id="checkAllEatenFoodForm" action="<?php echo htmlspecialchars($cur_page_link); ?>">
                <input type="hidden" name="checkAllEatenFoodSubmit" value="go">
              </form>
              <!-- eaten food form submit button -->
              <br>
              <button id="checkAllEatenFoodSubmit" class="btn btn-primary btn-block">Checked All</button>
              <!-- eaten checkd eaten food form -->
              <?php
              // end if any data have in eaten food for check
                }
                // if no data found
                else{
                  echo "<h3>No eaten foods for check. thank you</h3>";
                }
              ?>


            </div>
          </div>
          
        </div>
      </div>




<script type="text/javascript">

  $(document).ready(function() {
    // Checkd All Eaten Food Button Alert Style with swal
    $('#checkAllEatenFoodSubmit').click(function(){
      swal({
        title: "Are you Checked all Eaten Food?",
        text: "All are Ok!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, All is Ok!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
      }, function(isConfirm) {
        if (isConfirm) {
          $("#checkAllEatenFoodForm").submit();
        } else {
          swal("Cancelled", "Check all eaten food and click this button again :)", "error");
        }
      });
    });
  });

</script>
<?php include 'footer.php'; ?>