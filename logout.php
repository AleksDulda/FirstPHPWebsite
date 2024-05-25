<?php
session_start();
// Oturum sonlandırma
session_destroy();
header("Location: index.php");
exit();
?>
