<?php define('TOPAZ', true);
include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
$uid = cleanInput($_POST['id']); $value = cleanInput($_POST['value']); session_regenerate_id(); session_start(); 
unset($_SESSION['dialog-warning']); $_SESSION['dialog-warning'] = $value; session_write_close(); $new_sid = session_id();logSession($uid, $new_sid);
?>