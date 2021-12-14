<?php include "../fxn.php";

if (isset($_POST["submit"]) || isset($_POST["submit1"])) {
    $activityDuration = $_POST["activityDuration"];

    $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $activityDuration);

    sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

    $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

    $activityID = $_SESSION["activityID"];
    $activityStartTime = $_POST["activityStartTime"];
    $maximumCapacityDaily = $_POST["maximumCapacityDaily"];
    $maximumCapacityPerAppointment = $_POST["maximumCapacityPerAppointment"];
    // $activityMeetingPointAddressLine1 = $_POST["activityMeetingPointAddressLine1"];
    // $activityMeetingPointAddressLine2 = $_POST["activityMeetingPointAddressLine2"];
    // $activityMeetingPointCityID = $_POST["activityMeetingPointCityID"];
    // $activityMeetingPointStateID = $_POST["activityMeetingPointStateID"];
    // $activityMeetingPointCountryID = $_POST["activityMeetingPointStateID"];
    $activityItinerary = $_POST["activityItinerary"];
    $listingStartDate = $_POST["startingDate"];
    $listingEndDate = $_POST["endingDate"];
    $test = array();


    for ($i = 0; $i < sizeof($listingStartDate); $i++) {
        $start = $listingStartDate[$i];
        $end = $listingEndDate[$i];

        for ($x = $start; $x <= $end; $x = date('Y-m-d', strtotime('+1 day', strtotime($x)))) {
            $num = $maximumCapacityDaily / $maximumCapacityPerAppointment;
            for ($y = $activityStartTime, $count = 0; $count < $num; $count++) {
                $test[$x . " " . strftime('%H:%M', (strtotime($y) + ($count * $time_seconds)))] = $maximumCapacityPerAppointment;
                doThis("");
            }
        }
    }
    $activitySlots = serialize($test);
    $activitySlots = e_d('e', $activitySlots);
    $activityStartTime = e_d('e', $activityStartTime);
    $maximumCapacityDaily = e_d('e', $maximumCapacityDaily);
    $maximumCapacityPerAppointment = e_d('e', $maximumCapacityPerAppointment);
    // $activityMeetingPointAddressLine1 = e_d('e', $activityMeetingPointAddressLine1);
    // $activityMeetingPointAddressLine2 = e_d('e', $activityMeetingPointAddressLine2);
    $activityItinerary = e_d('e', $activityItinerary);
    $listingStartDate = e_d('e', serialize($listingStartDate));
    $listingEndDate = e_d('e', serialize($listingEndDate));
    $activityDuration = e_d('e', $activityDuration);
    $query = doThis("INSERT INTO `vendoractivityschedule`(`activityID`, `singleDayActivityDuration`, `singleDayActivityStartTime`, `singleDayMaximumCapacityDaily`, `singleDayMaximumCapacityPerAppointment`,  `singleDayActivityItinerary`, `singleDayListingStartDate`, `singleDayListingEndDate`, `singleDayActivitySlots`)
    VALUES('$activityID', '$activityDuration', '$activityStartTime', '$maximumCapacityDaily', '$maximumCapacityPerAppointment',  '$activityItinerary', '$listingStartDate', '$listingEndDate', '$activitySlots')");

    if ($query) {
        $update = doThis("UPDATE `vendoractivities` SET `activityType`='1',`updatedAt`= CURRENT_TIMESTAMP(),`pageAt`='1' WHERE `id`='$activityID'");
        if (isset($_POST["submit"])) {
?>
            <script>
                alert("One step more down!!");
                window.location = "../../activity2.php";
            </script>
        <?php
        } elseif (isset($_POST["submit1"])) {
            unset($_SESSION["activityID"]);
        ?>
            <script>
                alert("One step more down!!");
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
    // echo "not done";
    ?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../activity1.php";
    </script>
<?php
}
