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
              <h3 class="card-title">Add Cow Medical Cost</h3>


              <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>">
                <!-- show error and succes messages -->
                <?php
                  if((isset($_GET['inp'])) && ($_GET['inp']=='empty')){
                    echo "<p style='color:red'>All field r needed</p>";
                  }
                  elseif((isset($_GET['add'])) && ($_GET['add']=='success')){
                    echo "<p style='color:green'>Medical Cost added succesfully</p>";
                  }
                  elseif((isset($_GET['add'])) && ($_GET['add']=='error')){
                    echo "<p style='color:green'>Something went wrong to add Medical Cost. Please try again...</p>";
                  }

                ?>
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
                    <label class="control-label">Name of illness</label>
                    <input class="form-control" type="text" name="illness_name" placeholder="Name of illness">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Cost (in bd tk.)</label>
                    <input type="number" step="0.01" class="form-control" name="illness_cost" placeholder="medical cost">
                  </div>

                </div>
                <div class="card-footer">
                  <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
                  &nbsp;&nbsp;&nbsp;
                  <button class="btn btn-primary icon-btn" type="submit" name="add_cow_medical_cost"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                </div>
              </form>


            </div>
          
          </div>
          
        </div>
      </div>




<script type="text/javascript">
  $(document).ready(function() {

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
  });

</script>
<?php include 'footer.php'; ?>