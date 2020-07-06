<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
if(SERVER_PATH_DB) {
	$conf = parse_ini_file(SERVER_PATH_DB); 
} else {
	$conf = parse_ini_file(SERVER_PATH."_conf/db.ini"); 	
}
define('DB_HOST', $conf['dbHost']); define('DB_USER', $conf['dbUser']); define('DB_PASSWORD', $conf['dbPassword']); define('DB_NAME', $conf['dbName']);	
function sql($sql) { global $conn; $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno($conn)) { $error = "Failed to connect to MySQL: " . mysqli_connect_error(); echo $error; logError($error, "db");}
$q = mysqli_query($conn,"$sql") or mysqli_error(); return $q; }
?>