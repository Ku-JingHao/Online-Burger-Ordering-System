<?php

include("dataconnection.php");

session_start();
session_unset();
session_destroy();

header('location:administrator_login.php');

?>