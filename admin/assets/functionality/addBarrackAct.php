<?php include "../fxn.php";

$barrackName = e_d('e', $_POST["barrackName"]);
$barrackLocation = e_d('e', $_POST["barrackLocation"]);
$totalCapacity = e_d('e', $_POST["totalCapacity"]);
$jailID = 1;   //to be changed when jail jailor mapping is added

$res = doThis("INSERT INTO `jailbarracks`(`jailId`, `barrackName`, `barrackLocation`, `totalCapacity`) VALUES ('$jailID', '$barrackName', '$barrackLocation', '$totalCapacity')");
if ($res) {
?>
    <script>
        alert("Barrack Registered!");
        window.location = "../../barrackmanagement.php";
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