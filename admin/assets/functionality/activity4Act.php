<?php
include "../fxn.php";

if (isset($_POST["submit"])) {
    // $instructorFirstName = $_POST["instructorFirstName"];
    // $instrutorLastName =  $_POST["instructorLastName"];
    // $instructorPhone =  $_POST["instructorPhone"];
    // $instructorEmail =  $_POST["instructorEmail"];
    // $instructorGender = $_POST["instructorGender"];
    // $instructorLicenseNumer = $_POST["instructorLicenseNumber"];
    $id = $_SESSION['VID'];
    $activityOutsourcing = $_POST["activityOutsourcing"];
    $activityReviewWebpageLinks = e_d('e', serialize($_POST["activityReviewWebpageLinks"]));
    $activityComment = e_d('e', $_POST["activityComments"]);
    $activityID = $_SESSION["activityID"];
    //$activityID = 11;

    // for ($i = 0; $i < sizeof($instructorFirstName); $i++) {
    //     $firstName = e_d('e', $instructorFirstName[$i]);
    //     $lastName = e_d('e', $instrutorLastName[$i]);
    //     $phone = e_d('e', $instructorPhone[$i]);
    //     $email = e_d('e', $instructorEmail[$i]);
    //     $gender = e_d('e', $instructorGender[$i]);
    //     $license = e_d('e', $instructorLicenseNumer[$i]);
    //     $res = doThis("INSERT INTO `vendoractivityinstructors`(`vendorID`,`firstName`, `lastName`, `phoneNumber`, `emailAddress`, `licenseNumber`,`gender`) VALUES ('$id','$firstName', '$lastName', '$phone', '$email', '$license','$gender')");
    //     $result = doThis("INSERT INTO `vendoractivityinstructormapping`(`activityID`, `instructorID`) VALUES ('$activityID','$res')");
    // }

    $temp = doThis("UPDATE `vendoractivities` SET `activityOutsourcing`='$activityOutsourcing',`activityReviewWebpageLinks`='$activityReviewWebpageLinks',`activityComments`='$activityComment', `activityInstructorStatus`='1',`pageAt`='4' WHERE `id`='$activityID'");
    if ($temp) {
        unset($_SESSION["activityID"]);
?>
        <script>
            alert("Activity Registered Successfully!!");
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
