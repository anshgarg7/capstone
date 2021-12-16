<?php
include "../fxn.php";

$sourceId = $_POST["source"];
$destinationId = $_POST["destination"];
$camera = $_POST["camera"];
$cameraArr = serialize($camera);
// $cameraArr = e_d('e', $cameraArr);


$res = doThis("INSERT INTO `routecameramap`(`sourceId`, `destinationId`, `camera`) VALUES('$sourceId','$destinationId', '$cameraArr')");
if ($res) {
?>
    <script>
        alert("Camera Map Registered!");
        window.location = "../../routemanagement.php";
    </script>
<?php
} else {
?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../dashboard.php";
    </script>
<?php
}
?>