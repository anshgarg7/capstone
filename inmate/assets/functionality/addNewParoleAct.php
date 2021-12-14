<?php include "../fxn.php";

$jailId = 1;
$inmateId = $_POST["inmateId"];
$dateOfParole = e_d('e', $_POST["dateOfParole"]);
$durationOfParole = e_d('e', $_POST["durationOfParole"]);

$res = doThis("INSERT INTO `parolemanagement`(`inmateID`, `jailID`, `dateOfParole`, `durationOfParole`, `paroleRequestStatus`) VALUES('$inmateId','$jailId', '$dateOfParole', '$durationOfParole', '1' )");
if ($res) {
?>
    <script>
        alert("Parole Registered Successfully!!");
        window.location = "../../parolemanagement.php";
    </script>
<?php
} else {
?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../parolemanagement.php";
    </script>
<?php
}
?>