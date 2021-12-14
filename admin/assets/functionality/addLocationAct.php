<?php include "../fxn.php";

$locationName = e_d('e', $_POST["locationName"]);
$locationLogin = e_d('e', $_POST["locationLogin"]);
$password = e_d('e', $_POST["password"]);
$jailID = 1;   //to be changed when jail jailor mapping is added

$res = doThis("INSERT INTO `locationdetails`(`jailId`, `name`, `username`, `password`) VALUES  ('$jailID', '$locationName', '$locationLogin', '$password')");
if ($res) {
?>
    <script>
        alert("Location Registered!");
        window.location = "../../locationmanagement.php";
    </script>
<?php
} else {
?>
    <script>
        alert("There is some technical error!!");
        window.location = "../../dashboard.php";
    </script>
<?php
}
?>