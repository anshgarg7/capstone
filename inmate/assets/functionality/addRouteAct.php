<?php include "../fxn.php";

$inmateId = $_POST["inmateId"];
$destination = $_POST["destination"];
$source = $_SESSION["UID"];

$res = doThis("INSERT INTO `routes`(`sourceId`, `destinationId`, `inmateId`, `generatedAt`) VALUES ('$source', '$destination', '$inmateId', CURRENT_TIMESTAMP)");
if ($res) {
?>
    <script>
        alert("Route Registered!");
        window.location = "../../dashboard.php";
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