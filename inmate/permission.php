<?php include "header.php"; 
$inmateId = $_GET["id"];
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <br><br>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php 
            $inmateName = getThis("SELECT `firstName`, `lastName` FROM `inmatedetails` WHERE `id`='$inmateId'");
            $inmateName = $inmateName[0];
            echo e_d('d',$inmateName['firstName'])." ".e_d('d',$inmateName['lastName']);
          ?> Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Request New Route</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addRouteAct.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location Name/Number</label>
                                    <select name="destination" class="form-control">
                                        <option value="0" selected>Select Destination</option>
                                        <?php 
                                            $options = getThis("SELECT `id`,`name` FROM `locationdetails` WHERE `jailId`='1'");
                                            for($i=0;$i<sizeof($options); $i++)
                                            {
                                                $option = $options[$i];
                                                if($option['id']!=$id)
                                                {
                                                    $name = $option['name'];
                                                    $name = e_d('d', $name);
                                                    $id = $option['id'];
                                                    ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                            <input type="hidden" name="inmateId" value="<?php echo $inmateId; ?>">
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                        <div class="card-footer">
                        <a href="http://127.0.0.1:5000/inmaterecognition" class="btn btn-danger btn-block">Scan face again</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php include "footer.php"; ?>