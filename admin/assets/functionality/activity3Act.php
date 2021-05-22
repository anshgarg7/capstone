<?php
include "../fxn.php";
if (isset($_POST['submit'])) {
    // Include the database configuration file
    // include_once 'dbConfig.php';

    // File upload configuration



    $activityID = $_SESSION["activityID"];
    // $activityID = 1;
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

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    $insertValuesSQL = "../uploads/" . $newFileName;
                    $insertValuesSQL = e_d('e', $insertValuesSQL);
                     $res = doThis("INSERT INTO `vendoractivityimages`(`activityID`, `activityImageLink`) VALUES ('$activityID', '$insertValuesSQL')");
                     if(isset($_POST['submit3'])){
                        $res1 = doThis("UPDATE `vendoractivities` SET `pageAt`='3' WHERE  `id`='$activityID'");
                     }

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
            $insert = 1;
            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                // $statusMsg = "Files are uploaded successfully." . $errorMsg;
                if(isset($_POST['submit'])){

?>
                <script>
                    alert("Images uploaded!!");
                    window.location = "../../activity3.php";
                </script>
            <?php
          }else{
            ?>
            <script>
                alert("Images uploaded!!");
                window.location = "../../activity4.php";
            </script>
            <?php
          }} else {
            ?>
                <script>
                    alert("Sorry, there was an error uploading your file.");
                    window.location = "../../activity3.php";
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            alert("Please select a file to upload.");
            window.location = "../../activity3.php";
        </script>
<?php
        // $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    // echo $statusMsg;
}elseif (isset($_POST['submit3'])) {
    // Include the database configuration file
    // include_once 'dbConfig.php';

    // File upload configuration



    $activityID = $_SESSION["activityID"];
    // $activityID = 1;
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

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    $insertValuesSQL = "../../uploads/" . $newFileName;
                    $insertValuesSQL = e_d('e', $insertValuesSQL);
                     $res = doThis("INSERT INTO `vendoractivityimages`(`activityID`, `activityImageLink`) VALUES ('$activityID', '$insertValuesSQL')");
                     if(isset($_POST['submit3'])){
                        $res1 = doThis("UPDATE `vendoractivities` SET `pageAt`='3' WHERE  `id`='$activityID'");
                     }

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
            $insert = 1;
            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                // $statusMsg = "Files are uploaded successfully." . $errorMsg;
                if(isset($_POST['submit'])){

?>
                <script>
                    alert("Images uploaded!!");
                    window.location = "../../activity3.php";
                </script>
            <?php
          }else{
            ?>
            <script>
                alert("Images uploaded!!");
                window.location = "../../activity4.php";
            </script>
            <?php
          }} else {
            ?>
                <script>
                    alert("Sorry, there was an error uploading your file.");
                    window.location = "../../activity3.php";
                </script>
        <?php
            }
        }
    } else {
      $res1 = doThis("UPDATE `vendoractivities` SET `pageAt`='3' WHERE  `id`='$activityID'");

        ?>
        <script>
        alert("Images uploaded!!");
            window.location = "../../activity3.php";
        </script>
<?php
        // $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    // echo $statusMsg;
}
?>
