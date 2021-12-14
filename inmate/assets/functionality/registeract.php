<?php
include "../fxn.php";
$firstName = e_d('e', $_POST['firstName']);
$lastName = e_d('e', $_POST['lastName']);
$phoneNumber = e_d('e', $_POST['phoneNumber']);
$password = e_d('e', $_POST['password']);
$emailAddress = e_d('e', $_POST['emailAddress']);
if (isset($_POST['submit'])) {
    $id = doThis("INSERT INTO `admindetails`(`firstName`, `lastName`, `emailAddress`, `phoneNumber`, `username`, `password`, `generatedAt`)  VALUES ('$firstName','$lastName','$emailAddress','$phoneNumber','$emailAddress','$password',CURRENT_TIMESTAMP())");
    if (isset($id)!=null) {
?>
      <script>
        alert("Registration Succesfull");
        window.location = 'index.php';
      </script>
    <?php
    }
  } else {
    ?>
    <script>
      alert("Error Please try again");
      window.location = '../../register.php';
    </script>
<?php
  }


?>
