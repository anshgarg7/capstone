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
                        <li class="breadcrumb-item active">Route Management</li>
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
                            <h3 class="card-title">Register New Route Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addRouteInfoAct.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Source</label>
                                    <select name="source" class="form-control">
                                        <option value="0" selected>Select Source</option>
                                        <?php 
                                            $options = getThis("SELECT `id`,`name` FROM `locationdetails` WHERE `jailId`='1'");
                                            for($i=0;$i<sizeof($options); $i++)
                                            {
                                                $option = $options[$i];
                                                
                                                    $name = $option['name'];
                                                    $name = e_d('d', $name);
                                                    $id = $option['id'];
                                                    ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                    <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Destination</label>
                                    <select name="destination" class="form-control">
                                        <option value="0" selected>Select Destination</option>
                                        <?php 
                                            $options = getThis("SELECT `id`,`name` FROM `locationdetails` WHERE `jailId`='1'");
                                            for($i=0;$i<sizeof($options); $i++)
                                            {
                                                $option = $options[$i];
                                                
                                                    $name = $option['name'];
                                                    $name = e_d('d', $name);
                                                    $id = $option['id'];
                                                    ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                    <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Camera Map</label> <br>
                                    <input type="checkbox" name="camera[]" value="1">
                                    <label for="vehicle1">Camera 1</label><br>
                                    <input type="checkbox" name="camera[]" value="2">
                                    <label for="vehicle1">Camera 2</label><br>
                                    <input type="checkbox" name="camera[]" value="3">
                                    <label for="vehicle1">Camera 3</label><br>
                                    <input type="checkbox" name="camera[]" value="4">
                                    <label for="vehicle1">Camera 4</label><br>
                                    <input type="checkbox" name="camera[]" value="5">
                                    <label for="vehicle1">Camera 5</label><br>
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

            <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Routes</h3>

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
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Camera Map</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $maps = getThis("SELECT `sourceId`, `destinationId`, `camera` FROM `routecameramap`");
                                for ($i = 0; $i < sizeof($maps); $i++) {
                                ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php $sourceId = $maps[$i]['sourceId'];
                                            $name = getThis("SELECT `name` FROM `locationdetails` WHERE `id`='$sourceId'");
                                            $name = $name[0]['name'];
                                            echo e_d('d', $name);
                                        ?></td>
                                        <td><?php $destinationId = $maps[$i]['destinationId'];
                                            $name = getThis("SELECT `name` FROM `locationdetails` WHERE `id`='$destinationId'");
                                            $name = $name[0]['name'];
                                            echo e_d('d', $name);
                                        ?></td>
                                        <td>
                                            <?php
                                            $cameraArr = $maps[$i]['camera'];
                                            $cameraArr = e_d('d', $cameraArr);
                                            $camera = unserialize($cameraArr);

                                            for($x=0;$x<sizeof($camera); $x++)
                                            {
                                                echo "Camera ".$camera[$x];
                                                echo ", ";
                                            }
                                            
                                            ?>
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

        </div>
    </section>

</div>
<?php include "footer.php"; ?>