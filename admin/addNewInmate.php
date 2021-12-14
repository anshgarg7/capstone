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
                        <li class="breadcrumb-item"><a href="inmatesmanagement.php">Inmates Management</a></li>
                        <li class="breadcrumb-item active">Inmates Registeration</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Register New Inmate</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addInmateAct.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="firstName" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="lastName" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Numner</label>
                                    <input type="number" class="form-control" name="phoneNumber" id="exampleInputPassword1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">ID Proof Number</label>
                                    <input type="text" class="form-control" name="idProofNumber" id="exampleInputPassword1">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputPassword1">Gender</label>
                                        <select class="form-control" name="gender" id="exampleInputPassword1">
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                            <option value="2">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputPassword1">Barrack Number</label>
                                        <select class="form-control" name="barrackId" id="exampleInputPassword1">
                                            <?php
                                            $jailId = 1;
                                            $barracks = getThis("SELECT `id`, `barrackName`, `barrackLocation`, `totalCapacity` FROM `jailbarracks` WHERE `jailId`='$jailId' AND `enabled`='1'");
                                            for ($i = 0; $i < sizeof($barracks); $i++) {
                                                $barrackId = $barracks[$i]['id'];
                                                $temp = getThis("SELECT COUNT(`id`) FROM `inmatedetails` WHERE `barrackId`='$barrackId' AND `enabled`='1'");
                                                $temp = (int)$temp[0]['COUNT(`id`)'];
                                                $size = (int)e_d('d', $barracks[$i]['totalCapacity']);
                                                $temp = $size - $temp;
                                            ?>
                                                <option value="<?php echo $barrackId; ?>"><?php echo e_d('d', $barracks[$i]['barrackName']) . ", " . e_d('d', $barracks[$i]['barrackLocation']) . " (Vacant: " . $temp . " )"; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Emergency Contact Number</label>
                                    <input type="number" class="form-control" name="alternatePhoneNumber" id="exampleInputPassword1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address Line 1</label>
                                    <input type="text" class="form-control" name="addressLine1" id="exampleInputPassword1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Address Line 2</label>
                                    <input type="text" class="form-control" name="addressLine2" id="exampleInputPassword1">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <select class="form-control" name="countryID" id="Country_c" required>
                                            <option selected disabled>Select Country</option>
                                            <?php $country = getThis("SELECT `id`, `name` FROM `countries` ORDER BY `name` ASC") ?>
                                            <?php foreach ($country as $k => $c) { ?>
                                                <option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <select class="form-control" name="stateID" id="State_c" required>
                                            <option disabled selected>Select Country First</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4 form-group">

                                        <select class="form-control" name="cityID" id="City_c" required>
                                            <option disabled selected>Select State First</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Lawyer Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">First Name</label>
                                    <input type="text" class="form-control" name="lawyerFirstName" id="exampleInputPassword1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Last Name</label>
                                    <input type="text" class="form-control" name="lawyerLastName" id="exampleInputPassword1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email Address</label>
                                <input type="email" class="form-control" name="lawyerEmailAddress" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contact Number</label>
                                <input type="number" class="form-control" name="lawyerContactNumber" id="exampleInputPassword1">
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Judgement Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Duration (Months)</label>
                                <input type="number" class="form-control" name="duration" id="exampleInputPassword1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Summary</label>
                                <textarea name="judgementDetails" id="" cols="165" rows="5"></textarea>
                                <!-- please add design here to make it responsive moreover, it looks shit  -->
                            </div>

                        </div>

                    </div>

                    <div class="card card-primary">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            <a href="inmatesmanagement.php" class="btn btn-danger btn-block">Cancel</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
</div>
</div>
</section>

</div>


<?php include "footer.php"; ?>


<script type="text/javascript">
    $(document).ready(function() {
        $("#Country_c").change(function() {
            var CountryID = $("#Country_c").val();
            $.ajax({
                url: 'assets/worldData.php',
                method: 'post',
                data: 'Country=' + CountryID
            }).done(function(countries) {
                states = JSON.parse(countries);
                $('#State_c').empty();
                $('#State_c').append('<option disabled selected>Select State</option>');
                states.forEach(function(state) {
                    $('#State_c').append('<option value=' + state.id + '>' + state.name + '</option>');
                })
                $('#State_c').append('<option value=0>My option is not listed</option>');
            })
        });
        $("#State_c").change(function() {
            var StateID = $("#State_c").val();
            $.ajax({
                url: 'assets/worldData.php',
                method: 'post',
                data: 'State=' + StateID
            }).done(function(states) {
                cities = JSON.parse(states);
                $('#City_c').empty();
                $('#City_c').append('<option disabled selected>Select City</option>');
                cities.forEach(function(city) {
                    $('#City_c').append('<option value=' + city.id + '>' + city.name + '</option>');
                })
                $('#City_c').append('<option value=0>My option is not listed</option>');
            })
        });
    })
</script>