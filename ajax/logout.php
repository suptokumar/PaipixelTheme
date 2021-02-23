<?php 
session_start();
while (isset($_SESSION['login_data_paipixel24'])) {
unset($_SESSION['login_data_paipixel24']);
}
header("Location: ../");
?>