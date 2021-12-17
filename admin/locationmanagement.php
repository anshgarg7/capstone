<?php include "header.php"; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jailer Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Location Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Register New Location</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addLocationAct.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="locationName" placeholder="Barrack 101">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Login ID</label>
                                    <input type="text" class="form-control" id="loginID" name="locationLogin" placeholder="First Floor, Wing A">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="number" class="form-control" name="password" id="exampleInputPassword1">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Registered Locations</h3>

              <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $locations = getThis("SELECT * FROM `locationdetails`");
                    for($i=0;$i<sizeof($locations); $i++)
                    {
                        $location = $locations[$i];
                        ?>
                        <tr>
                        <td><?php echo $i+1;?></td>
                        <td>
                            <?php echo e_d('d', $location['name']); ?>
                        </td>
                        <td>
                            <?php echo e_d('d', $location['username']); ?>
                        </td>
                        <td>
                            <?php echo e_d('d', $location['password']); ?>
                        </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                </table>
                </div>
                </div>
                </div>


        </div>


        </div>
    </section>

</div>
<?php include "footer.php"; ?>