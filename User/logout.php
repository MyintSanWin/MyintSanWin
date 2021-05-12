<?php
session_start();
// session_destroy();
unset($_SESSION['email']); 
echo '<script language="javascript">window.location.href="index.php";</script>';
?>