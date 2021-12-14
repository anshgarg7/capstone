<?php
include "../fxn.php";
if (isset($_POST["submit1"])) {
    $activityID = $_POST["activityID"];
    $slotDate = $_POST["slotDate"];
    $slotValue = $_POST["slotValue"];
    $prevSlots = getThis("SELECT `id` FROM `vendoractivityslots` WHERE `activityID`='$activityID'");
    for ($i = 0; $i < sizeof($slotDate); $i++) {
        $date = date_create($slotDate[$i]);
        $temp =  date_format($date, "Y-m-d H:i:s");
        if ($i < sizeof($prevSlots)) {
            $prevID = $prevSlots[$i]["id"];
            $res = doThis("UPDATE `vendoractivityslots` SET `singleDaySlot`='$temp', `singleDaySlotAvailability`='$slotValue[$i]', `updatedAt`=CURRENT_TIMESTAMP() WHERE `id`='$prevID'");
        } else {
            $res = doThis("INSERT INTO `vendoractivityslots`(`activityID`,`singleDaySlot`, `singleDaySlotAvailability`) VALUES ('$activityID','$temp','$slotValue[$i]')");
        }
        // $final[$temp] = $slotValue[$i];
    }
    if (sizeof($prevSlots) > sizeof($slotDate)) {
        for ($i = sizeof($slotDate); $i < sizeof($prevSlots); $i++) {
            $prevID = $prevSlots[$i]["id"];
            $res = doThis("UPDATE `vendoractivityslots` SET `enabled`='0' WHERE `id`='$prevID'");
        }
    }
    if ($res) {
?>
        <script>
            alert("Time slots updated");
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
} else if (isset($_POST["submit2"])) {
    $listingStartDate = $_POST["listingStartDate"];
    $listingEndDate = $_POST["listingEndDate"];
    $listingSpotsAvailability = $_POST["listingSpotsAvailability"];
    $activityID = $_POST["activityID"];
    $prevSlots = getThis("SELECT `id` FROM `vendoractivityslots` WHERE `activityID`='$activityID'");

    for ($i = 0; $i < sizeof($listingSpotsAvailability); $i++) {
        $startDate = $listingStartDate[$i];
        $endDate = $listingEndDate[$i];
        $num = $listingSpotsAvailability[$i];
        if ($i < sizeof($prevSlots)) {
            $prevID = $prevSlots[$i]["id"];
            $res = doThis("UPDATE `vendoractivityslots` SET `multiDayStartDate`= '$startDate',`multiDayEndDate`= '$endDate' ,`multiDaySlotAvailability`= '$num', `updatedAt`=CURRENT_TIMESTAMP() WHERE `id`='$prevID'");
        } else {
            $res = doThis("INSERT INTO `vendoractivityslots` (`activityID`,`multiDayStartDate`,`multiDayEndDate`,`multiDaySlotAvailability`) VALUES ('$activityID','$startDate','$endDate', '$num')");
        }
    }

    if (sizeof($prevSlots) > sizeof($listingStartDate)) {
        for ($i = sizeof($listingStartDate); $i < sizeof($prevSlots); $i++) {
            $prevID = $prevSlots[$i]["id"];
            $res = doThis("UPDATE `vendoractivityslots` SET `enabled`='0' WHERE `id`='$prevID'");
        }
    }


    if ($res) {
    ?>
        <script>
            alert("Time slots updated");
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
}
?>
