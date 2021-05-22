<?php
include "../fxn.php";
$emailAddress = e_d('e', $_POST["emailAddress"]);
$password = e_d('e', $_POST["password"]);
$login = getThis("SELECT * FROM `vendor` WHERE `vendorEmailAddress`='$emailAddress' AND `password`='$password' AND `enabled`='1'");
$login = $login[0];

if (isset($login["id"])) {
  $id = $login["id"];
  $_SESSION["VID"] = $login["id"];
  $_SESSION["vendorEmailAddress"] = $login["vendorEmailAddress"];
  $_SESSION["vendorPhoneNumber"] = $login["vendorPhoneNumber"];
  $_SESSION["vendorFirstName"] = $login["vendorFirstName"];
  $_SESSION["vendorLastName"] = $login["vendorLastName"];
  $_SESSION["companyName"] = $login["companyName"];
  $_SESSION["pageAt"] = $login["pageAt"];
  doThis("UPDATE `vendor` SET `lastLoginAt`=CURRENT_TIMESTAMP() WHERE `id`='$id'");
  if ($login["pageAt"] == '1') {
?>
    <script type="text/javascript">
      window.location = '../../register1.php';
    </script>
  <?php
  } elseif ($login["pageAt"] == '2') {
  ?>
    <script type="text/javascript">
      window.location = '../../register2.php';
    </script>
  <?php
  } elseif ($login["pageAt"] == '3') {
  ?>
    <script type="text/javascript">
      window.location = '../../dashboard.php';
    </script>
  <?php
  }
  ?>
<?php
} else {
?>
  <script type="text/javascript">
    alert('LOGIN FAILED!! TRY AGAIN!!');
    window.location = '../../login.php';
  </script>
<?php
}
?>
