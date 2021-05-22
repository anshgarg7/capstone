<?php
include "../fxn.php";
$firstName = e_d('e', $_POST['firstName']);
$lastName = e_d('e', $_POST['lastName']);
$phoneNumber = e_d('e', $_POST['phoneNumber']);
$password = e_d('e', $_POST['password']);
$emailAddress = e_d('e', $_SESSION['emailAddress']);
$confirmPassword = e_d('e', $_POST["confirmPassword"]);
$vendorUniqueID = strtoupper(substr(md5($id . "-/#" . time() . "-/#" . rand(0, 99999)), 0, 8));

if (isset($_POST['submit'])) {

  if ($password == $confirmPassword) {
    $id = doThis("INSERT INTO `vendor`(`vendorUniqueID`, `vendorFirstName`, `vendorLastName`, `vendorPhoneNumber`, `vendorEmailAddress`, `password`, `pageAt`, `enabled`) VALUES ('$vendorUniqueID','$firstName','$lastName','$phoneNumber','$emailAddress','$password','1','1')");
    $_SESSION["UID"] = $id;
    if ($id) {
?>
      <script>
        alert("THANKS FOR REGISTRATION!! PLEASE PROCEED FURTHER!!");
        window.location = "../../register1.php";
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
  } else {
    ?>
    <script>
      alert("THE PASSWORDS DON'T MATCH!! PLEASE TRY AGAIN!!");
      window.location = '../../register.php';
    </script>
<?php
  }
}



?>
