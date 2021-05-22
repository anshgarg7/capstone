<?php
include "../fxn.php";

if (isset($_POST["submit"]) || isset($_POST["submit1"])) {
    $activityCategoryID = $_POST["activityCategoryID"];
    $activityTitle = e_d('e', $_POST["activityTitle"]);
    $pricePerPerson = e_d('e', $_POST["pricePerPerson"]);
    $activityLevel = e_d('e', $_POST["activityLevel"]);
    $activityAltitude = e_d('e', $_POST["activityAltitude"]);
    $activityLanguages = e_d('e', serialize($_POST["activityLanguages"]));
    $ageUpperLimit = e_d('e', $_POST["ageUpperLimit"]);
    $ageLowerLimit = e_d('e', $_POST["ageLowerLimit"]);
    $activityMeetingPointAddressLine1 = e_d('e', $_POST["activityMeetingPointAddressLine1"]);
    $activityMeetingPointAddressLine2 = e_d('e', $_POST["activityMeetingPointAddressLine2"]);
    $activityMeetingPointCityID = $_POST["activityMeetingPointCityID"];
    $activityMeetingPointStateID = $_POST["activityMeetingPointStateID"];
    $activityMeetingPointCountryID = $_POST["activityMeetingPointCountryID"];
    $activityMeetingPointZipcode = e_d('e', $_POST["activityMeetingPointZipcode"]);
    $activityHighlights = e_d('e', $_POST["activityHighlights"]);
    $whatToTake = e_d('e', serialize($_POST["whatToTake"]));
    $services = e_d('e', serialize($_POST["services"]));
    $addOnName = $_POST["addOnName"];
    $addOnCharges = $_POST["addOnCharges"];
    $activityWarnings = e_d('e', $_POST["activityWarnings"]);
    $vendorID = $_SESSION["VID"];


    $act = doThis("INSERT INTO `vendoractivities`(`vendorID`, `activityCategoryID`, `activityTitle`, `pricePerPerson`, `activityLevel`, `activityAltitude`, `activityLanguages`, `ageUpperLimit`, `ageLowerLimit`, `activityHighlights`, `whatToTake`, `services`, `activityWarnings`, `activityMeetingPointAddressLine1`, `activityMeetingPointAddressLine2`, `activityMeetingPointCityID`, `activityMeetingPointStateID`, `activityMeetingPointCountryID`, `activityMeetingPointZipcode`, `pageAt`) VALUES ('$vendorID', '$activityCategoryID','$activityTitle', '$pricePerPerson', '$activityLevel', '$activityAltitude', '$activityLanguages', '$ageUpperLimit', '$ageLowerLimit', '$activityHighlights', '$whatToTake', '$services', '$activityWarnings', '$activityMeetingPointAddressLine1', '$activityMeetingPointAddressLine2', '$activityMeetingPointCityID', '$activityMeetingPointStateID', '$activityMeetingPointCountryID', '$activityMeetingPointZipcode','0')");

    if ($act) {
        $_SESSION["activityID"] = $act;
        for ($i = 0; $i < sizeof($addOnName); $i++) {
            $singleAddOnName = e_d('e', $addOnName[$i]);
            $singleAddOnCharges = e_d('e', $addOnCharges[$i]);
            $addons = doThis("INSERT INTO `vendoractivitychargeableaddons`(`activityID`, `addOnName`, `addOnCharges`) VALUES ('$act','$singleAddOnName','$singleAddOnCharges')");
        }

        if ($addons && isset($_POST["submit"])) {
?>
            <script>
                alert("Activity Registration Initiated!! Keep going.");
                window.location = "../../activity1.php";
            </script>
        <?php
        } elseif ($addons && isset($_POST["submit1"])) {
            unset($_SESSION["activityID"]);
        ?>
            <script>
                alert("Complete registeration soon!!");
                window.location = "../../dashboard.php";
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("There is some technical error!!");
                window.location = "../../activity.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("There is some technical error!!");
            window.location = "../../dashboard.php";
        </script>
<?php
    }
}
?>
