<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1); set_exception_handler('exception_handler');
define('TOPAZ', true); session_start(); $sid = session_id();
include('_constants/constants.php');
include('_constants/db.php'); include('_functions/strings.php'); include('_functions/requests.php'); include('_modules/standard_arrays.php'); include('_functions/PasswordHash.php'); include('_functions/Pagination.class.php'); @include('licence.php');
//verify GUI mod
$q_mod = sql("SELECT `link`,`active` FROM `system_modules` ORDER BY `id` ASC"); $c_mod = mysqli_num_rows($q_mod);
if (!$c_mod) {
    $err[] = 'System Malfunction';
} else {
    while ($r_mod = mysqli_fetch_assoc($q_mod)) {
        $check_mod[''.$r_mod['link'].''] = $r_mod['active'];
    }
}
foreach ($mod as $k=>$v) {
    if (!($v == $check_mod[''.$k.''])) {
        $q_upd_mod = sql("UPDATE `system_modules` SET `active` = '".$v."' WHERE `link` = '".$k."'");
    }
}
//verify console mod
$q_cmod = sql("SELECT `link`,`active` FROM `system_modules` ORDER BY `id` ASC"); $c_cmod = mysqli_num_rows($q_cmod);
if (!$c_cmod) {
    $err[] = 'System Malfunction';
} else {
    while ($r_cmod = mysqli_fetch_assoc($q_cmod)) {
        $check_cmod[''.$r_cmod['link'].''] = $r_cmod['active'];
    }
}
foreach ($cmod as $k=>$v) {
    if (!($v == $check_cmod[''.$k.''])) {
        $q_upd_cmod = sql("UPDATE `system_modules` SET `active` = '".$v."' WHERE `link` = '".$k."'");
    }
}
//check levels
$lvl1 = strtolower(cleanString($_GET['p'])); $lvl2 = strtolower(cleanString($_GET['o'])); $lvl3 = strtolower(cleanString($_GET['v'])); if (!$lvl1) {
    $lvl1 = 'home';
}
$q_system = sql("SELECT `value` FROM `system_settings` WHERE `id` = '1'"); $r_system = mysqli_fetch_assoc($q_system);
if ($r_system['value'] == true) {
    $site_enable = true;
} else {
    $site_enable = false;
} $error = false;

/*DO NOT REMOVE*/
if ($C486546D00135D233F8ABC394F85079E86605DA2) {
    if (!($DF6FECA66C3F1BF288B1173F7B3A305786A5483F == 'z2/spmw/G/KIsRc/ezowV4alSD8=')) {
        $site_enable = false;
        $templateArray['{error}'] .= '<p>Licence Key Authentication Failed. Please contact Innovative Informatics for support.</p>';
    }
} else {
    $site_enable = false;
    $templateArray['{error}'] .= '<p>Licence Key Authentication Failed. Please contact Innovative Informatics for support.</p>';
}
/*DO NOT REMOVE*/

if ($site_enable) {
    //force logon
    if (systemSettings(12) && !userAuthorise($sid)) {
        if ($lvl1 != 'forgot-password') {
            $lvl1 = 'login';
            $header['{force-logins}'] = 'style="display:none;"';
        } else {
            $header['{force-logins}'] = 'style="display:none;"';
        }
    } else {
        $header['{force-logins}'] = '';
    }
    //continue
    $q_doc = sql("SELECT dp.did, dp.doc_type, dpe.text FROM document_properties dp, document_properties_ext dpe, document_tree dt WHERE dpe.did=dt.id AND dp.did=dt.id AND dp.link = '".$lvl1."' AND dp.active = '1'");
    $c_doc = mysqli_num_rows($q_doc);
    $q_mod = sql("SELECT `id` FROM `system_modules` WHERE `link` = '".$lvl1."' AND `tid` = '6' AND `active` = '1'");
    $c_mod = mysqli_num_rows($q_mod);
    if (!($c_doc || $c_mod)) {
        $error = true;
        $err_msg = sysMsg('3');
        $templateArray['{error}'] .= $err_msg;
        logError("The page: ".$lvl1." was not found. ".$err_msg);
    } else {
        if ($c_mod) {
            $template = $lvl1."/".$lvl1;
            $doc = $lvl1."/".$lvl1;
            $r_mod = mysqli_fetch_assoc($q_mod);
            $mod_id = $r_mod['id'];
        } else {
            $r_doc = mysqli_fetch_assoc($q_doc);
            $doc_id = $r_doc['did'];
            $text = $r_doc['text'];
            $dtype = $r_doc['doc_type'];
            $q_sys_temp = sql("SELECT st.link FROM system_templates st, system_templates_ext ste WHERE ste.stid=st.id AND ste.dtid= '".$dtype."'");
            $r_sys_temp = mysqli_fetch_assoc($q_sys_temp);
            $template = $r_sys_temp['link'];
            $doc = "array";
        }
    }
} else {
    if (($lvl1 == 'login') || ($lvl1 == 'logoff')) {
        $template = $lvl1."/".$lvl1;
        $doc = $lvl1."/".$lvl1;
    } else {
        $error = true;
        $templateArray['{error}'] .= sysMsg('1');
    }
}
$templateHeader = SERVER_PATH.TEMPLATE_DIR."header.html"; $templateContent = SERVER_PATH.TEMPLATE_DIR.$template.".html"; $templateFooter = SERVER_PATH.TEMPLATE_DIR."footer.html";
include_once(MODULES_DIR."header.php");
if ($error) {
    $templateContent = SERVER_PATH.TEMPLATE_DIR."error.html";
    @include_once(MODULES_DIR."error.php");
} else {
    @include_once(MODULES_DIR.$doc.".php");
}
include_once(MODULES_DIR."footer.php");
if ($templateForward) {
    if ($templateForward == "static") {
        $templateContent = SERVER_PATH.TEMPLATE_DIR."static.html";
    } elseif ($templateForward == "home") {
        $templateContent = SERVER_PATH.TEMPLATE_DIR."forward.html";
        $templateArray['{link}'] = WEBSITE_REF;
    } else {
        $templateContent = SERVER_PATH.TEMPLATE_DIR."forward.html";
        $templateArray['{link}'] = WEBSITE_REF.'?p='.$templateForward;
    }
} else {
    $templateForward == false;
}
if ($templateForwardAPI) {
    $templateContent = SERVER_PATH.TEMPLATE_DIR."forward.html";
    $templateArray['{link}'] = WEBSITE_LOC.$templateForwardAPI;
} else {
    $templateForwardAPI == false;
}

$headerContent = replaceTemplate($header, $templateHeader); $mainContent = replaceTemplate($templateArray, $templateContent); $footerContent = replaceTemplate($footer, $templateFooter);
echo $headerContent, $mainContent, $footerContent;
function exception_handler($exception)
{
    echo "Exception cached : " , $exception->getMessage(), "";
}
