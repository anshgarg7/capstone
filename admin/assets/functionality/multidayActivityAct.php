<?php
include "../fxn.php";

if (isset($_POST["submit1"]) || isset($_POST["submit"])) {
    $activityDurationDays = $_POST["activityDurationDays"];
    $_SESSION["activityDays"] = $activityDurationDays;
    $activityDurationNights = e_d('e', $activityDurationDays-1 );
    $activityDurationDays = e_d('e', $activityDurationDays);

    $activityStartTime = e_d('e', $_POST["activityStartTime"]);
    $activityEndTime = e_d('e', $_POST["activityEndTime"]);
    $maximumCapacity = NULL;
    // $activityMeetingPointAddressLine1 = e_d('e', $_POST["activityMeetingPointAddressLine1"]);
    // $activityMeetingPointAddressLine2 = e_d('e', $_POST["activityMeetingPointAddressLine2"]);
    // $activityMeetingPointCountryID = $_POST["activityMeetingPointCountryID"];
    // $activityMeetingPointStateID = $_POST["activityMeetingPointStateID"];
    // $activityMeetingPointCityID = $_POST["activityMeetingPointCityID"];
    if(isset($_POST["activityRepeatStatus"])){
    $activityRepeatStatus = '1';
  }else{
    $activityRepeatStatus = '0';
  }

    $listingStartDate = $_POST["listingStartDate"];
    $listingStartDate = e_d('e', serialize($listingStartDate));
    $listingSpotsAvailability = $_POST["listingSpotsAvailability"];
    $listingSpotsAvailability = e_d('e', serialize($listingSpotsAvailability));
    $activityID = $_SESSION["activityID"];
    // $activityID = 1;

    $query = doThis("INSERT INTO `vendoractivityschedule`(`activityID`, `activityDurationDays`, `activityDurationNights`, `activityStartTime`, `activityEndTime`, `maximumCapacity`, `activityRepeatStatus`, `listingStartDate`, `listingSpotsAvailability`) VALUES ('$activityID', '$activityDurationDays', '$activityDurationNights', '$activityStartTime', '$activityEndTime', '$maximumCapacity', '$activityRepeatStatus', '$listingStartDate', '$listingSpotsAvailability')");
    if ($query) {
        $update = doThis("UPDATE `vendoractivities` SET `activityType`='2',`updatedAt`= CURRENT_TIMESTAMP(),`pageAt`='1' WHERE `id`='$activityID'");
        $_SESSION["multidayActivitySchedule"] = $query;

        if (isset($_POST["submit"])) {
?>
            <script>
                alert("One step more down!!");
                window.location = "../../activityIntermediate.php";
            </script>
        <?php
        } elseif ($_POST["submit1"]) {
            unset($_SESSION["activityID"]);
        ?>
            <script>
                window.location = "../../dashboard.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("There is some technical error!!");
            window.location = "../../activity1.php";
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../activity1.php";
    </script>
<?php
}
?>
