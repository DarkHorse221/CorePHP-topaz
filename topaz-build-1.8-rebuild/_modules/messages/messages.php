<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }

list($fhead, $fend) = drawFormTags('p', WEBSITE_REF.'?p=messages');
$templateArray['{fhead}'] = $fhead; $templateArray['{fend}'] = $fend;

if(!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
?>