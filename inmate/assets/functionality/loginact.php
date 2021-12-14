<?php
include "../fxn.php";
$username = e_d('e', $_POST["locationLogin"]);
$password = e_d('e', $_POST["password"]);
$jailID = '1';
$login = getThis("SELECT `id`, `name` FROM `locationdetails` WHERE `username`='$username' AND `password`='$password' AND `enabled`='1' AND `jailId`='$jailID'");

if (sizeof($login) > 0) {
  $login = $login[0];
  $id = $login["id"];
  $_SESSION["UID"] = $login["id"];
  $_SESSION["name"] = $login["name"];
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