<?php include "header.php"; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inmate Movement Management Dashboard</h1>
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
            <h3 class="card-title">Inmates on movement without permission</h3>

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
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $moves = getThis("SELECT * FROM `journeydata` WHERE `routeId`='0'");
                    for($p=0;$p<sizeof($moves); $p++)
                    {
                        $journey = $moves[$p];
                        ?>
                        <tr>
                            <td>
                                <?php echo $p+1; ?>
                            </td>
                          

                       
                            <?php
                                $routeArr = array();
                                $temp = $journey['journeyArray'];
                                $temp = trim($temp,'[');
                                $temp = trim($temp,']');
                                $temp = trim($temp, '"');
                                $arr = explode(",", $temp);
                                for($x=0;$x<sizeof($arr);$x++)
                                {
                                    $arr[$x] = ltrim($arr[$x]);
                                    $arr[$x] = trim($arr[$x], '"');
                                }

                                $inmateIdTemp = $arr[0];
                                $timeStamp = $arr[1];
                                $cameraId = $arr[2];
                                
                                ?>
                                <td>
                                    <?php 

                                    $inmateName = getThis("SELECT  `firstName`, `lastName` FROM `inmatedetails` WHERE `id`='$inmateIdTemp'");
                                    $inmateName = $inmateName[0];
                                    echo e_d('d', $inmateName['firstName'])." ".e_d('d', $inmateName['lastName']);

                                ?>
                                </td>
                                <td>
                                    <?php

                                        echo "Recorded at camera number: ".$cameraId." at time: ".$timeStamp;

                                    ?>
                                </td>
                        
                        <?php    
                        }
                        ?>
                       

                        </tr>

                        
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

</div>
        <br><br>
        <div class="row">



            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Inmates on movement</h3>

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
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Date & Time</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $moves = getThis("SELECT `id`, `sourceId`, `destinationId`, `inmateId`, `generatedAt`,`enabled` FROM `routes` ORDER BY `generatedAt` DESC");
                                for($p=0;$p<sizeof($moves); $p++)
                                {
                                    $move = $moves[$p];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $p+1; ?>
                                        </td>
                                       <td>
                                           <?php 
                                                $inmateId = $move['inmateId'];
                                                $inmateName = getThis("SELECT `firstName`, `lastName` FROM `inmatedetails` WHERE `id`='$inmateId'");
                                                $inmateName = $inmateName[0];
                                                echo e_d('d', $inmateName['firstName'])." ".e_d('d', $inmateName['lastName']);
                                           ?>
                                       </td> 
                                       <td>
                                           <?php
                                                $sourceId = $move['sourceId'];
                                                $name = getThis("SELECT `name` FROM `locationdetails` WHERE `id`='$sourceId'");
                                                $name = $name[0]['name'];
                                                echo e_d('d',$name);
                                           ?>
                                       </td>
                                       <td>
                                           <?php
                                                $destinationId = $move['destinationId'];
                                                $name = getThis("SELECT `name` FROM `locationdetails` WHERE `id`='$destinationId'");
                                                $name = $name[0]['name'];
                                                echo e_d('d',$name);
                                           ?>
                                       </td>
                                       <td>
                                           <?php
                                            echo $move['generatedAt'];
                                           ?>
                                       </td>

                                    <td>
                                        <?php
                                        $routeId = $move['id'];
                                        $journey = getThis("SELECT `journeyArray` FROM `journeydata` WHERE `routeID`='$routeId'");
                                        $routeArr = array();
                                        for($i=0;$i<sizeof($journey); $i++)
                                        {
                                            $temp = $journey[$i]['journeyArray'];
                                            $temp = trim($temp,'[');
                                            $temp = trim($temp,']');
                                            $temp = trim($temp, '"');
                                            $arr = explode(",", $temp);
                                            for($x=0;$x<sizeof($arr);$x++)
                                            {
                                                $arr[$x] = ltrim($arr[$x]);
                                                $arr[$x] = trim($arr[$x], '"');
                                            }

                                            $inmateIdTemp = $arr[0];
                                            $timeStamp = $arr[1];
                                            $cameraId = $arr[2];

                                           if($inmateId==$inmateIdTemp)
                                           {
                                                $routeArr[$cameraId] = $timeStamp;
                                           }
                                        }
                                        $completed = $move['enabled'];
                                        if($completed=='0')
                                        {
                                            echo "Completed successfully.";
                                        }
                                        else{
                                        // $n = sizeof($routeArr);
                                        if(sizeof($routeArr)==0)
                                        {
                                            echo "Movement not started yet.";
                                        }else{
                                        $last = $routeArr[array_key_last($routeArr)];
                                        $first = $routeArr[array_key_first($routeArr)];
                                        $time = strtotime($last)-strtotime($first);
                                        $time =  $time/60;
                                        $today = date("Y-m-d H:i:s");
                                        $avgTime = getThis("SELECT MAX(`averageTime`) FROM `routecameramap` WHERE `sourceId`='$sourceId' AND `destinationId`='$destinationId';");
                                        $avgTime = $avgTime[0]["MAX(`averageTime`)"];
                                        $diff = strtotime($today) - strtotime($first);
                                        $diff = $diff/60;
                                        // echo $diff;
                                        
                                        if($time>($avgTime+5) || $diff>($avgTime+5))
                                        {
                                            ?>
                                            <button class="btn btn-danger" disabled>Alert</button>
                                            <?php
                                            echo "Time exceeded. Last recorded at camera number: ".array_key_last($routeArr)." at time: ".$routeArr[array_key_last($routeArr)];
                                        }
                                        else{
                        
                                            echo "In movement. Last recorded at camera number: ".array_key_last($routeArr);
                                            
                                        }}
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
    </section>
</div>

<?php include "footer.php"; ?>