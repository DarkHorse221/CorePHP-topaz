<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
$templateArray['{website_loc}'] = WEBSITE_LOC; $templateArray['{website_ref}'] = WEBSITE_REF; $templateArray['{website_img}'] = WEBSITE_LOC.IMAGES_DIR; $templateArray['{website_scripts}'] = WEBSITE_LOC.SCRIPTS_DIR;
$templateArray['{system_version}'] = SYSTEM_VERSION; $templateArray['{system_version_info}'] = SYSTEM_VERSION_INFO;

//define system settings as moved away from constants
define('DISP_ROWS', systemSettingsValue(13)); 
define('DISP_ROWS_LAUNCH', systemSettingsValue(14)); 
define('PAGE_LIMIT', systemSettingsValue(15)); 
define('SEARCH_ROWS', systemSettingsValue(16)); 
define('TIME_OUT_DELAY', systemSettingsValue(17));
define('DAYS_FOR_CPE_RECORDING', systemSettingsValue(18)); 
define('EXCEPTIONS_LIST', systemSettingsValue(19)); 
define('DEBUG',systemSettingsValue(20));
define('DEBUG_MODE_FORM_BUILDER',systemSettingsValue(21));
?>