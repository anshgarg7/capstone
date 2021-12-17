<?php include "header.php"; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Parole Management Dashboard</h1>
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
            
            
            <a href="createNewParole.php" class="btn btn-block btn-success">Create New Parole Entry</a>

            </div>
        </div>
        <br><br>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Inmates on parole</h3>

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
                                    <th>Date of Parole</th>
                                    <th>Duration (Days)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jailId = 1;
                                $inmates = getThis("SELECT `id`, `inmateID`, `dateOfParole`, `durationOfParole` FROM `parolemanagement` WHERE `jailId`='$jailId' AND `paroleRequestStatus`='1' ORDER BY `id` DESC");
                                for ($i = 0; $i < sizeof($inmates); $i++) {
                                    $inmate = $inmates[$i];
                                ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <?php
                                        $inmateID = $inmate['inmateID'];
                                        $inmateDetails = getThis("SELECT `firstName`, `lastName`, `idProofNumber` FROM `inmatedetails` WHERE `id`='$inmateID'");
                                        $inmateDetails = $inmateDetails[0];
                                        ?>
                                        <td><?php echo e_d('d', $inmateDetails['firstName']) . " " . e_d('d', $inmateDetails['lastName']); ?></td>
                                        <td><?php echo e_d('d', $inmateDetails['idProofNumber']); ?></td>
                                        <td><?php echo  e_d('d', $inmate['dateOfParole']); ?></td>
                                        <td><?php echo e_d('d', $inmate['durationOfParole']); ?></td>
                                        <td><a href="inmateDetails.php?id=<?php echo e_d('e',$inmateID);?>" class="btn btn-primary">View Details</a>
                                        <a href="assets/functionality/finishParoleAct.php?id=<?php echo e_d('e',$inmateID);?>" class="btn btn-primary">Returned</a>
                                    </td>
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