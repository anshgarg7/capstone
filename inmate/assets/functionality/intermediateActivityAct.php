<?php
include "../fxn.php";

if (isset($_POST["submit"]) || isset($_POST["submit1"])) {
    $activityItinerary = $_POST["activityItinerary"];
    $activityItinerary = e_d('e', serialize($activityItinerary));
    $scheduleID = $_SESSION["multidayActivitySchedule"];
    $res = doThis("UPDATE `vendormultidayactivityschedule` SET `activityItinerary`= '$activityItinerary' WHERE `id`='$scheduleID'");
    if ($res && isset($_POST["submit"])) {
?>
        <script>
            alert("Thank you very much please keep going.");
            window.location = "../../activity2.php";
        </script>
    <?php
    } elseif ($res && isset($_POST["submit1"])) {
        unset($_SESSION["activityID"]);
    ?>
        <script>
            window.location = "../../dashboard.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("There is some technical error!!");
            window.location = "../activity1.php";
        </script>
<?php
    }
}

?>
