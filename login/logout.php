<?php
session_start(); 
//menghapus session
session_destroy(); 
unset($_SESSION);
// redirect ke halaman login
header("Location: ../../halaman/index.php");


?>