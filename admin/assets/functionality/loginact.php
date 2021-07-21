<?php
include "../fxn.php";
$emailAddress = e_d('e', $_POST["emailAddress"]);
$password = e_d('e', $_POST["password"]);
$login = getThis("SELECT * FROM `admindetails` WHERE `emailAddress`='$emailAddress' AND `password`='$password' AND `enabled`='1'");

if (sizeof($login) > 0) {
  $login = $login[0];
  $id = $login["id"];
  $_SESSION["UID"] = $login["id"];
  $_SESSION["emailAddress"] = $login["emailAddress"];
  $_SESSION["phoneNumber"] = $login["phoneNumber"];
  $_SESSION["firstName"] = $login["firstName"];
  $_SESSION["lastName"] = $login["lastName"];
  doThis("UPDATE `admindetails` SET `lastLoginAt`=CURRENT_TIMESTAMP() WHERE `id`='$id'");
?>
  <script type="text/javascript">
    window.location = '../../index.php';
  </script>
<?php
} else {
?>
  <script type="text/javascript">
    alert('LOGIN FAILED!! TRY AGAIN!!');
    window.location = '../../index.php';
  </script>
<?php
}
?>