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
                                
                                <div class="row">
                                    
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputPassword1">Barrack Number</label>
                                        <select class="form-control" name="barrackId" id="barrack_c">
                                            <option value="0" selected>Select barrack number</option>
                                            <?php
                                            $jailId = 1;
                                            $barracks = getThis("SELECT `id`, `barrackName`, `barrackLocation` FROM `jailbarracks` WHERE `jailId`='$jailId' AND `enabled`='1'");
                                            for ($i = 0; $i < sizeof($barracks); $i++) {
                                                $barrackId = $barracks[$i]['id'];
                                            ?>
                                                <option value="<?php echo $barrackId; ?>"><?php echo e_d('d', $barracks[$i]['barrackName']) . ", " . e_d('d', $barracks[$i]['barrackLocation']) ; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <select class="form-control" name="inmateID" id="name_c" required>
                                            <option disabled selected>Select Barrack First</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <select class="form-control" name="inmateID"  required>
                                            <option disabled selected>From</option>
                                            <option value="0">Location 1</option>
                                            <option value="0">Location 2</option>
                                            <option value="0">Location 3</option>
                                            <option value="0">Location 4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <select class="form-control" name="inmateID"  required>
                                            <option disabled selected>To</option>
                                            <option value="0">Location 1</option>
                                            <option value="0">Location 2</option>
                                            <option value="0">Location 3</option>
                                            <option value="0">Location 4</option>

                                        </select>
                                    </div>
                                </div>


                            </div>
                    </div>
                    <!-- /.card-body -->
                    
                   

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
        $("#barrack_c").change(function() {
            var barrackID = $("#barrack_c").val();
            $.ajax({
                url: 'assets/worldData.php',
                method: 'post',
                data: 'barrack=' + barrackID
            }).done(function(barracks) {
                names = JSON.parse(barracks);
                $('#name_c').empty();
                $('#name_c').append('<option disabled selected>Select name</option>');
                names.forEach(function(name) {
                    $('#name_c').append('<option value=' + name.id + '>' + name.firstName + '</option>');
                })
                $('#name_c').append('<option value=0>My option is not listed</option>');
            })
        });
        
    })
</script>