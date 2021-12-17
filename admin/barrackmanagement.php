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
                        <li class="breadcrumb-item active">Barrack Management</li>
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
                            <h3 class="card-title">Register New Barrack</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addBarrackAct.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Barrack Name/Number</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="barrackName" placeholder="Barrack 101">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Barrack Location</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="barrackLocation" placeholder="First Floor, Wing A">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Total Capacity</label>
                                    <input type="number" class="form-control" name="totalCapacity" id="exampleInputPassword1">
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
              <h3 class="card-title">Registered Barracks</h3>

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
                    <th>Location</th>
                    <th>Total Capacity</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $barracks = getThis("SELECT * FROM `jailbarracks`");
                    for($i=0;$i<sizeof($barracks); $i++)
                    {
                        $barrack = $barracks[$i];
                        ?>
                        <tr>
                        <td><?php echo $i+1;?></td>
                        <td>
                            <?php echo e_d('d', $barrack['barrackName']); ?>
                        </td>
                        <td>
                            <?php echo e_d('d', $barrack['barrackLocation']); ?>
                        </td>
                        <td>
                            <?php echo e_d('d', $barrack['totalCapacity']); ?>
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
    </section>

</div>
<?php include "footer.php"; ?>