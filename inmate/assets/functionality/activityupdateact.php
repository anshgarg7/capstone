<?php
include "../fxn.php";

if (isset($_POST["submit"])) {
    $vendorID = $_SESSION["VID"];
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
    $activityCancellationPolicy = $_POST["activityCancellationPolicy"];
    $str_arr = explode(";", $activityCancellationPolicy);
    $activityCancellationPolicyLowerLimit = e_d('e', $str_arr[0]);
    $activityCancellationPolicyUpperLimit = e_d('e', $str_arr[1]);
    $activityOutsourcing = $_POST["activityOutsourcing"];
    $activityReviewWebpageLinks = e_d('e', serialize($_POST["activityReviewWebpageLinks"]));
    $activityComment = e_d('e', $_POST["activityComments"]);
    $activityID = $_POST["activityID"];
    $addOnID = $_POST["addOnID"];

    if ($activityReviewWebpageLinks == "3e3fef47c92e6ad3:bEd5NDV6eDE5RG0rS1JXcjUyNlFRbkpYbC9maG5TbDh4dmxTdURmWGh6QT0=") {
        $activityReviewWebpageLinks = NULL;
    }


    $unique = $_POST["unique"];


    $res0 = doThis("UPDATE `vendoractivities` SET `vendorID`='$vendorID', `activityCategoryID`='$activityCategoryID', `activityTitle`='$activityTitle', `pricePerPerson`='$pricePerPerson', `activityLevel`='$activityLevel', `activityAltitude`='$activityAltitude', `activityLanguages`='$activityLanguages', `ageUpperLimit`='$ageUpperLimit', `ageLowerLimit`='$ageLowerLimit', `activityHighlights`='$activityHighlights', `whatToTake`='$whatToTake', `services`='$services', `activityWarnings`='$activityWarnings', `activityMeetingPointAddressLine1`='$activityMeetingPointAddressLine1', `activityMeetingPointAddressLine2`='$activityMeetingPointAddressLine2', `activityMeetingPointCityID`='$activityMeetingPointCityID', `activityMeetingPointStateID`='$activityMeetingPointStateID', `activityMeetingPointCountryID`='$activityMeetingPointCountryID', `activityMeetingPointZipcode`='$activityMeetingPointZipcode',`activityCancellationPolicyLowerLimit`='$activityCancellationPolicyLowerLimit',`activityCancellationPolicyUpperLimit`='$activityCancellationPolicyUpperLimit',`activityOutsourcing`='$activityOutsourcing',`activityReviewWebpageLinks`='$activityReviewWebpageLinks',`activityComments`='$activityComment' WHERE 'activityID'='$activityID'");
    for ($i = 0; $i < sizeof($addOnName); $i++) {
        $singleAddOnName = e_d('e', $addOnName[$i]);
        $singleAddOnCharges = e_d('e', $addOnCharges[$i]);
        if ($i < sizeof($addOnID)) {
            $res9 = doThis("UPDATE `vendoractivitychargeableaddons` SET `addOnName`='$singleAddOnName', `addOnCharges`='$singleAddOnCharges'");
        } else {
            $res1 = doThis("INSERT INTO `vendoractivitychargeableaddons`(`activityID`, `addOnName`, `addOnCharges`) VALUES ('$activityID','$singleAddOnName','$singleAddOnCharges')");
        }
    }

    if ($unique == 1) {
        $activityDuration = $_POST["activityDuration"];

        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $activityDuration);

        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

        $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;


        $activityStartTime = $_POST["singleActivityStartTime"];
        $maximumCapacityDaily = $_POST["maximumCapacityDaily"];
        $maximumCapacityPerAppointment = $_POST["maximumCapacityPerAppointment"];
        $activityItinerary = $_POST["singleActivityItinerary"];
        $listingStartDate = $_POST["startingDate"];
        $listingEndDate = $_POST["endingDate"];
        $prevSlots = getThis("SELECT `id` FROM `vendoractivityslots` WHERE `activityID`='$activityID'");
        $j = 0;
        for ($i = 0; $i < sizeof($listingStartDate); $i++) {
            $start = $listingStartDate[$i];
            $end = $listingEndDate[$i];

            for ($x = $start; $x <= $end; $x = date('Y-m-d', strtotime('+1 day', strtotime($x)))) {
                $num = $maximumCapacityDaily / $maximumCapacityPerAppointment;
                for ($y = $activityStartTime, $count = 0; $count < $num; $count++) {
                    // $test[] = $maximumCapacityPerAppointment;
                    $slot = $x . " " . strftime('%H:%M', (strtotime($y) + ($count * $time_seconds)));
                    if ($j < sizeof($prevSlots)) {
                        $prevID = $prevSlots[$j]["id"];
                        $res2 = doThis("UPDATE `vendoractivityslots` SET `singleDaySlot`='$slot', `singleDaySlotAvailability`='$maximumCapacityPerAppointment' WHERE `id`='$prevID'");
                        $j++;
                    } else {
                        $res2 = doThis("INSERT INTO `vendoractivityslots`(`activityID`, `singleDaySlot`, `singleDaySlotAvailability`) VALUES ('$activityID', '$slot', '$maximumCapacityPerAppointment') ");
                    }
                }
            }
        }
        // $activitySlots = serialize($test);
        // $activitySlots = e_d('e', $activitySlots);
        $activityStartTime = e_d('e', $activityStartTime);
        $maximumCapacityDaily = e_d('e', $maximumCapacityDaily);
        $maximumCapacityPerAppointment = e_d('e', $maximumCapacityPerAppointment);
        $activityItinerary = e_d('e', $activityItinerary);
        $listingStartDate = e_d('e', serialize($listingStartDate));
        $listingEndDate = e_d('e', serialize($listingEndDate));
        $activityDuration = e_d('e', $activityDuration);

        // single day act
        $res3 = doThis("UPDATE `vendoractivityschedule` SET `singleDayActivityDuration`='$activityDuration', `singleDayActivityStartTime`='$activityStartTime', `singleDayMaximumCapacityDaily`='$maximumCapacityDaily', `singleDayMaximumCapacityPerAppointment`='$maximumCapacityPerAppointment',  `singleDayActivityItinerary`='$activityItinerary', `singleDayListingStartDate`='$listingStartDate', `singleDayListingEndDate`='$listingEndDate' WHERE `activityID`='$activityID'");
        $res4 = doThis("UPDATE `vendoractivities` SET `activityType`='1' WHERE `id`='$activityID'");
    } elseif ($unique == 2) {

        $activityDurationDays = $_POST["activityDurationDays"];
        $activityDurationNights = e_d('e', $activityDurationDays - 1);
        $activityDurationDays = e_d('e', $activityDurationDays);
        $activityStartTime = e_d('e', $_POST["activityStartTime"]);
        $activityEndTime = e_d('e', $_POST["activityEndTime"]);
        if (isset($_POST["activityRepeatStatus"])) {
            $activityRepeatStatus = '1';
        } else {
            $activityRepeatStatus = '0';
        }

        $listingStartDate = $_POST["listingStartDate"];
        // $listingStartDate = e_d('e', serialize($listingStartDate));
        $listingSpotsAvailability = $_POST["listingSpotsAvailability"];
        $maximumCapacity = max($listingSpotsAvailability);
        $activityItinerary = $_POST["activityItinerary"];
        $activityItinerary = e_d('e', serialize($activityItinerary));
        $prevSlots = getThis("SELECT `id` FROM `vendoractivityslots` WHERE `activityID`='$activityID'");
        for ($i = 0; $i < sizeof($listingSpotsAvailability); $i++) {
            $startDate = $listingStartDate[$i];
            $endDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
            $capactity = $listingSpotsAvailability[$i];
            if ($i < sizeof($prevSlots)) {
                $prevID = $prevSlots[$i]["id"];
                $temp = doThis("UPDATE `vendoractivityslots` SET  `multiDayStartDate`='$startDate', `multiDayEndDate`='$endDate', `multiDaySlotAvailability`='$capactity' WHERE `id`='$prevID'");
            } else {
                $temp = doThis("INSERT INTO `vendoractivityslots`(`activityID`, `multiDayStartDate`, `multiDayEndDate`, `multiDaySlotAvailability`) VALUES('$activityID', '$startDate', '$endDate', '$capactity')");
            }
        }
        $listingSpotsAvailability = e_d('e', serialize($listingSpotsAvailability));
        //   multi day act

        $res5 = doThis("UPDATE `vendoractivityschedule` SET `listingSpotsAvailability`='$listingSpotsAvailability', `activityDurationDays`='$activityDurationDays', `activityDurationNights`='$activityDurationNights', `activityStartTime`='$activityStartTime', `activityEndTime`='$activityEndTime', `maximumCapacity`='$maximumCapacity', `activityRepeatStatus`='$activityRepeatStatus', `activityItinerary`='$activityItinerary' WHERE `activityID`='$activityID'");
        $res6 = doThis("UPDATE `vendoractivities` SET `activityType`='2' WHERE `id`='$activityID'");
    }




    if (isset($_FILES)) {
        // image act
        $targetDir = "../../uploads/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        $fileNames = array_filter($_FILES['files']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path
                // $fileTmpPath = $_FILES['uploadedFile']['tmp_name'][$key];
                $fileName = basename($_FILES['files']['name'][$key]);
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = md5(time() . $fileNameCmps[0]) . '.' . $fileExtension;
                $targetFilePath = $targetDir . $newFileName;
                $res7 = 0;
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        // Image db insert sql
                        $insertValuesSQL = "../uploads/" . $newFileName;
                        $insertValuesSQL = e_d('e', $insertValuesSQL);
                        $x = doThis("INSERT INTO `vendoractivityimages`(`activityID`, `activityImageLink`) VALUES ('$activityID', '$insertValuesSQL')");
                        $res7 = $res7 + $x;
                        // echo $insertValuesSQL . "<br>";
                    } else {
                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                }
            }

            if (!empty($insertValuesSQL)) {
                // echo $insertValuesSQL;
                $insertValuesSQL = trim($insertValuesSQL, ',');
                // Insert image file name into database
                // $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");

                // echo $insertValuesSQL;
                if ($res7) {
                    $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                    $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                    $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                }
            }
        }

        // image act end
    }

    $res8 = doThis("UPDATE `vendoractivities` SET `enabled`='1' WHERE `id`='$activityID'");
?>

    <script>
        alert("Activity Registered!!");
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

?>
