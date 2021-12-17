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
                        <li class="breadcrumb-item active">Parole Management</li>
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
                            <h3 class="card-title">Register New Bail Entry</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addNewBailAct.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Inmate Name</label>
                                    <select name="inmateId" class="form-control">
                                        <?php
                                        $jailID = 1;
                                        $inmates = getThis("SELECT `id`, `firstName`, `lastName` FROM `inmatedetails` WHERE `jailID`='$jailID'");
                                        for ($i = 0; $i < sizeof($inmates); $i++) {
                                            $inmate = $inmates[$i];
                                            $inmateId = $inmate['id'];
                                        ?>
                                            <option value="<?php echo $inmateId; ?>"><?php echo e_d('d', $inmate['firstName']) . " " . e_d('d', $inmate['lastName']); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date Of Bail</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1" name="dateOfBail">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date Of Court Order</label>
                                    <input type="date" class="form-control" id="exampleInputPassword1" name="dateOfOrder">
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
        </div>
    </section>

</div>
<?php include "footer.php"; ?>