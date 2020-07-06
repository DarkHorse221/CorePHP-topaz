<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$o = cleanInput($_GET['o']); $id = cleanNumber($_GET['id']);
$del_id = cleanNumber($_GET['del']); $confirm = cleanNumber($_GET['confirm']);
if (!$id) {
    $err[] = sysMsg('4');
    $templateArray['{system-rights}'] = "none";
} else {
    $templateArray['{system-rights}'] = "block";
}
$sec_opts = array("Edit Group" => "group","View Users" => "view-user-groups","Group Credentials" => "view-group-credentials");

$q_grp_name = sql("SELECT `name` FROM `user_rights` WHERE `id` = '".$id."'");
$r_grp_name = mysqli_fetch_assoc($q_grp_name);
$sect_head = "Group Editor (".$r_grp_name['name'].")";
//edit groups
if ($o == "group") {
    if (!userSystemRights($uid, "edit_group")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $fext = "&id=".$id;
    
    $q_chk = sql("SELECT `id`, `name` FROM `user_rights` WHERE `id` = '".$id."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $templateArray['{system-rights}'] = "none";
        $err[] = sysMsg('4');
    } else {
        $r_chk = mysqli_fetch_assoc($q_chk);
        $grp_id = $r_chk['id'];
        $grp_name = $r_chk['name'];
        //get page info
        $q_page = sql("SELECT `did` FROM `user_rights_pages` WHERE `urid` = '".$id."'");
        $c_page_chk = mysqli_num_rows($q_page);
        if ($c_page_chk) {
            $r_page = mysqli_fetch_assoc($q_page);
            $pageid = $r_page['did'];
        } else {
            $pageid = '';
        }
        
        if ($_POST['edit-group']) {
            if (validateInput($_POST['grp_name'])) {
                $grp_name = cleanInput($_POST['grp_name']);
            } else {
                $grp_name = $_POST['grp_name'];
                $err[] = "Group name: ".sysMsg(6);
            }
            if (!$err) {
                $q_grp = sql("UPDATE `user_rights` SET `name` = '".$grp_name."' WHERE `id` = '".$id."'");
                //update page, remove entry first then insert new everytime
                $pageid = cleanInput($_POST['grp_page']);
                $q_del = sql("DELETE FROM `user_rights_pages` WHERE `urid` = '".$id."'");
                if ($pageid) {
                    $q_sql = sql("INSERT INTO `user_rights_pages` (`urid`, `did`) VALUES ('".$id."', '".$pageid."')");
                }
                if ($q_grp) {
                    $success[] = sysMsg(9);
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
    }
} //group

//view user groups
if ($o == "view-user-groups") {
    if (!userSystemRights($uid, "edit_group")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $fext = "&id=".$id;
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    
    if ($del_id) {
        if ($confirm) {
            $q_del_usr = sql("DELETE FROM `user_groups` WHERE `uid` = '".$del_id."' AND `rid` = '".$id."'");
            if ($q_del_usr) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $warning[] = sysMsg(15).' <a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o='.$o.$fext.'&del='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o='.$o.$fext.'">Cancel</a>.';
        }
    }
    
    $q_chk = sql("SELECT `id`, `name` FROM `user_rights` WHERE `id` = '".$id."'");
    $c_chk = mysqli_num_rows($q_chk);
    if (!$c_chk) {
        $templateArray['{system-rights}'] = "none";
        $err[] = sysMsg('4');
    } else {
        $q_data = sql("SELECT u.id, u.uname, u.email, u.active, ue.fname, ue.lname FROM user u, user_ext ue, user_groups ug WHERE u.id=ue.uid AND u.id=ug.uid AND ug.rid = '".$id."'");
        $c_data = mysqli_num_rows($q_data);
        if (!$c_data) {
            $templateArray['{users-in-group}'] = "There are no users attached to this group.";
        } else {
            $i = 2;
            while ($r_data = mysqli_fetch_assoc($q_data)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if (userSystemRights($uid, "delete")) {
                    if ($r_data['uname'] !== "sysadmin") {
                        $del = '<a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o='.$o.$fext.'&del='.$r_data['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a>';
                    } else {
                        $del = "";
                    }
                }
                if ($r_data['active']) {
                    $act = '0';
                    $im = 'active.gif';
                } else {
                    $act = '1';
                    $im = 'non-active.gif';
                }
                $status = '<img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" />';
                $users .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=user&id='.$r_data['id'].'">'.$r_data['uname'].'</a></td><td>'.$r_data['fname'].' '.$r_data['lname'].'</td><td>'.$r_data['email'].'</td><td>'.$status.'</td><td>'.$del.'</td></tr>';
                $i++;
            } // while
            $templateArray['{users-in-group}'] = '<table class="tablesorter" id="view-users"><thead><tr><th>Username</th><th>Full Name</th><th>Email</th><th>Status</th><th>&nbsp;</th></tr></thead><tbody>'.$users.'</tbody></table>';
        }
    } //else
} //group

if ($o == "view-add-credentials") {
    if (!userSystemRights($uid, "edit_group")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_head .= ": Add new Credential";
    $fext = "&id=".$id;
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o=view-group-credentials'.$fext.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{view-add-credentials}'] = "block";
    if (!D4600135D233F_LOCKOUT) {
        if ($_POST['add-cred']) {
            if (validateInput($_POST['add_grp_name'])) {
                $add_grp_name = cleanInput($_POST['add_grp_name']);
            } else {
                $add_grp_name = $_POST['add_grp_name'];
                $err[] = "Credential name: ".sysMsg(6);
            }
            if (!$err) {
                $q_add_grp = sql("INSERT INTO `type_list` (`name`, `group`) VALUES ('".$add_grp_name."', 'cred_type')");
                if ($q_add_grp) {
                    $success[] = sysMsg(9);
                    $o = "view-group-credentials";
                    $templateArray['{view-add-credentials}'] = "none";
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
    } else {
        $err[] = sysMsg('57');
        $templateArray['{system-rights}'] = "none";
    }//lockout mode
} //credentials

//view group credentials
if ($o == "view-group-credentials") {
    if (!userSystemRights($uid, "edit_group")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    if ($_POST['edit-cred']) {
        $cred_del = sql("DELETE FROM `user_rights_ext` WHERE `rid` = '".$id."'");
        foreach ($_POST as $k => $v) {
            if (is_numeric($k)) {
                if ($v) {
                    $cred_q = sql("INSERT INTO `user_rights_ext` (`rid`, `tid`, `reqd`) VALUES ('".$id."','".$k."', '1')");
                }
            }
        }
        $success[] = sysMsg(9);
    }
    
    $fext = "&id=".$id;
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    
    $q_grp_typ = sql("SELECT `tid` FROM `user_rights` WHERE `id` = '".$id."'");
    $r_grp_typ = mysqli_fetch_assoc($q_grp_typ);
    
    if ($r_grp_typ['tid'] == 5) {
        $grp = "'chkl_type','qa_type','mail_grp'";
        $templateArray['{cred_header}'] = 'Select the following lists for this mail group';
    } else {
        $grp = "'cred_type'";
        $templateArray['{cred_header}'] = 'Select the following credentials that are mandatory for this group';
        $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o=view-add-credentials'.$fext.'"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
    }
    
    $q_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` IN (".$grp.")");
    while ($r_typ = mysqli_fetch_assoc($q_typ)) {
        $q_man = sql("SELECT * FROM `user_rights_ext` WHERE `rid` = '".$id."' AND `tid` = '".$r_typ['id']."'");
        $c_man = mysqli_num_rows($q_man);
        if ($c_man) {
            $selected = 'checked="checked"';
        } else {
            $selected = '';
        }
        $templateArray['{credentials}'] .= '<p><label class="wide">'.$r_typ['name'].'</label><input name="'.$r_typ['id'].'" type="checkbox" value="1" '.$selected.' class="chk"></p>';
    }
} //credentials

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
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o='.$v.'&id='.$id.'" class="'.$c.'">'.$k.'</a>';
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
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=option-editor&o='.$o.$fext);

if (!$templateArray['{view-user-groups}']) {
    $templateArray['{view-user-groups}'] = "none";
}
if (!$templateArray['{group}']) {
    $templateArray['{group}'] = "none";
}
//for group edit
$templateArray['{fhead-cred}'] = $fhead; $templateArray['{fend-cred}'] = $fend;
$templateArray['{fhead-grp}'] = $fhead; $templateArray['{fend-grp}'] = $fend;
$templateArray['{group-id}'] = drawFld("text", "grp-id", $grp_id, "Group ID", "", "", 1);
$templateArray['{group-name}'] = drawFld("text", "grp_name", $grp_name, "Group Name");

$q_docs = sql("SELECT `did`, `name` FROM `document_properties` WHERE `doc_type` = '15' AND `did` !='1' ORDER BY `name` ASC"); $dtype_arr['0'] = 'Default (Home)';
while ($r_docs = mysqli_fetch_assoc($q_docs)) {
    $dtype_arr[''.$r_docs['did'].''] = $r_docs['name'];
}
$templateArray['{group-page}'] = drawSelect("grp_page", $dtype_arr, $pageid, "Home Screen (on logon)");
$templateArray['{submit-grp}'] = drawFld("submit", "edit-group", "Update user group name", "&nbsp;", "submit");
$templateArray['{submit-cred}'] = drawFld("submit", "edit-cred", "Update group credentials", "", "submit");
//for group add
$templateArray['{fhead-add-group}'] = $fhead; $templateArray['{fend-add-group}'] = $fend;
$templateArray['{submit-add-group}'] = drawFld("submit", "add-cred", "Add new Credential", "&nbsp;", "submit");
$templateArray['{add-group}'] = drawFld("text", "add_grp_name", $add_grp_name, "Credential Name");
if (!$templateArray['{view-add-credentials}']) {
    $templateArray['{view-add-credentials}'] = 'none';
}
