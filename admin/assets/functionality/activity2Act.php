<?php
include "../fxn.php";

if (isset($_POST["submit"]) || isset($_POST["submit1"])) {
    $activityCancellationPolicy = $_POST["activityCancellationPolicy"];
    $str_arr = explode(";", $activityCancellationPolicy);
    $activityID = $_SESSION["activityID"];
    $activityCancellationPolicyLowerLimit = e_d('e', $str_arr[0]);
    $activityCancellationPolicyUpperLimit = e_d('e', $str_arr[1]);
    // $activityID = 11;
    $res = doThis("UPDATE `vendoractivities` SET `activityCancellationPolicyLowerLimit`='$activityCancellationPolicyLowerLimit',`activityCancellationPolicyUpperLimit`= '$activityCancellationPolicyUpperLimit',`pageAt`='2' WHERE  `id`='$activityID'");
    if ($res && isset($_POST["submit"])) {
?>
        <script>
            window.location = "../../activity3.php";
        </script>
    <?php
    } elseif ($res && isset($_POST["submit1"])) {
        unset($_SESSION["activityID"]);
    ?>
        <script>
            window.location = "../../dashboard.php";
        </script>
        }
        else {
        ?>
        <script>
            alert("There is some technical error!!");
            window.location = "../../activity1.php";
        </script>
<?php
    }
}
?>
