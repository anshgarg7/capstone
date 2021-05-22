<?php
include "../fxn.php";
$id = $_SESSION['VID'];
$companyName = e_d('e', $_POST['companyName']);
$companyActivities = e_d('e', serialize($_POST['companyActivities']));
$companyAddressLine1 = e_d('e', $_POST['companyAddressLine1']);
$companyAddressLine2 = e_d('e', $_POST['companyAddressLine2']);
$companyAddressZipcode  = e_d('e', $_POST['companyAddressZipcode']);
$companyAddressCityID = $_POST['companyAddressCityID'];
$companyAddressStateID = $_POST['companyAddressStateID'];
$companyAddressCountryID = $_POST['companyAddressCountryID'];
$options = $_POST['options'];
if ($options == "same") {
  $fieldAddressLine1 = e_d('e', $_POST['companyAddressLine1']);
  $fieldAddressLine2 = e_d('e', $_POST['companyAddressLine2']);
  $fieldAddressZipcode  = e_d('e', $_POST['companyAddressZipcode']);
  $fieldAddressCityID = $_POST['companyAddressCityID'];
  $fieldAddressStateID = $_POST['companyAddressStateID'];
  $fieldAddressCountryID = $_POST['companyAddressCountryID'];
} else {
  $fieldAddressLine1 = e_d('e', $_POST['fieldAddressLine1']);
  $fieldAddressLine2 = e_d('e', $_POST['fieldAddressLine2']);
  $fieldAddressZipcode  = e_d('e', $_POST['fieldAddressZipcode']);
  $fieldAddressCityID = $_POST['fieldAddressCityID'];
  $fieldAddressStateID = $_POST['fieldAddressStateID'];
  $fieldAddressCountryID = $_POST['fieldAddressCountryID'];
}
if (isset($_POST['submit'])) {
  $fieldOffice = doThis("INSERT INTO `vendorfieldoffice`(`vendorID`, `fieldAddressLine1`, `fieldAddressLine2`, `fieldAddressCityID`, `fieldAddressStateID`, `fieldAddressCountryID`,`fieldAddressZipcode`, `generatedAt`, `enabled`) VALUES ('$id','$fieldAddressLine1','$fieldAddressLine2','$fieldAddressCityID','$fieldAddressStateID','$fieldAddressCountryID','$fieldAddressZipcode',CURRENT_TIMESTAMP(),'1')");
  $companyOffice = doThis("INSERT INTO `vendorcompanyoffice`(`vendorID`, `companyAddressLine1`, `companyAddressLine2`, `companyAddressCityID`, `companyAddressStateID`, `companyAddressCountryID`,`companyAddressZipcode` ,`generatedAt`, `enabled`) VALUES ('$id','$companyAddressLine1','$companyAddressLine2','$companyAddressCityID','$companyAddressStateID','$companyAddressCountryID','$companyAddressZipcode',CURRENT_TIMESTAMP(),'1')");
  $bank = doThis("INSERT INTO `vendorbankdetails`(`vendorID`) VALUES ('$id')");
  $companyinfo = doThis("INSERT INTO `vendorcontactinfo`(`vendorID`) VALUES ('$id')");
  $id = doThis("UPDATE `vendor` SET `companyName`='$companyName',`companyActivities`='$companyActivities',`pageAt`='2' WHERE `id`='$id'");
  if ($id) {
    $_SESSION["pageAt"] = '2';
?>
    <script>
      alert("JUST THERE!!");
      window.location = "../../register2.php";
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
