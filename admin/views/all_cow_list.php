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
                <h3 class="card-title">List of Cow</h3>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Cow Name</th>
                      <th>Cattle Bread</th>
                      <th>Insert Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      $serial = 0;
                      $showCowQry = $conn->query("SELECT or_cow_info.*, or_cattle_breed.cattle_breed_name FROM `or_cow_info` INNER JOIN or_cattle_breed ON or_cow_info.cattle_breed=or_cattle_breed.cattle_breed_id");
                      while ($showCowRow = mysqli_fetch_object($showCowQry)) {
                    ?>

                    <tr>
                      <td><?php echo(++$serial); ?></td>

                      <td><?php echo($showCowRow->cow_name); ?></td>
                      <td><?php echo($showCowRow->cattle_breed_name); ?></td>
                      <td><?php echo(date('d M, Y', strtotime($showCowRow->cow_insertDate))); ?></td>

                      <td>
                        <a href="<?php echo "index.php?page=edit-cow&edit_id=".$showCowRow->cow_id; ?>" class="btn btn-success btn-sm">View</a>
                        <a href="<?php echo "index.php?page=edit-cow&edit_id=".$showCowRow->cow_id; ?>" class="btn btn-warning btn-sm">Edit</a>
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