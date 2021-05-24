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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php include "footer.php"; ?>