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
                        <li class="breadcrumb-item active">Inmates Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <a href="addNewInmate.php" class="btn btn-block btn-success">Register New Inmate</a>
                <a href="removeInmate.php" class="btn btn-block btn-success">Remove Inmate</a>
                <!-- <a href="inmateMovement.php" class="btn btn-block btn-success">Inmate Movement</a> -->
                <a href="faceRecord.php" class="btn btn-block btn-success">Inmate Face Record</a>

            </div>
        </div>
        <br><br>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Inmates</h3>

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
                                    <th>UID Number</th>
                                    <th>Barrack Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jailId = 1;
                                $inmates = getThis("SELECT `id`, `barrackId`, `firstName`, `lastName`, `idProofNumber` FROM `inmatedetails` WHERE `jailId`='$jailId' AND (`enabled`='1' OR `enabled`='2')");
                                for ($i = 0; $i < sizeof($inmates); $i++) {
                                ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo e_d('d', $inmates[$i]['firstName']) . " " . e_d('d', $inmates[$i]['lastName']); ?></td>
                                        <td><?php echo e_d('d', $inmates[$i]['idProofNumber']); ?></td>
                                        <td>
                                            <?php
                                            $barrackId = $inmates[$i]['barrackId'];
                                            $barracks = getThis("SELECT `barrackName` FROM `jailbarracks` WHERE `id`='$barrackId'");
                                            $barracks = $barracks[0]['barrackName'];
                                            echo e_d('d', $barracks);
                                            ?>
                                        </td>
                                        <td> <a href="inmateDetails.php?id=<?php echo e_d('e', $inmates[$i]['id']); ?>" class="btn btn-primary">View Details</a> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </section>
</div>

<?php include "footer.php"; ?>