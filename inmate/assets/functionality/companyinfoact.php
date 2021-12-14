<?php
include "../fxn.php";
$id = $_SESSION['VID'];
$companyName = e_d('e', $_POST['companyName']);

$companyAddressLine1 = e_d('e', $_POST['companyAddressLine1']);
$companyAddressLine2 = e_d('e', $_POST['companyAddressLine2']);
$companyAddressCityID = $_POST['companyAddressCityID'];
$companyAddressStateID = $_POST['companyAddressStateID'];
$companyAddressCountryID = $_POST['companyAddressCountryID'];

$fieldAddressLine1 = e_d('e', $_POST['fieldAddressLine1']);
$fieldAddressLine2 = e_d('e', $_POST['fieldAddressLine2']);
$fieldAddressCityID = $_POST['fieldAddressCityID'];
$fieldAddressStateID = $_POST['fieldAddressStateID'];
$fieldAddressCountryID = $_POST['fieldAddressCountryID'];

$inchargeFirstName = e_d('e', $_POST['inchargeFirstName']);
$inchargeLastName = e_d('e', $_POST['inchargeLastName']);
$inchargePosition = e_d('e', $_POST['inchargePosition']);
$inchargePhoneNumber = e_d('e', $_POST['inchargePhoneNumber']);
$inchargeEmailAddress = e_d('e', $_POST['inchargeEmailAddress']);
$phoneNumber1 = e_d('e', $_POST['phoneNumber1']);
$phoneNumber2 = e_d('e', $_POST['phoneNumber2']);
$companyEmailAddress = e_d('e', $_POST['companyEmailAddress']);

$businessWebsiteLink = e_d('e', $_POST['businessWebsiteLink']);
$googleCoordinates = e_d('e', $_POST['googleCoordinates']);
$googleBusinessPageLink = e_d('e', $_POST['googleBusinessPageLink']);
$otherPlatforms = e_d('e', $_POST['otherPlatforms']);


if (isset($_POST['submit'])) {
  $fieldOffice = doThis("UPDATE `vendorfieldoffice` SET `fieldAddressLine1`='$fieldAddressLine1',`fieldAddressLine2`='$fieldAddressLine2',`fieldAddressCityID`='$fieldAddressCityID',`fieldAddressStateID`='$fieldAddressStateID',`fieldAddressCountryID`='$fieldAddressCountryID',`updatedAt`=CURRENT_TIMESTAMP() WHERE `vendorID`='$id'");
  $companyOffice = doThis("UPDATE `vendorcompanyoffice` SET `companyAddressLine1`='$companyAddressLine1',`companyAddressLine2`='$companyAddressLine2',`companyAddressCityID`='$companyAddressCityID',`companyAddressStateID`='$companyAddressStateID',`companyAddressCountryID`='$companyAddressCountryID',`updatedAt`=CURRENT_TIMESTAMP() WHERE `vendorID`='$id'");
  $contactInfo = doThis("UPDATE `vendorcontactinfo` SET `companyDocumentLink`= '',`inchargeFirstName`='$inchargeFirstName',`inchargeLastName`='$inchargeLastName',`inchargePosition`='$inchargePosition',`inchargePhoneNumber`='$inchargePhoneNumber',`inchargeEmailAddress`='$inchargeEmailAddress',`inchargeDocumentLink`='[value-9]',`phoneNumber1`='$phoneNumber1',`phoneNumber2`='$phoneNumber2',`companyEmailAddress`='$companyEmailAddress',`updatedAt`=CURRENT_TIMESTAMP() WHERE `vendorID`='$id'");
  $id = doThis("UPDATE `vendor` SET `companyName`='$companyName',`businessWebsiteLink`='$businessWebsiteLink',`googleCoordinates`='$googleCoordinates',`googleBusinessPageLink`='$googleBusinessPageLink',`otherPlatforms`='$otherPlatforms' WHERE `id`='$id'");
  if ($id) {
?>
    <script>
      alert("COMPANY INFO UPDATED!!");
      window.location = "../../companyinfo.php";
    </script>
  <?php
  } else {
  ?>
    <script>
      alert("THERE IS SOME ERROR!! PLEASE TRY AGAIN!!");
      window.location = '../../companyinfo.php';
    </script>
<?php
  }
}

?>
