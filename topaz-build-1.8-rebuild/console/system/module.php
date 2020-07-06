<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid); $o = cleanInput($_GET['o']); $type = cleanInput($_GET['type']); $id = cleanNumber($_GET['id']); if (!$o) {
    $o = "information";
}
$sec_opts = array("System information" => "information","System Settings" => "settings","Type Lists" => "typelists","Email Templates" => "email-templates"); $sect_head = "System";
$del_id = cleanNumber($_GET['del']); $confirm = cleanNumber($_GET['confirm']);

//email templates
if ($o == "email-templates") {
    if (!userSystemRights($uid, "sys_admin")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    
    $q_chk = sql("SELECT `id`, `name` FROM `system_templates` WHERE `tid` = '2' ORDER BY `name` ASC");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $err[] = sysMsg(4);
        $templateArray['{system-rights}'] = "none";
    } else {
        $i = 2;
        while ($r_chk = mysqli_fetch_assoc($q_chk)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            $td_data .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=edit-email-templates&id='.$r_chk['id'].'">'.$r_chk['name'].'</a></td></tr>';
            $i++;
        }
        $templateArray['{email-templates-data}'] = '<table class="tablesorter" id="email-templates"><thead><tr><th>Name</th></thead><tbody>'.$td_data.'</tbody></table>';
    }
}

//edit email templates
if ($o == "edit-email-templates") {
    if (!userSystemRights($uid, "sys_admin")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $fext = "&id=".$id;
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t='.$t.'&o=email-templates"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ': Edit Email Template';
    $templateArray['{edit-email-templates}'] = 'block';
    
    if ($_POST['edit-email-templates']) {
        $template = $_POST['template'];
        $template = mysqli_real_escape_string($conn, $template);
        if (!$err) {
            $q_edit = sql("UPDATE `system_templates` SET `text` = '".$template."' WHERE `id` = '".$id."'");
            if ($q_edit) {
                $success[] = sysMsg(9);
            } else {
                $err[] = sysMsg(8);
            }
        }
    }//$post
    //get data
    if (!$err) {
        $q_edit = sql("SELECT `name`,`text` FROM `system_templates` WHERE `id` = '".$id."'");
        $c_edit = mysqli_num_rows($q_edit);
        if (!$c_edit) {
            $templateArray['{system-rights}'] = "none";
            $err[] = sysMsg('4');
        } else {
            $r_edit = mysqli_fetch_assoc($q_edit);
            $name = $r_edit['name'];
            $template = $r_edit['text'];
        }
    }
}

//type lists
if ($o == "typelists") {
    if (!userSystemRights($uid, "sys_admin")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    
    //define URL for typelist array
    $url_for_arr = WEBSITE_LOC.'console/index.php?t=system&o=typelists&type=';
    
    //delete types
    if ($del_id) {
        if ($confirm) {
            $q_del = sql("DELETE FROM `system_templates_ext` WHERE `dtid` = '".$del_id."'");
            $q_del_ext = sql("DELETE FROM `type_list` WHERE `id` = '".$del_id."'");
            if ($q_del && $q_del_ext) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $warning[] = sysMsg(15).' <a href="'.WEBSITE_LOC.'console/index.php?t=system&o='.$o.'&type='.$type.$fext.'&del='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=system&o='.$o.'&type='.$type.$fext.'">Cancel</a>.';
        }
    }
    
    //add types
    if ($_POST['add-types-submit']) {
        if (validateInput($_POST['add-types-inp'])) {
            $add_type_inp = cleanInput($_POST['add-types-inp']);
            $custom = cleanInput($_POST['addcustom']);
            
        } else {
            $add_type_inp = $_POST['add-types-inp'];
            $custom = $_POST['addcustom'];
            $err[] = "Type Name: ".sysMsg(6);
        }
        
        if (!$err) {
                    
            //main insert
            $q_ins = sql("INSERT INTO `type_list` (`name`,`group`, `custom`) VALUES ('".$add_type_inp."', '".$type."', '".$custom."')");
            $last_id  = mysqli_insert_id($conn);
            
            //doc_type
            if ($type == 'doc_type') {
                $q_ins_ext = sql("INSERT INTO `system_templates_ext` (`stid`,`dtid`) VALUES ('29', '".$last_id."')");
                if (!$q_ins_ext) {
                    $err[] = sysMsg(8);
                }
            }
            //success
            if ($q_ins && !$err) {
                $success[] = sysMsg(9);
            } else {
                $err[] = sysMsg(8);
            }
        }
    }
    //update types
    if ($_POST['update-types-submit']) {
        $warns = false;
        $errs = false;
        foreach ($_POST['id'] as $k=>$v) {
            if (validateInput($v)) {
                $upd = cleanInput($v);
            } else {
                $warns = true;
                $upd = '';
            }
            //credential types
			if($_POST['enforce']) {
				$sql_add = ", custom = '".cleanString($_POST['enforce'][$k])."'";
				
            }
            //document links
            if($_POST['link']) {
				$sql_add = ", custom = '".cleanString($_POST['link'][$k])."'";
				
            }
            //education types
            if($_POST['color']) {
				$sql_add = ", custom = '".cleanString($_POST['color'][$k])."'";
				
			}
            if ($upd) {
                $q_upd = sql("UPDATE `type_list` SET `name` = '".$upd."' ".$sql_add." WHERE `id` = '".$k."'");
                if ($q_upd) {
                    $succ = true;
                } else {
                    $errs = true;
                }
            }
        }
        if ($succ) {
            $success[] = sysMsg(9);
        }
        if ($errs) {
            $err[] = sysMsg(8);
        }
        if ($warns) {
            $warning[] = 'One or more of your data inputs were invalid.';
        }
    }
    
    //query for doc_types
    if ($type == 'doc_type') {
        $chk_query = " AND `id` != '15' AND `id` != '37'";
        $chk_query_ext = "SELECT `did` FROM `document_properties` WHERE `doc_type` = ";
        $templateArray['{types-description}'] = 'Document Types';
        $type_sel = $url_for_arr.'doc_type';
    }
    //query for cred_type
    if ($type == 'cred_type') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `user_rights_ext` WHERE `tid` = ";
        $templateArray['{types-description}'] = 'Credential Types';
		$type_sel = $url_for_arr.'cred_type';
    }
    //query for mach_stat
    if ($type == 'mach_stat') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `qi_responses` WHERE `status` = ";
        $templateArray['{types-description}'] = 'Checklist Status';
        $type_sel = $url_for_arr.'mach_stat';
    }
    //query for mach_type
    if ($type == 'mach_type') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `machines` WHERE `tid` = ";
        $templateArray['{types-description}'] = 'Machine Type';
        $type_sel = $url_for_arr.'mach_type';
    }
    //query for locations
    if ($type == 'locations') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `qa_responses` WHERE `location` = ";
        $templateArray['{types-description}'] = 'Location Types';
        $type_sel = $url_for_arr.'locations';
    }
    //query for units
    if ($type == 'units') {
        $chk_query = "";
        $chk_query_ext = "SELECT `uid` FROM `user_ext` WHERE `unit` = ";
        $templateArray['{types-description}'] = 'Unit Types';
        $type_sel = $url_for_arr.'units';
    }
    //query for checklist type
    if ($type == 'chkl_type') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `qi` WHERE `type_id` = ";
        $templateArray['{types-description}'] = 'Checklist Types';
        $type_sel = $url_for_arr.'chkl_type';
        $link_module = 'checklist-manager';
    }
    //query for audit type
    if ($type == 'qa_type') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `qa_checklist` WHERE `type_id` = ";
        $templateArray['{types-description}'] = 'Audit Types';
        $type_sel = $url_for_arr.'qa_type';
        $link_module = 'qa-audits';
    }

    //query for Links (home page)
    if ($type == 'links') {
        $chk_query = "";
        $chk_query_ext = "";
        $templateArray['{types-description}'] = 'Links (Menu Drop down)';
        $type_sel = $url_for_arr.'links';
    }
    //query for edu_types
    if ($type == 'edu_typ') {
        $chk_query = "";
        $chk_query_ext = "SELECT `id` FROM `education` WHERE `edu_type` = ";
        $templateArray['{types-description}'] = 'Education Types';
		$type_sel = $url_for_arr.'edu_typ';
    }    
    //Execute query for all typelists
    if ($type) {
        $q_chk = sql("SELECT * FROM `type_list` WHERE `group` = '".$type."' ".$chk_query." ORDER BY `name` ASC");
        $c_chk = mysqli_num_rows($q_chk);
        
            while ($r_chk = mysqli_fetch_assoc($q_chk)) {
                $data_append = '';
                if ($chk_query_ext) {
                    $q_chk_ext = sql($chk_query_ext." '".$r_chk['id']."'");
                    $c_chk_ext = mysqli_num_rows($q_chk_ext);
                }
                if ($c_chk_ext && userSystemRights($uid, "delete")) {
                    $del = '<span class="delete">&nbsp;</span>';
                } else {
                    $del = '<span class="delete"><a href="'.WEBSITE_LOC.'console/index.php?t=system&o='.$o.'&type='.$type.$fext.'&del='.$r_chk['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a></span>';
				}
				//for qa-audits and checklists
                if ($link_module) {
                    $link_url= '<span class="link">Link: <a href="'.WEBSITE_LOC.'?p='.$link_module.'&t='.$r_chk['id'].'" target="_blank">'.WEBSITE_LOC.'?p='.$link_module.'&t='.$r_chk['id'].'</a></span>';
                } else {
                    $link_url = '';
				}
				
				//for credentials
				if($type == 'cred_type') {
					$enforce_arr = array("yes" => "Enforce","no" => "Do not enforce");
					$data_append = drawSelect("enforce[".$r_chk['id']."]", $enforce_arr, $r_chk['custom'],"","cred");
				} 
                //for education types
				if($type == 'edu_typ') {
					$data_append = drawFld("text", "color[".$r_chk['id']."]", $r_chk['custom'],"","color");
				} 
                //for links
				if($type == 'links') {
					$data_append = drawFld("text", "link[".$r_chk['id']."]", $r_chk['custom'],"","cred");
				} 
                $data .= '<p>'.drawFld("text", "id[".$r_chk['id']."]", $r_chk['name']).$data_append.$del.$link_url.'</p>';
            }
            $templateArray['{types}'] = $data;
        
    }
    
    //build type list selector
    $type_arr[$url_for_arr] = 'Select Type List';
    $type_arr[$url_for_arr.'qa_type'] = 'Audit Types';
    $type_arr[$url_for_arr.'mach_stat'] = 'Checklist Status';
    $type_arr[$url_for_arr.'chkl_type'] = 'Checklist Types';
    $type_arr[$url_for_arr.'cred_type'] = 'Credential Types';
    $type_arr[$url_for_arr.'doc_type'] = 'Document Types';
    $type_arr[$url_for_arr.'edu_typ'] = 'Education Event Types';
    $type_arr[$url_for_arr.'links'] = 'Links (Menu Drop down)';
    $type_arr[$url_for_arr.'locations'] = 'Location Types';
    $type_arr[$url_for_arr.'mach_type'] = 'Machine Type';
    $type_arr[$url_for_arr.'units'] = 'Unit Types';
    
    $templateArray['{types-selector}'] = drawSelect("type", $type_arr, $type_sel, "Type List", "sel_typ");
}


//system settings
if ($o == "settings") {
    if (!userSystemRights($uid, "sys_admin")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    
    if ($_POST['upd-system']) {
        
        //Site active
        $site_act = cleanInput($_POST['site-act']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$site_act."' WHERE `id` = '1'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //Document number
        $doc_no = cleanInput($_POST['doc-no']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$doc_no."' WHERE `id` = '11'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //force login
        $force_logon = cleanInput($_POST['force-logon']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$force_logon."' WHERE `id` = '12'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //display rows
        $disp_rows = cleanInput($_POST['display-rows']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$disp_rows."' WHERE `id` = '13'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //display rows launch
        $disp_rows_launch = cleanInput($_POST['display-rows-launch']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$disp_rows_launch."' WHERE `id` = '14'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //page limit
        $page_limit = cleanInput($_POST['page-limit']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$page_limit."' WHERE `id` = '15'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //search rows
        $search_rows = cleanInput($_POST['search-rows']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$search_rows."' WHERE `id` = '16'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //time-out-delay
        $tod = cleanInput($_POST['time-out-delay']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$tod."' WHERE `id` = '17'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //days-for-cpe-recording
        $dfcr = cleanInput($_POST['days-for-cpe-recording']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$dfcr."' WHERE `id` = '18'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //exc-list
        $exclist = cleanInput($_POST['exc-list']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$exclist."' WHERE `id` = '19'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }

        //debug
        $debug = cleanInput($_POST['debug']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$debug."' WHERE `id` = '20'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //debug_forms
        $debug_f = cleanInput($_POST['debug-form']);
        $q_upd = sql("UPDATE `system_settings` SET `value` = '".$debug_f."' WHERE `id` = '21'");
        if (!$q_upd) {
            $err[] = sysMsg(8);
        }
        
        //check for all
        if ($q_upd) {
            $success[] = sysMsg(9);
        }
    }
} //settings

//Nav
foreach ($sec_opts as $k => $v) {
    if ($v == $o) {
        $c = "sect_nav_c";
        $disp = "block";
        $templateArray['{sect_head_ext}'] = ": ".$k;
    } else {
        $c = "sect_nav";
        $disp = "none";
    }
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=system&o='.$v.'" class="'.$c.'">'.$k.'</a>';
    $templateArray['{'.$v.'}'] = $disp;
}

if (!$templateArray['{section_nav}']) {
    $templateArray['{section_nav}'] = "";
}

if (!$sect_head) {
    $sect_head = "Error";
}
if (!$templateArray['{sect_head}']) {
    $templateArray['{sect_head}'] = $sect_head;
}
if (!$templateArray['{sect_head_ext}']) {
    $templateArray['{sect_head_ext}'] = "";
}
if (!$templateArray['{sect_head_rt}']) {
    $templateArray['{sect_head_rt}'] = $sect_nav_ext;
}

if (!$templateArray['{success}']) {
    $templateArray['{success}'] = writeMsgs($success, "success");
}
if (!$templateArray['{warning}']) {
    $templateArray['{warning}'] = writeMsgs($warning, "warning");
}
if (!$templateArray['{error}']) {
    $templateArray['{error}'] = writeMsgs($err);
}

list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=system&o='.$o.'&type='.$type.$fext);
$templateArray['{fhead}'] = $fhead;  $templateArray['{fend}'] = $fend;
$templateArray['{submit-system}'] = drawFld("submit", "upd-system", "Update", "&nbsp;", "submit");

//system information
$templateArray['{system-version}'] = drawFld("text", "systemversion", SYSTEM_VERSION, "System Version", "", "", 1);
$templateArray['{php-version}'] = drawFld("text", "phpversion", phpversion(), "PHP Version", "", "", 1);
$templateArray['{mysql-version}'] = drawFld("text", "mysqlversion", sprintf('%d', mysqli_get_client_version()), "MySQL Version", "", "", 1);
$templateArray['{product-license}'] = drawFld("text", "product-license", WEBSITE_OWNER, "Product Licensed to", "", "", 1);
$templateArray['{phpinfo}'] = WEBSITE_LOC.'console/system/phpinfo.php';

//System Settings
$q_set_act = sql("SELECT * FROM `system_settings` WHERE `id` = 1"); $r_set_act = mysqli_fetch_assoc($q_set_act); if (!$site_act) {
    $site_act = $r_set_act['value'];
}
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$site_act) {
    $site_act = "0";
}
$templateArray['{site-act}'] = drawSelect("site-act", $act_arr, $site_act, "Site Active/Disabled");

//document number
$q_set_dn = sql("SELECT * FROM `system_settings` WHERE `id` = 11"); $r_set_dn = mysqli_fetch_assoc($q_set_dn); if (!$doc_no) {
    $doc_no = $r_set_dn['value'];
}
$doc_arr = array("0" => "No","1" => "Yes"); if (!$doc_no) {
    $doc_no = "0";
}
$templateArray['{doc-no}'] = drawSelect("doc-no", $doc_arr, $doc_no, "Generate Document Number");

//force logon
$q_set_fl = sql("SELECT * FROM `system_settings` WHERE `id` = 12"); $r_set_fl = mysqli_fetch_assoc($q_set_fl); if (!$force_logon) {
    $force_logon = $r_set_fl['value'];
}
$force_logon_arr = array("0" => "No","1" => "Yes"); if (!$force_logon) {
    $force_logon = "0";
}
$templateArray['{force-logon}'] = drawSelect("force-logon", $force_logon_arr, $force_logon, "Require Log on");

//other settings

$templateArray['{display-rows}'] = drawFld("text", "display-rows", systemSettingsValue(13), "Display Rows");
$templateArray['{display-rows-launch}'] = drawFld("text", "display-rows-launch", systemSettingsValue(14), "Display Rows (Launch)");
$templateArray['{page-limit}'] = drawFld("text", "page-limit", systemSettingsValue(15), "Page Limit");
$templateArray['{search-rows}'] = drawFld("text", "search-rows", systemSettingsValue(16), "Search Rows");
$templateArray['{time-out-delay}'] = drawFld("text", "time-out-delay", systemSettingsValue(17), "Session Expiry (mins)");
$templateArray['{days-for-cpe-recording}'] = drawFld("text", "days-for-cpe-recording", systemSettingsValue(18), "Allow Education event attendance (days)");
$templateArray['{exc-list}'] = drawFld("text", "exc-list", systemSettingsValue(19), "Display file permitted extensions (;)");

$debug_arr = array("0" => "Off","1" => "On");
$templateArray['{debug}'] = drawSelect("debug", $debug_arr, systemSettingsValue(20), "Debug Mode");

$debug_form_arr = array("0" => "Off","1" => "On");
$templateArray['{debug-form}'] = drawSelect("debug-form", $debug_form_arr, systemSettingsValue(21), "Debug Mode Forms");

//types list
$templateArray['{fhead-types}'] = $fhead;  $templateArray['{fend-types}'] = $fend;
$templateArray['{update-types-submit}'] = drawFld("submit", "update-types-submit", "Update Type List", "", "submit");
$templateArray['{add-types-inp}'] = drawFld("text", "add-types-inp", ""); $templateArray['{add-types-submit}'] = drawFld("submit", "add-types-submit", "Add", "", "submit");

//Credential types
if ($type == 'cred_type') {
    $templateArray['{add-custom}'] = drawSelect("addcustom", $enforce_arr, $custom, "","cred");
}

//Links
if ($type == 'edu_typ') {
    $templateArray['{add-custom}'] = drawFld("text", "addcustom", "", "", "color");
}

//Links
if ($type == 'links') {
    $templateArray['{add-custom}'] = drawFld("text", "addcustom", "", "", "cred");
}

//Type list units check licencing
if ($type == 'units') {
    $q_chk_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
    $c_chk_unit = mysqli_num_rows($q_chk_unit);
    if (!($c_chk_unit < $unit_locations)) {
        $templateArray['{add-types-inp}'] = '';
        $templateArray['{add-types-submit}'] = '';
        $templateArray['{max-licence}'] = 'Maximum licenced units reached.';
    }
}
if (!$type) {
    $templateArray['{update-types-submit}'] = '';
    $templateArray['{add-types-inp}'] = '';
    $templateArray['{add-types-submit}'] = '';
    $templateArray['{types}'] = '';
    $templateArray['{typelists-sel}'] = 'none';
} else {
    $templateArray['{typelists-sel}'] = 'block';
}
if (!$templateArray['{max-licence}']) {
    $templateArray['{max-licence}'] = '';
}
if (!$templateArray['{types-description}']) {
    $templateArray['{types-description}'] = '';
}

//edit email templates
$templateArray['{fhead-edit-email-templates}'] = $fhead; $templateArray['{fend-edit-email-templates}'] = $fend;
$templateArray['{edit-email-templates-name}'] = drawFld("text", "name", $name, "Name", "", "", 1);
$templateArray['{edit-email-templates-text}'] = $template;
$templateArray['{edit-email-templates-submit}'] = drawFld("submit", "edit-email-templates", "Update Email Template", "", "submit");
if (!$templateArray['{edit-email-templates}']) {
    $templateArray['{edit-email-templates}'] = 'none';
}

$templateArray['{website-loc}'] = WEBSITE_LOC.'console/_scripts/';
if(!$templateArray['add-custom']) { $templateArray['add-custom'] = ''; }