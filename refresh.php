<?php

session_start();
$_SESSION['userID'] = 0;
$_SESSION['image'] = "./Images/default_profile.png";
header('Location: index.php');

?>