<?php
session_start();
session_destroy();
header("LOCATION:Login.php");
?>