<?php include "../fxn.php";
$inmateId = $_GET['id'];
$inmateId = e_d('d', $inmateId);

$res = doThis("UPDATE `inmatedetails` SET `updatedAt`=CURRENT_TIMESTAMP, `enabled`='0' WHERE `id`='$inmateId'");
if($res)
{
    ?>
<script>
        alert("Inmate removed!!");
        window.location = "../../inmatesmanagement.php";
    </script>
    <?php
}
else
{
    ?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../inmatesmanagement.php";
    </script>
    <?php
}
?>