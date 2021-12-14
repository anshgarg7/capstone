<?php
include "../fxn.php";
$emailAddress = e_d('e', $_POST["emailAddress"]);
// echo $emailAddress;
$login = getThis("SELECT * FROM `vendor` WHERE `vendorEmailAddress`='$emailAddress'");
if (sizeof($login) > 0) {
  $login = $login[0];
  if ($login["enabled"] == '0') {
    // echo "1";
?>
    <script type="text/javascript">
      alert("YOUR ACCOUNT IS DISABLED!! PLEASE CONTACT THE TEAM!!");
      window.location = '../../index.php';
    </script>
  <?php
  } else {
    // echo "2";
    $_SESSION["emailAddress"] = $_POST["emailAddress"];
  ?>
    <script type="text/javascript">
      alert("EMAIL ADDRESS ALREADY EXISTS!! PLEASE LOGIN!!");
      window.location = '../../login.php';
    </script>
  <?php
  }
} else {
  // echo "3";
  ?>
  <?php
  $_SESSION["emailAddress"] = $_POST["emailAddress"]; ?>
  <script type="text/javascript">
    window.location = '../../register.php';
  </script>
<?php
}
?>
