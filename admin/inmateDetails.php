<?php include "header.php"; 

$inmateID = $_GET["id"];
$inmateID = e_d('d', $inmateID);
$details = getThis("SELECT `lawyerId`, `barrackId`, `firstName`, `lastName`, `gender`, `phoneNumber`, `idProofNumber`, `addressLine1`, `addressLine2`, `cityID`, `stateID`, `countryID`, `alternatePhoneNumber`, `judgementDetails`, `duration` FROM `inmatedetails` WHERE `id`='$inmateID'");
$details = $details[0];
?>
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
        
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inmate Details</h3>

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
                            <tr>
                                <td>
                                    First Name
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['firstName']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Last Name
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['lastName']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Gender
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['gender']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ID Proof Number
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['idProofNumber']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Judgement Details
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['judgementDetails']); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Duration (in months)
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['duration']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Lawyer Name & Contact
                                </td>
                                <td>
                                    <?php $lawyerID = $details['lawyerId'];
                                    // $lawyerID = e_d('d', $lawyerID);
                                    $lawyerDetails = getThis("SELECT `firstName`, `lastName`, `emailAddress`, `phoneNumber` FROM `lawyerdetails` WHERE `id`='$lawyerID'");
                                    $lawyerDetails = $lawyerDetails[0];
                                    echo e_d('d', $lawyerDetails['firstName'])." ".e_d('d', $lawyerDetails['lastName']).", ".e_d('d', $lawyerDetails['emailAddress'])." , ".e_d('d', $lawyerDetails['phoneNumber']);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Phone Number
                                </td>
                                <td>
                                    <?php echo e_d('d', $details['phoneNumber']);
                                    
                                   
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Address
                                </td>
                                <td>
                                    <?php echo e_d('d',$details['addressLine1']).", ".e_d('d', $details['addressLine2']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    City
                                </td>
                                <td>
                                    <?php
                                    $cityID = $details['cityID'];
                                    $city = getThis("SELECT `name` FROM `cities` WHERE `id`='$cityID'");
                                    $city = $city[0];
                                    echo $city['name'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    State
                                </td>
                                <td>
                                    <?php
                                    $stateID = $details['stateID'];
                                    $state = getThis("SELECT `name` FROM `states` WHERE `id`='$stateID'");
                                    $state = $state[0];
                                    echo $state['name'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Country
                                </td>
                                <td>
                                    <?php
                                    $countryID = $details['countryID'];
                                    $country = getThis("SELECT `name` FROM `countries` WHERE `id`='$countryID'");
                                    $country = $country[0];
                                    echo $country['name'];
                                    ?>
                                </td>
                            </tr>
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