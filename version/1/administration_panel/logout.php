<?php
session_start();
session_destroy();
header("Location: http://jaweb.comze.com/administration_panel/index.php");
?>