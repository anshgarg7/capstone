<?php
include "../fxn.php";
$id = $_SESSION['VID'];
$accountHolder = e_d('e', $_POST['accountHolder']);
$bankName = e_d('e', $_POST['bankName']);
$accountNumber = e_d('e', $_POST['accountNumber']);
$confirmAccountNumber = e_d('e', $_POST['confirmAccountNumber']);
$IFSCCode = e_d('e', $_POST['IFSCCode']);

$paytmNumber = e_d('e', $_POST['paytmNumber']);
$googlePayUPIID = e_d('e', $_POST['googlePayUPIID']);
$bhimUPIID = e_d('e', $_POST['bhimUPIID']);


if (isset($_POST['submit'])) {
  if ($accountNumber == $confirmAccountNumber) {
    $id = doThis("UPDATE `vendorbankdetails` SET `accountHolder`='$accountHolder',`bankName`='$bankName',`accountNumber`='$accountNumber',`IFSCCode`='$IFSCCode',`paytmNumber`='$paytmNumber',`googlePayUPIID`='$googlePayUPIID',`bhimUPIID`='$bhimUPIID',`updatedAt`=CURRENT_TIMESTAMP(),`enabled`='1' WHERE `vendorID`='$id'");
    if ($id) {
?>
      <script>
        alert("BANK DETAILS UPDATED!!");
        window.location = "../../bankdetails.php";
      </script>
    <?php
    } else {
    ?>
      <script>
        alert("THERE IS SOME ERROR!! PLEASE TRY AGAIN!!");
        window.location = '../../bankdetails.php';
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("THE ACCOUNT NUMBER AND CONFIRM DID NOT MATCH!! TRY AGAIN!!");
      window.location = '../../bankdetails.php';
    </script>
<?php
  }
}

?>
