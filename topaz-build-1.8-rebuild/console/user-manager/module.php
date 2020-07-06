<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$sec_opts = array("Users" => "users","Groups" => "groups","Rights" => "rights");
$o = cleanInput($_GET['o']); if (!$o) {
    $o = 'users';
} //set default
$del_id = cleanNumber($_GET['del']); $confirm = cleanNumber($_GET['confirm']);
$stat = cleanNumber($_GET['status']); $id = cleanNumber($_GET['id']);

if ($o == "add-user") {
    if (!userSystemRights($uid, "add_user")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ": Add User";
    $templateArray['{add-user}'] = "block";
    if (!D4600135D233F_LOCKOUT) {
        if ($_POST['add-user']) {
            $act = cleanNumber($_POST['act']);
            $ph = cleanNumber($_POST['ph']);
            $mob = cleanNumber($_POST['mob']);
            $unit = cleanNumber($_POST['unit']);
            //error checking
            if (validateInput($_POST['fn'])) {
                $fn = cleanInput($_POST['fn']);
            } else {
                $fn = $_POST['fn'];
                $err[] = "First name: ".sysMsg(6);
            }
            if (validateInput($_POST['ln'])) {
                $ln = cleanInput($_POST['ln']);
            } else {
                $ln = $_POST['ln'];
                $err[] = "Last name: ".sysMsg(6);
            }
            if (validateInput($_POST['usr'])) {
                $usr = cleanInput($_POST['usr']);
                if (!(strlen($usr) > 2)) {
                    $err[] = "Username: ".sysMsg(6);
                }
                $q_uchk = sql("SELECT `id` FROM `user` WHERE `uname` = '".$usr."'");
                $c_uchk = mysqli_num_rows($q_uchk);
                if ($c_uchk) {
                    $err[] = "Username: Username is already registered.";
                }
            } else {
                $usr = $_POST['usr'];
                $err[] = "Username: ".sysMsg(6);
            }
            if (validateEmail($_POST['e'])) {
                $e = cleanEmail($_POST['e']);
                $q_echk = sql("SELECT `id` FROM `user` WHERE `email` = '".$e."'");
                $c_echk = mysqli_num_rows($q_echk);
                if ($c_echk) {
                    $warning[] = "Email address is already registered.";
                }
            } else {
                $e = $_POST['e'];
                $err[] = "Email: ".sysMsg(6);
            }
            if (validateInput($_POST['title'])) {
                $title = cleanInput($_POST['title']);
            } else {
                $title = $_POST['title'];
                $err[] = "Job Title: ".sysMsg(6);
            }
            if (validateInput($_POST['pass1']) && validateInput($_POST['pass2'])) {
                $pass1 = cleanInput($_POST['pass1']);
                $pass2 = cleanInput($_POST['pass2']);
                if ($pass1 == $pass2) {
                    if (strlen($pass1) < 73) {
                        $hasher = new PasswordHash(9, false);
                        $hash = $hasher->HashPassword($pass1);
                    } else {
                        $err[] = "Passwords: Length must be less than 72 characters";
                    }
                } else {
                    $err[] = "Passwords: Values entered do not match.";
                }
            } else {
                $err[] = "Passwords: ".sysMsg(6);
            }
                    
            if (!$err) {
                $q_u = sql("INSERT INTO `user` (`uname`, `email`, `pass`, `active`) VALUES ('".$usr."','".$e."','".$hash."','".$act."')");
                $last_id  = mysqli_insert_id($conn);
                $q_ue = sql("INSERT INTO `user_ext` (`uid`, `fname`, `lname`, `title`, `phone`, `mobile`, `unit`) VALUES ('".$last_id."', '".$fn."','".$ln."','".$title."','".$ph."','".$mob."','".$unit."')");
                $q_get_def = sql("SELECT `id` FROM `user_rights` WHERE `default` = '1'");
                $r_get_def = mysqli_fetch_assoc($q_get_def);
                $q_ug = sql("INSERT INTO `user_groups` (`uid`, `rid`) VALUES ('".$last_id."','".$r_get_def['id']."')");
                mkdir_chmod(SERVER_PATH.FILES_DIR.$last_id.'/');
                if ($q_u && $q_ue && $q_ug) {
                    $templateArray['{message}'] = "Adding new user now...";
                    $templateForward = "console/index.php?t=user-editor&o=view-user-groups&id=".$last_id."";
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
    } else {
        $err[] = sysMsg('57');
        $templateArray['{system-rights}'] = "none";
    }//lockout mode
}

if ($o == "add-group") {
    if (!userSystemRights($uid, "add_group")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    $templateArray['{sect_head_ext}'] = ": Add Group";
    $templateArray['{add-group}'] = "block";
    if (!D4600135D233F_LOCKOUT) {
        if ($_POST['add-group']) {
            $type = cleanNumber($_POST['grp_type']);
            if (validateInput($_POST['grp_name'])) {
                $grp_name = cleanInput($_POST['grp_name']);
            } else {
                $grp_name = $_POST['grp_name'];
                $err[] = "Group name: ".sysMsg(6);
            }
            if (!$err) {
                $q_grp = sql("INSERT INTO `user_rights` (`name`,`tid`) VALUES ('".$grp_name."','".$type."')");
                $last_id  = mysqli_insert_id($conn);
                //insert education group for rights group only
                if ($type == '4' && checkModule('education-tracker')) {
                    $q_grp_edu = sql("INSERT INTO `user_rights_edu` (`rid`) VALUES ('".$last_id."')");
                }
                if ($q_grp) {
                    $templateArray['{message}'] = "Adding new group now...";
                    $templateForward = "console/index.php?t=user-manager&o=groups";
                } else {
                    $err[] = sysMsg(8);
                }
            }
        }
    } else {
        $err[] = sysMsg('57');
        $templateArray['{system-rights}'] = "none";
    }//lockout mode
}

if ($o == "users") {
    if (!userSystemRights($uid, "view_users")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=add-user"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
    if ($del_id) {
        if ($confirm) {
            $q_del = sql("DELETE FROM `user` WHERE `id` = '".$del_id."'");
            $q_del_usr_ext = sql("DELETE FROM `user_groups` WHERE `uid` = '".$del_id."'");
            $q_del_grp = sql("DELETE FROM `user_ext` WHERE `uid` = '".$del_id."'");
            $q_ses_del = sql("DELETE FROM `user_sessions` WHERE `uid` = '".$del_id."'");
            if ($q_del && $q_del_usr_ext && $q_del_grp) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $warning[] = sysMsg(15).' <a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users&del='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users">Cancel</a>.';
        }
    }
    if (($stat == "0") || ($stat == "1")) {
        if ($id && ($id !== '1')) {
            $q_upd = sql("UPDATE `user` SET `active` = '".$stat."' WHERE `id` = '".$id."'");
            if ($q_upd) {
                $success[] = sysMsg(16);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $err[] = sysMsg(14);
        }
	}
	
		//update preferences if available
		if(cleanString($_GET['upactive']) == 'yes') {
			updUserPreference($uid, 'view-active-users', 1);
		}
		if(cleanString($_GET['upactive']) == 'no') {
			updUserPreference($uid, 'view-active-users', 0);
		}
		//get user preferences
		$usr_p = userPreference($uid,'view-active-users');
		if(!$usr_p) {
			$active = " AND u.active != 0";
			$templateArray['{checked}'] = '';
		} else {
			$active = "";
			$templateArray['{checked}'] = 'checked';
		}

    $q_user = sql("SELECT u.id, u.uname, u.email, u.active, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid ".$active." ORDER BY ue.fname ASC");
    $c_user = mysqli_num_rows($q_user);
    if (!$c_user) {
        $templateArray['{users}'] = "There are no users found.";
    } else {
        $num_limit = DISP_ROWS;
        if ($c_user > $num_limit) { //apply limits to query
            if (!$_GET['pg']) {
                $limit = " LIMIT 0, ".$num_limit."";
            } else {
                $multi = cleanNumber($_GET['pg']);
                $row = ($multi * $num_limit) - $num_limit;
                $limit = " LIMIT ".$row.", ".$num_limit."";
            }
            $q_user = sql("SELECT u.id, u.uname, u.email, u.active, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid ".$active." ORDER BY ue.fname ASC ".$limit."");
            $x = ceil($c_user/$num_limit);
            $i = 1;
            while ($i <= $x) {
                if ($i == cleanNumber($_GET['pg'])) {
                    $class = 'pagination_current';
                } else {
                    $class = 'pagination';
                }
                $pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users&pg='.$i.'" class="'.$class.'">'.$i.'</a>';
                $i++;
            }
        }
        $i = 2;
        while ($r_user = mysqli_fetch_assoc($q_user)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            if (userSystemRights($uid, "delete")) {
                if ($r_user['uname'] !== "sysadmin") {
                    $del = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users&del='.$r_user['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a>';
                } else {
                    $del = "";
                }
            }
            if ($r_user['active']) {
                $act = '0';
                $im = 'active.gif';
            } else {
                $act = '1';
                $im = 'non-active.gif';
            }
            if ($r_user['uname'] == "sysadmin") {
                $im = 'active.gif';
                $act = '1';
            }
            $status = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users&status='.$act.'&id='.$r_user['id'].'"><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></a>';
            $users .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=user-editor&o=user&id='.$r_user['id'].'">'.$r_user['uname'].'</a></td><td>'.$r_user['fname'].' '.$r_user['lname'].'</td><td>'.$r_user['email'].'</td><td>'.$status.'</td><td>'.$del.'</td></tr>';
            $i++;
        } // while
        $templateArray['{user_data}'] = '<table class="tablesorter" id="users"><thead><tr><th>Username</th><th>Full Name</th><th>Email</th><th>Status</th><th>&nbsp;</th></tr></thead><tbody>'.$users.'</tbody></table>';
    } //else c_user
} //$o=users

if ($o == "groups") {
    if (!userSystemRights($uid, "view_groups")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=add-group"><img src="'.WEBSITE_LOC.'console/_images/add.gif" class="img" /></a>';
    if ($del_id) {
        if ($confirm) {
            $q_del = sql("DELETE FROM `user_rights` WHERE `id` = '".$del_id."'");
            $q_del_grp = sql("DELETE FROM `user_groups` WHERE `rid` = '".$del_id."'");
            if (checkModule('education-tracker')) {
                $q_del_grp = sql("DELETE FROM `user_rights_edu` WHERE `rid` = '".$del_id."'");
            }
            if ($q_del && $q_del_grp) {
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            //check for users and give warnings
            $q_chk = sql("SELECT `id` FROM `user_groups` WHERE `rid` = '".$del_id."'");
            $c_chk = mysqli_num_rows($q_chk);
            if ($c_chk) {
                $warning[] = "There are associated users with this group. Deleting will remove association.";
            } else {
                $warning[] = "There are no users attached. Safe to proceed.";
            }
            $warning[] = sysMsg(15).' <a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups&del='.$del_id.'&confirm=1">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups">Cancel</a>.';
        }
    }
    if (($stat == "0") || ($stat == "1")) {
        if ($id) {
            $q_upd = sql("UPDATE `user_rights` SET `default` = '0' WHERE `id` != '".$id."'");
            $q_upd = sql("UPDATE `user_rights` SET `default` = '".$stat."' WHERE `id` = '".$id."'");
            if ($q_upd) {
                $success[] = sysMsg(16);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $err[] = sysMsg(14);
        }
    }
    $q_grp = sql("SELECT `id`, `name`, `tid`, `default` FROM `user_rights` ORDER BY `name` ASC");
    $c_grp = mysqli_num_rows($q_grp);
    if (!$c_grp) {
        $templateArray['{grp_data}'] = "There are no groups found.";
    } else {
        $num_limit = DISP_ROWS;
        if ($c_grp > $num_limit) { //apply limits to query
            if (!$_GET['pg']) {
                $limit = " LIMIT 0, ".$num_limit."";
            } else {
                $multi = cleanNumber($_GET['pg']);
                $row = ($multi * $num_limit) - $num_limit;
                $limit = " LIMIT ".$row.", ".$num_limit."";
            }
            $q_grp = sql("SELECT `id`, `name`, `tid`, `default` FROM `user_rights` ORDER BY `id`, `tid` ASC ".$limit."");
            $x = ceil($c_grp/$num_limit);
            $i = 1;
            while ($i <= $x) {
                if ($i == cleanNumber($_GET['pg'])) {
                    $class = 'pagination_current';
                } else {
                    $class = 'pagination';
                }
                $pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups&pg='.$i.'" class="'.$class.'">'.$i.'</a>';
                $i++;
            }
        }
        $i = 2;
        while ($r_grp = mysqli_fetch_assoc($q_grp)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            if (userSystemRights($uid, "delete")) {
                if ($r_grp['id'] !== "1") {
                    $del = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups&del='.$r_grp['id'].'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a>';
                }
            } else {
                $del = "";
            }
            if ($r_grp['default']) {
                $def = '0';
                $im = 'active.gif';
            } else {
                $def = '1';
                $im = 'non-active.gif';
            }
            if ($r_grp['tid'] == "4") {
                $type = "Rights";
                $status = '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups&status='.$def.'&id='.$r_grp['id'].'"><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></a>';
            } else {
                $status = "";
                $type = "Mail";
            }
            $q_chk = sql("SELECT `id` FROM `user_groups` WHERE `rid` = '".$r_grp['id']."'");
            $c_chk = mysqli_num_rows($q_chk);
            if (!$c_chk) {
                $c_chk = "0";
            }
            $groups .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o=group&id='.$r_grp['id'].'">'.$r_grp['name'].'</a></td><td>'.$type.'</td><td><a href="'.WEBSITE_LOC.'console/index.php?t=option-editor&o=view-user-groups&id='.$r_grp['id'].'">'.$c_chk.'</a></td><td>'.$status.'</td><td>'.$del.'</td></tr>';
            $i++;
        }
        $templateArray['{grp_data}'] = '<table class="tablesorter" id="groups"><thead><tr><th>Group name</th><th>Type</th><th>Users</th><th>Default</th><th>&nbsp;</th></tr></thead><tbody>'.$groups.'</tbody></table>';
    }
} //groups

if ($o == "rights") {
    if (!userSystemRights($uid, "view_rights")) {
        $err[] = sysMsg('17');
        $templateArray['{system-rights}'] = "none";
    } else {
        $templateArray['{system-rights}'] = "block";
    }
    $sect_nav_ext = '';

    if ($_POST['submit-rights']) {
        $q_id = sql("SELECT `id` FROM `user_rights` WHERE `tid` = '4' ORDER BY `id` ASC");
        while ($r_id = mysqli_fetch_assoc($q_id)) {
            $ids[] = $r_id['id'];
        }
        foreach ($ids as $k=>$v) {
            $q_cols = sql("SHOW COLUMNS FROM `user_rights`");
            $i = 0;
            $arr = "";
            while ($r_cols = mysqli_fetch_assoc($q_cols)) {
                if ($i > 4) {
                    if ($_POST[''.$r_cols['Field'].''][''.$v.'']) {
                        $arr .= "`".$r_cols['Field']."` = '1', ";
                    } else {
                        $arr .= "`".$r_cols['Field']."` = '0', ";
                    }
                }
                $i++;
            }
            $arr = substr($arr, 0, -2);
            $q_upd = sql("UPDATE `user_rights` SET ".$arr." WHERE `id` = '".$v."'");
        }
        if ($q_upd) {
            $success[] = sysMsg(9);
        }
    } //submit

    $q_headers = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` = '4' ORDER BY `id` ASC");
    while ($r_headers = mysqli_fetch_assoc($q_headers)) {
        $hd .= '<th>'.$r_headers['name'].'</th>';
    }
    $q_cols = sql("SHOW COLUMNS FROM `user_rights`");
    $i = 0;
    $z = 2;
    while ($r_cols = mysqli_fetch_assoc($q_cols)) {
        if ($i > 3) { //only show after first 3 columns
            $q_setting = sql("SELECT `id`, `".$r_cols['Field']."` FROM `user_rights` WHERE `tid` = '4' ORDER BY `id` ASC");
            $int = $z/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            $rights .= '<tr '.$tr_style.'><td>'.$r_cols['Field'].'</td>';
            while ($r_setting = mysqli_fetch_array($q_setting)) {
                if ($r_cols['Field'] == "sys_admin") {
                    $dis = 'disabled=disabled';
                } else {
                    $dis = '';
                }
                if ($r_setting[1]) {
                    $rights .= '<td><input name="'.$r_cols['Field'].'['.$r_setting['id'].']" type="checkbox" class="chk" value="1" checked="checked" '.$dis.' /></td>';
                } else {
                    $rights .= '<td><input name="'.$r_cols['Field'].'['.$r_setting['id'].']" type="checkbox" class="chk" value="1" '.$dis.' /></td>';
                }
            }
            $rights .= '</tr>';
        }
        $i++;
        $z++;
    }
    $templateArray['{rights_data}'] = '<table class="tablesorter" id="rights"><thead><tr><th>Rights</th>'.$hd.'</tr></thead><tbody>'.$rights.'</tbody></table>';
} //rights

//Nav
if (!$templateArray['{pagination}']) {
    $templateArray['{pagination}'] = '<p>'.$pagination.'</p>';
}
foreach ($sec_opts as $k => $v) {
    if ($v == $o) {
        $c = "sect_nav_c";
        $disp = "block";
        $templateArray['{sect_head_ext}'] = ": ".$k;
    } else {
        $c = "sect_nav";
        $disp = "none";
    }
    $templateArray['{section_nav}'] .= '<a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o='.$v.'" class="'.$c.'">'.$k.'</a>';
    $templateArray['{'.$v.'}'] = $disp;
}
if (!$templateArray['{sect_head_rt}']) {
    $templateArray['{sect_head_rt}'] = $sect_nav_ext;
}
if (!$templateArray['{add-user}']) {
    $templateArray['{add-user}'] = "none";
}
if (!$templateArray['{add-group}']) {
    $templateArray['{add-group}'] = "none";
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
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=user-manager&o='.$o);
//for user rights
$templateArray['{fhead-rights}'] = $fhead; $templateArray['{fend-rights}'] = $fend;
$templateArray['{submit-rights}'] = drawFld("submit", "submit-rights", "Update Rights", "", "submit");
//for user add
$templateArray['{fhead-user}'] = $fhead; $templateArray['{fend-user}'] = $fend;
$templateArray['{fn}'] = drawFld("text", "fn", $fn, "First Name *");
$templateArray['{ln}'] = drawFld("text", "ln", $ln, "Last Name *");
$templateArray['{usr}'] = drawFld("text", "usr", $usr, "Username *");
$templateArray['{title}'] = drawFld("text", "title", $title, "Job Title *");
$templateArray['{e}'] = drawFld("text", "e", $e, "Email *");
$templateArray['{pass1}'] = drawFld("password", "pass1", $pass1, "Password");
$templateArray['{pass2}'] = drawFld("password", "pass2", $pass2, "Confirm Password");
$templateArray['{ph}'] = drawFld("text", "ph", $ph, "Phone");
$templateArray['{mob}'] = drawFld("text", "mob", $mob, "Mobile");
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$act) {
    $act = "0";
}
$templateArray['{act}'] = drawSelect("act", $act_arr, $act, "Status");
$q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
$unit_arr[0] = 'All Units';
while ($r_unit = mysqli_fetch_assoc($q_unit)) {
    $unit_arr[$r_unit['id']] = $r_unit['name'];
}
$templateArray['{unit}'] = drawSelect("unit", $unit_arr, $unit, "Unit");

$templateArray['{submit-user}'] = drawFld("submit", "add-user", "Add User", "&nbsp;", "submit");
//for group add
$templateArray['{fhead-grp}'] = $fhead; $templateArray['{fend-grp}'] = $fend;
$templateArray['{group-name}'] = drawFld("text", "grp_name", $grp_name, "Group Name");
$q_type = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'user_right'");
while ($r_type = mysqli_fetch_assoc($q_type)) {
    $type_arr[''.$r_type['id'].''] = $r_type['name'];
}
$templateArray['{group-type}'] = drawSelect("grp_type", $type_arr, $type, "Group Type");
$templateArray['{submit-grp}'] = drawFld("submit", "add-group", "Add User Group", "&nbsp;", "submit");

$templateArray['{checkedurl}'] = WEBSITE_LOC.'console/index.php?t=user-manager&o='.$o.'&upactive=yes';
$templateArray['{checkedurlfalse}'] = WEBSITE_LOC.'console/index.php?t=user-manager&o='.$o.'&upactive=no';

?>