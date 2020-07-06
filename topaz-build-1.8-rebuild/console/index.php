<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1); set_exception_handler('exception_handler'); define('TOPAZ', true); session_start(); $sid = session_id();
include('../_constants/constants.php'); include('../_constants/db.php'); include('../_functions/strings.php'); include('../_functions/requests.php'); include('../_functions/PasswordHash.php'); include('../_modules/standard_arrays.php'); @include('../licence.php');
/*DO NOT REMOVE*/
if($C486546D00135D233F8ABC394F85079E86605DA2) {
	if($DF6FECA66C3F1BF288B1173F7B3A305786A5483F == 'z2/spmw/G/KIsRc/ezowV4alSD8=') { //auth ok
		$date_now = new DateTime('now'); $date_now = $date_now->format('Y-m-d'); 
		$date_exp = new DateTime($C486546D00135D233F8ABC394F85079E86605DA2); $date_exp = $date_exp->format('Y-m-d');
		if($date_exp <= $date_now) { define('D4600135D233F_LOCKOUT','1'); } else { define('D4600135D233F_LOCKOUT','0'); }
	} else { $error = true; $err_msg .= '<p>Licence Key Authentication Failed. Please contact Innovative Informatics for support.</p>'; }
} else { $error = true; $err_msg .= '<p>Licence Key Authentication Failed. Please contact Innovative Informatics for support.</p>'; } 
/*DO NOT REMOVE*/

$uid = userID($sid); if(!userAuthorise($sid) && !($_GET['t'] == 'login')) { $t = "login";  logOff($uid,$sid); }
if($uid && !userSystemRights($uid, "gen_admin") && !($_GET['t'] == 'login')) { $t = "login"; logOff($uid,$sid); $err[] = sysMsg(17); }
if(!$t) { $t = cleanInput($_GET['t']); } if(!$t) { $t = 'launch'; }
$q_mod = sql("SELECT `id` FROM `system_modules` WHERE `link` = '".$t."' AND `tid` = '7' AND `active` = '1'");
$c_mod = mysqli_num_rows($q_mod);
if(!$c_mod) { $error = true; $err_msg = sysMsg('12');	logError("The page: ".$lvl1." was not found. ".$err_msg); } else { //get other common variables
if(!file_exists(SERVER_PATH."console/".$t."/template.html")) { $error = true; $err_msg = sysMsg('11'); }
if(!file_exists($t."/module.php")) { $error = true; $err_msg = sysMsg('11'); } $r_mod = mysqli_fetch_assoc($q_mod);	$mod_id = $r_mod['id'];
}
if($error) { $t = "error"; }
include_once("header/header.php"); include_once($t."/module.php"); include_once("footer/footer.php");
if($templateForward) {
	$t = "forward";
	if($templateForward == "static") { $templateContent = SERVER_PATH."console/".$t."/static.html";
	} else { $templateContent = SERVER_PATH."console/".$t."/forward.html"; $templateArray['{link}'] = WEBSITE_LOC.$templateForward; }	
} else { $templateForward == false; $templateArray['{link}'] = WEBSITE_LOC; }
//create content
$templateHeader = SERVER_PATH."console/header/template.html"; if(!$templateContent) { $templateContent = SERVER_PATH."console/".$t."/template.html"; }
$templateFooter = SERVER_PATH."console/footer/template.html";
//Replace strings in the templates
$headerContent = replaceTemplate($header, $templateHeader); $mainContent = replaceTemplate($templateArray, $templateContent); $footerContent = replaceTemplate($footer, $templateFooter);
//Display the HTML
echo $headerContent; echo $mainContent; echo $footerContent;
function exception_handler($exception) {  echo "Exception cached : " , $exception->getMessage(), ""; }
?>