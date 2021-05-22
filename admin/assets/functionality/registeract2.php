<?php
include "../fxn.php";
$id = $_SESSION['VID'];

$options = $_POST['options'];
$options1 = $_POST['options1'];
$options2 = $_POST['options2'];
$options3 = $_POST['options3'];

$businessWebsiteLink = NULL;
$googleBusinessPageLink = NULL;
$googleCoordinates = NULL;
$otherPlatforms = NULL;

if ($options == "1") {
  $businessWebsiteLink = e_d('e', $_POST['businessWebsiteLink']);
}
if ($options1 == "3") {
  $googleBusinessPageLink = e_d('e', $_POST['googleBusinessPageLink']);
}
if ($options2 == "5") {
  $googleCoordinates = e_d('e', $_POST['googleCoordinates']);
}
if ($options3 == "7") {
  $otherPlatforms = e_d('e', $_POST['otherPlatforms']);
}

if (isset($_POST['submit'])) {
  $id = doThis("UPDATE `vendor` SET `businessWebsiteLink`='$businessWebsiteLink',`googleCoordinates`='$googleCoordinates',`googleBusinessPageLink`='$googleBusinessPageLink',`otherPlatforms`='$otherPlatforms',`pageAt`='3' WHERE `id`='$id'");

  if ($id) {
    $_SESSION["pageAt"] = '3';
?>
    <script>
      alert("PROCESS COMPLETED!!");
      window.location = "../../dashboard.php";
    </script>
  <?php
  } else {
  ?>
    <script>
      alert("THERE IS SOME ERROR!! PLEASE TRY AGAIN!!");
      window.location = '../../logout.php';
    </script>
<?php
  }
}



?>
