<?php include "header.php"; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <br><br>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Request New Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="assets/functionality/addBarrackAct.php" method="POST">
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