<?php include "../fxn.php";
$id = $_GET["id"];
$id = e_d('d', $id);

$res = doThis("UPDATE `parolemanagement` SET `updatedAt`= CURRENT_TIMESTAMP,`paroleRequestStatus`='2' WHERE `id`='$id'");
if($res)
{
    ?>
    <script>
        alert("Entry marked successfully!!");
        window.location= "../../parolemanagement.php";
    </script>
    <?php
}
else{
    ?>

    <script>
        alert("There is some technical problem!!");
        window.location = "../../parolemanagement.php";
    </script>
    <?php
}


?>