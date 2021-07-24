<?php include "header.php"; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bail Management Dashboard</h1>
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
                <a href="#" class="btn btn-block btn-success">Pending Bail Orders</a>

            </div>
        </div>
        <br><br>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Inmates on bail</h3>

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
                                    <th>Date of Court Order</th>
                                    <th>Date of Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jailId = 1;
                                $bailInmates = getThis("SELECT `id`, `inmateID`, `orderID`, `approvalDate` FROM `bailmanagement` WHERE `jailID`='$jailId'");
                                for ($i = 0; $i < sizeof($bailInmates); $i++) {
                                    $inmate = $bailInmates[$i];
                                ?>
                                    <tr>
                                        <td><?php echo ($i + 1); ?></td>
                                        <td>
                                            <?php $inmateId = $inmate['inmateID'];
                                            $inmateName = getThis("SELECT `firstName`, `lastName` FROM `inmatedetails` WHERE `id`='$inmateId'");
                                            $inmateName = $inmateName[0];
                                            echo e_d('d', $inmateName['firstName']) . " " . e_d('d', $inmateName['lastName']); ?>
                                        </td>
                                        <td>
                                            <?php $orderId = $inmate['orderID'];
                                            $orderDetails = getThis("");
                                            $orderDetails = $orderDetails[0]['date'];
                                            echo e_d('d', $orderDetails); ?>
                                        </td>
                                        <td><?php echo e_d('d', $inmate['approvalDate']); ?></td>
                                        <td><a href="#" class="btn btn-primary">View Details</a></td>
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