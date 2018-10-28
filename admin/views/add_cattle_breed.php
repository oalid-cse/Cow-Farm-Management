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
              <h3 class="card-title">Add Cattle breed</h3>


              <form method="post" action="<?php echo htmlspecialchars($cur_page_link); ?>">
                <div class="card-body">
                    <div class="form-group">
                      <label class="control-label">Cattle breed name</label>
                      <input class="form-control" type="text" name="cattle_breed_name" placeholder="Enter cattle breed name">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Cattle breed description</label>
                      <textarea class="form-control" rows="4" name="cattle_breed_desc" placeholder="Enter cattle breed description"></textarea>
                    </div>

                </div>
                <div class="card-footer">
                  <button class="btn btn-default icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</button>
                  &nbsp;&nbsp;&nbsp;
                  <button class="btn btn-primary icon-btn" type="submit" name="add_cattle_breed_btn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                </div>
              </form>


            </div>
          </div>
          
        </div>
      </div>
<?php include 'footer.php'; ?>