<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
//set options
$o = cleanInput($_GET['o']);
if(!$o) { $o = "images"; }
$templateArray['{sect_head}'] = "Media Manager";
$sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=media-manager&o=files"><img src="'.WEBSITE_LOC.'console/_images/file.gif" class="img" /></a><a href="'.WEBSITE_LOC.'console/index.php?t=media-manager&o=images"><img src="'.WEBSITE_LOC.'console/_images/image.gif" class="img" /></a>';

if(!$templateArray['{sect_head_rt}']) { $templateArray['{sect_head_rt}'] = $sect_nav_ext; }
if(!$templateArray['{success}']) { $templateArray['{success}'] = writeMsgs($success, "success"); }
if(!$templateArray['{warning}']) { $templateArray['{warning}'] = writeMsgs($warning, "warning"); }
if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
$templateArray['{kcfinder-link}'] = WEBSITE_LOC.'console/_scripts/kcfinder/browse.php?type='.$o;

?>