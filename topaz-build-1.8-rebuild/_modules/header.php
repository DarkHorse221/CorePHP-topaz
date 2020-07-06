<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}

//do home screen
if (userAuthorise($sid)) {
    $homescreen = userHomeScreen("", $sid);
    $usr_unit = userUnit(userID($sid));
} else {
    $homescreen = 'home';
}

//update unit information
if (cleanInput($_GET['unit']) || ($_GET['unit'] == 'all')) {
    if ($_GET['unit'] == 'all') {
        $usr_unit = 0;
    } else {
        $usr_unit = $_GET['unit'];
    }
    $q_up_unit = sql("UPDATE user_ext SET unit = '".$usr_unit."' WHERE uid = '".userID($sid)."'");
}

$header['{website_loc}'] = WEBSITE_LOC; $header['{website_ref}'] = WEBSITE_REF; $header['{website_img}'] = WEBSITE_LOC.IMAGES_DIR; $header['{website_scripts}'] = WEBSITE_LOC.SCRIPTS_DIR;
if (DEMO_MODE) {
    $header['{demo_mode}'] = '<div id="demo">!!! DEMO MODE FOR TRAINING PURPOSES ONLY !!!</div><div class="clear"></div>
<div id="header-demo"><a href="'.WEBSITE_LOC.'?p='.$homescreen.'"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/site-logo.png" /></a><span class="header-link">{link}</span></div>';
} else {
    $header['{demo_mode}'] = '
<div id="header"><a href="'.WEBSITE_LOC.'?p='.$homescreen.'"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/site-logo.png" /></a><span class="header-link">{link}</span></div>';
}

if ($doc_id) {
    $q_doc = sql("SELECT `name` FROM `document_properties` WHERE `did` = '".$doc_id."'");
    $r_doc = mysqli_fetch_assoc($q_doc);
    $title = $r_doc['name'];
}
if ($mod_id) {
    $q_mod = sql("SELECT `name` FROM `system_modules` WHERE `id` = '".$mod_id."'");
    $r_mod = mysqli_fetch_assoc($q_mod);
    $title = $r_mod['name'];
    $author = WEBSITE_AUTHOR;
    $keywords = "";
    $description = "";
}
$header['{title}'] = $title. ' | '.WEBSITE_TITLE; $header['{website_loc}'] = WEBSITE_LOC; $uid = userID($sid);

if ($lvl1 == 'tap-and-learn' && checkModule("tap-and-learn")) {
    $header['{tap-and-learn}'] = ' onLoad="document.forms.search.inp.focus();"';
} else {
    $header['{tap-and-learn}'] = '';
}

$header['{nav}'] = '
<ul id="menu" class="topmenu">
<li class="topfirst"><a href="'.WEBSITE_REF.'?p='.$homescreen.'" style="height:18px;line-height:18px;"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-home.gif" class="navico" />Home</a></li>
<li class="topmenu"><a href="" style="height:18px;line-height:18px;"><span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-doccat.gif" class="navico" />Document Categories</span></a>
<ul>';
$q_top_cat = sql("SELECT dp.name, dp.link, dp.unit FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.parent_id = '1' AND dp.active = '1' AND dp.doc_type = '37' ORDER BY dp.name ASC");
while ($r_top_cat = mysqli_fetch_assoc($q_top_cat)) {
    if (($usr_unit == $r_top_cat['unit']) || ($r_top_cat['unit'] == '0') || ($usr_unit == '0') || !$usr_unit) { //check for user unit
        $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p='.$r_top_cat['link'].'">'.$r_top_cat['name'].'</a></li>';
    }
}
$header['{nav}'] .= '</ul></li>';
    
    if (checkModule('document-types') && $mod['document-types']) {
        $header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_REF.'?p=document-types" style="height:18px;line-height:18px;"><span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-doctype.gif" class="navico" />Document Types</span></a>
		<ul>';
        $q_dtypes = sql("SELECT * FROM `type_list` WHERE `group` = 'doc_type' ORDER BY `name` ASC");
        while ($r_dtypes = mysqli_fetch_assoc($q_dtypes)) {
            if (!($r_dtypes['id'] == '37')) { //exclude pages and folders
                $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=document-types&o='.$r_dtypes['id'].'">'.$r_dtypes['name'].'</a></li>';
            }
        }
        $header['{nav}'] .= '</ul></li>';
    } //check document-types

    //do links
    $q_links = sql("SELECT * FROM `type_list` WHERE `group` = 'links' ORDER by `name`");
    $c_links = mysqli_num_rows($q_links);
    if($c_links) {
        while($r_links = mysqli_fetch_assoc($q_links)) {
            $links .= '<li><a href="'.$r_links['custom'].'" target="_blank">'.$r_links['name'].'</a></li>';
        }
        $header['{nav}'] .= '<li class="topmenu"><a href="" style="height:18px;line-height:18px;"><span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-links.gif" class="navico" />Links</span></a>
        <ul>
            '.$links.'
        </ul>
        </li>';
        
    }

    if (checkModule('search') && $mod['search']) {
        $header['{search}'] = '<a href="'.WEBSITE_REF.'?p=search" class="lt-box-search">Search Documents</a>';
    } else {
        $header['{search}'] = '';
    }
    
    if (userAuthorise($sid)) {
        $header['{login}'] .= '<a href="'.WEBSITE_REF.'?p=logoff" class="lt-box-logoff">Logoff</a><a href="'.WEBSITE_REF.'?p=secure" class="lt-box-secure">User Profile</a>';
        
        //$header['{login}'] .= '<a href="'.WEBSITE_REF.'?p=messages" class="lt-box-messages">Messages <span class="numbers-red">10</span></a>';
        
        $header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_REF.'?p=secure" style="height:18px;line-height:18px;"><span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-secure.gif" class="navico" />User Profile</span></a><ul>';
        
        $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=update-details" '.$upd_sel.'>User Details</a></li>';
        $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=change-password" '.$cp_sel.'>Password</a></li>';
        $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=managers" '.$man_sel.'>Managers</a></li>';
        if (userSystemRights($uid, "add_credentials")) {
            $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=credentials" '.$cren_sel.'>Credentials</a></li>';
        }
        if (checkModule('radiation-manager') && userSystemRights($uid, 'radiation')) {
            $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=radiation-record" '.$rad_sel.'>Radiation Record</a></li>';
        }
        if (checkModule('bulletins') && userSystemRights($uid, 'add_bulletins')) {
            $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=post-bulletin" '.$bb_sel.'>Post Bulletin</a></li>';
        }
        if (userSystemRights($uid, 'gen_admin') || userSystemRights($uid, 'sys_admin')) {
            $header['{nav}'] .= '<li><a href="'.WEBSITE_LOC.'console/index.php?t=launch">Console</a></li>';
        }
        $header['{nav}'] .= '</ul></li>';
        if (checkModule('learning-and-education') && userSystemRights(userID($sid), "view_education")) {
            $header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_REF.'?p=learning-and-education" style="height:18px;line-height:18px;"><span><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-learning.gif" class="navico" />Learning & Education</span></a>
		<ul>
			<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=events">Events Calendar</a></li>';
            $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=cpd">CPD Attendance Record</a></li>';
            $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=cpd-presentation">CPD Presentation Record</a></li>';
            if (userSystemRights($uid, "add_education")) {
                $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=add-self-cpd">Add Personal CPD Record</a></li>';
            }
            $header['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=learning-and-education&o=cpd-summary">CPD Summary</a></li>';
            $header['{nav}'] .= '</ul></li>';
            if (checkModule('learning-and-education') && userSystemRights(userID($sid), "view_education")) {
                $header['{login}'] .= '<a href="'.WEBSITE_REF.'?p=learning-and-education" class="lt-box-learning-and-education">Learning & Education</a>';
            }
        }
        $header['{nav}'] .= '<li class="toplast"><a href="'.WEBSITE_REF.'?p=logoff" style="height:18px;line-height:18px;"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/navico-logoff.gif" class="navico" />Log Off</a></li>';
    } else {
        $header['{login}'] .= '<a href="'.WEBSITE_REF.'?p=login" class="lt-box-login">Login</a>';
        if (checkModule('tap-and-learn')) {
            $header['{login}'] .= '<a href="'.WEBSITE_REF.'?p=event-calendar" class="lt-box-learning-and-education">Event Calendar</a>';
        }
    }
    
$header['{nav}'] .= '</ul>';

if (userAuthorise($sid)) {
    $header['{sid}'] = $sid;
    //check terms
    if ($_SESSION['ta'] == '0') {
        if ($_POST['accept-ta'] || $_POST['decline-ta']) {
            if ($_POST['accept-ta']) {
                $q_upd = sql("UPDATE `user_ext` SET `terms_accept` = '1' WHERE `uid`= '".$uid."'");
                session_regenerate_id();
                session_start();
                unset($_SESSION['ta']);
                $_SESSION['ta'] = '1';
                session_write_close();
                $new_sid = session_id();
                logSession($uid, $new_sid);
                $templateForward = 'secure';
                $templateArray['{message}'] = '<h1>Terms and Conditions</h1><p>Terms and Conditions have been accepted.</p><p>Transferring you to Secure Members section now...</p>';
            }
            if ($_POST['decline-ta']) {
                $templateForward = 'logoff';
                $templateArray['{message}'] = '<h1>Terms and Conditions</h1><p>You must accept the Terms and Conditions before using EVP DMSs.</p>';
            }
        } else {
            $templateForward = 'static';
            list($fhead, $fend) = drawFormTags('p', WEBSITE_REF);
            $templateArray['{message}'] = sysMsg(52).$fhead.'<p>'.drawFld("submit", "accept-ta", "Accept", "", "submit").' '.drawFld("submit", "decline-ta", "Decline", "", "submit-cancel").'</p>'.$fend;
        }
    } //check terms
    //do user rights link
    
    //show unit selector
    if (userSystemRights($uid, "update_unit")) {
        $q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
        $unit_arr['all'] = 'All Units';
        while ($r_unit = mysqli_fetch_assoc($q_unit)) {
            $unit_arr[$r_unit['id']] = $r_unit['name'];
        }
        $unit = drawSelect("unit", $unit_arr, $usr_unit, "", "", "", "", "unit-selector");
        $hlu = $unit.' | ';
    }
    //show console link
    if (userSystemRights($uid, "sys_admin") || userSystemRights($uid, "gen_admin")) {
        $hla = ' | <a href="'.WEBSITE_LOC.'console">Console</a>';
    }
    //show log in information
    $header['{link}'] = $hlu.'Logged in as <strong>'.$_SESSION['f'].' '.$_SESSION['l'].'</strong>'.$hla;
} else {
    $header['{link}'] = '<em><a href="'.WEBSITE_REF.'?p=login">Login</a></em>';
}
