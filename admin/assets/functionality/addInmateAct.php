<?php include "../fxn.php";
$jailId = 1;
$barrackId = $_POST["barrackId"];
$firstName = e_d('e', $_POST["firstName"]);
$lastName = e_d('e', $_POST["lastName"]);
$gender = e_d('e', $_POST["gender"]);
$phoneNumber = e_d('e', $_POST["phoneNumber"]);
$idProofNumber = e_d('e', $_POST["idProofNumber"]);
$addressLine1 = e_d('e', $_POST["addressLine1"]);
$addressLine2 = e_d('e', $_POST["addressLine2"]);
$cityId = $_POST["cityID"];
$stateId = $_POST["stateID"];
$countryId = $_POST["countryID"];
$alternatePhone = e_d('e', $_POST["alternatePhoneNumber"]);

$lawyerFirstName = e_d('e', $_POST["lawyerFirstName"]);
$lawyerLastName = e_d('e', $_POST["lawyerLastName"]);
$lawyerEmailAddress = e_d('e', $_POST["lawyerEmailAddress"]);
$lawyerContactNumber = e_d('e', $_POST["lawyerContactNumber"]);

$duration = e_d('e', $_POST["duration"]);
$judgementDetails = e_d('e', $_POST["judgementDetails"]);

$lawyerId = doThis("INSERT INTO `lawyerdetails`(`firstName`, `lastName`, `emailAddress`, `phoneNumber`) VALUES ('$lawyerFirstName', '$lawyerLastName', '$lawyerEmailAddress', '$lawyerContactNumber')");
$res = doThis("INSERT INTO `inmatedetails`(`jailId`, `lawyerId`, `barrackId`, `firstName`, `lastName`, `gender`, `phoneNumber`, `idProofNumber`, `addressLine1`, `addressLine2`, `cityID`, `stateID`, `countryID`, `alternatePhoneNumber`, `judgementDetails`, `duration`,`enabled`) VALUES ('$jailId', '$lawyerId', '$barrackId', '$firstName', '$lastName', '$gender', '$phoneNumber', '$idProofNumber', '$addressLine1', '$addressLine2', '$cityId', '$stateId', '$countryId', '$alternatePhone', '$judgementDetails', '$duration','2')");


if ($res) {
?>
    <script>
        alert("Inmate Registered!!");
        window.location = "../../inmatesmanagement.php";
    </script>
<?php
} else {
?>
    <script>
        alert("There is some technical error!");
        window.location = "../../dashboard.php";
    </script>
<?php
}
?>