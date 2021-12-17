<?php include "../fxn.php";

$jailId = 1;
$inmateId = $_POST["inmateId"];
$approvalDate = $_POST["dateOfBail"];
$dateOfOrder = $_POST["dateOfOrder"];

$res = doThis("INSERT INTO `bailmanagement`(`jailID`, `inmateID`, `orderDate`, `approvalDate`, `generatedAt`) VALUES('$jailId','$inmateId', '$dateOfOrder','$approvalDate', CURRENT_TIMESTAMP)");
if ($res) {
?>
    <script>
        alert("Bail Registered Successfully!!");
        window.location = "../../bailmanagement.php";
    </script>
<?php
} else {
?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../bailmanagement.php";
    </script>
<?php
}
?>