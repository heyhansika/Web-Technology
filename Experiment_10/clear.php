<?php
session_start();
session_destroy();
setcookie("last_added", "", time() - 3600, "/");
header("Location: index.php");
?>