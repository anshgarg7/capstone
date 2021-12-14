<?php
include "../fxn.php";
if (isset($_POST['submit'])) {

    // File upload configuration
    $activityId = $_POST["activityIDs"];
    $activityLicense = array();
    $instructor = array();
    $instructorLicense = array();
    for ($i = 0; $i < sizeof($activityId); $i++) {
        array_push($activityLicense, $_POST["licenseExists" . ($i + 1)]);
        array_push($instructor, $_POST["instructorExists" . ($i + 1)]);
        array_push($instructorLicense, $_POST["instructorLicenseExists" . ($i + 1)]);
    }

    $images = array();
    $targetDir = "../uploads/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);
    if (!empty($fileNames)) {
        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    $insertValuesSQL = "../uploads/" . $fileName . "";
                    array_push($images, $insertValuesSQL);
                    // echo ($insertValuesSQL) . "<br>";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }

        if (!empty($insertValuesSQL)) {


            $res = "";
            for ($i = 0; $i < sizeof($activityId); $i++) {
                $actLicense = $activityLicense[$i];
                $activityDoc = e_d('e', $images[$i]);
                $activity = $activityId[$i];
                $instruct = $instructor[$i];
                $instLicense = $instructorLicense[$i];

                $res .= doThis("UPDATE `vendoractivities` SET `activityLicenseStatus`='$actLicense',`activityLicenseImageLink`= '$activityDoc',`activityInstructorStatus`= '$instruct',`activityInstructorLicenseStatus`= '$instLicense', `updatedAt`=CURRENT_TIMESTAMP() WHERE `id`='$activity'");
            }

            // $insertValuesSQL = trim($insertValuesSQL, ',');
            // Insert image file name into database
            // $insert = $db->query("INSERT INTO images (file_name, uploaded_on) VALUES $insertValuesSQL");
            if ($res) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                // $statusMsg = "Files are uploaded successfully." . $errorMsg;
?>
                <script>
                    alert("Images uploaded!!");
                    window.location = "../../dashboard.php";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Sorry, there was an error uploading your file.");
                    window.location = "../../dashboard.php";
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            alert("Please select a file to upload.");
            window.location = "../../dashboard.php";
        </script>
<?php
        // $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    // echo $statusMsg;
}
?>
