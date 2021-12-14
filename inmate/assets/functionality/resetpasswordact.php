<?php
include "../fxn.php";
$id = $_SESSION['VID'];
$oldPassword = e_d('e', $_POST['oldPassword']);
$newPassword = e_d('e', $_POST['newPassword']);
$confirmNewPassword = e_d('e', $_POST['confirmNewPassword']);


if (isset($_POST['submit'])) {
  $result = getThis("SELECT `password` FROM `vendor` WHERE `id`='$id'");
  $result = $result[0];
  if ($oldPassword == $result['password']) {
    if ($newPassword == $confirmNewPassword) {
      $id = doThis("UPDATE `vendor` SET `password`='$newPassword',`updatedAt`=CURRENT_TIMESTAMP() WHERE `id`='$id'");
      if ($id) {
?>
        <script>
          alert("PASSWORD UPDATED!!");
          window.location = "../../resetpassword.php";
        </script>
      <?php
      } else {
      ?>
        <script>
          alert("THERE IS SOME ERROR!! PLEASE TRY AGAIN!!");
          window.location = '../../resetpassword.php';
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        alert("THE NEW PASSWORD AND CONFIRM DID NOT MATCH!! TRY AGAIN!!");
        window.location = '../../resetpassword.php';
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("THE OLD PASSWORD DID NOT MATCH!! TRY AGAIN!!");
      window.location = '../../resetpassword.php';
    </script>
<?php
  }
}

?>
