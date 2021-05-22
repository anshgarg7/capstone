<?php
include 'fxn.php';

if (isset($_POST["Country"])) {
  $temp_cid = $_POST["Country"];
  $result = getThis("SELECT `id`, `name` FROM `states` WHERE `country_id`=$temp_cid ORDER BY `name` ASC");
  // print_r($result);
  echo json_encode($result);
}


if (isset($_POST["State"])) {
  $temp_sid = $_POST["State"];
  $result = getThis("SELECT `id`, `name` FROM `cities` WHERE `state_id`=$temp_sid ORDER BY `name` ASC");
  echo json_encode($result);
}
