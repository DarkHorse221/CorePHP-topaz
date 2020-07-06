<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}

if (!userAuthorise($sid)) {
    $templateArray['{message}'] = "<p>You are not logged in. Please wait as we transfer you to login...</p>";
    $templateForward = "?p=login&o=secure";
    $templateArray['{d_nav}'] = "none";
} else {
    include('_modules/standard_arrays.php');
    $uid = userID($sid);
    $ud = SERVER_PATH.FILES_DIR.$uid.'/';
    
    //check for password reset requirement
    $q_usr = sql("SELECT `changepass` FROM `user` WHERE `id` = '".$uid."'");
    $r_usr = mysqli_fetch_assoc($q_usr);
    if ($r_usr['changepass']) {
        $lvl2 = 'change-password';
        $warning[] = 'You are using a temporary password. Please change your password immediately.';
    }
    
    if (!$lvl2) {
        $lvl2 = 'update-details';
    }
    if ($lvl2 == 'update-details') {
        $update_details = true;
        $upd_sel = 'class="selected"';
    } else {
        $update_details = false;
    }
    if ($lvl2 == 'change-password') {
        $change_password = true;
        $cp_sel = 'class="selected"';
    } else {
        $change_password = false;
    }
    if ($lvl2 == 'managers') {
        $managers = true;
        $man_sel = 'class="selected"';
    } else {
        $managers = false;
    }
    if ($lvl2 == 'credentials') {
        $credentials = true;
        $cren_sel = 'class="selected"';
    } else {
        $credentials = false;
    }
    if ($lvl2 == 'radiation-record') {
        $radiation_record = true;
        $rad_sel = 'class="selected"';
    } else {
        $radiation_record = false;
    }
    if ($lvl2 == 'post-bulletin') {
        $post_bulletin = true;
        $bb_sel = 'class="selected"';
    } else {
        $post_bulletin = false;
    }
    
    //navigation / rights
    $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=update-details" '.$upd_sel.'>User Details</a></li>';
    $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=change-password" '.$cp_sel.'>Password</a></li>';
    $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=managers" '.$man_sel.'>Managers</a></li>';
    if (userSystemRights($uid, "add_credentials")) {
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=credentials" '.$cren_sel.'>Credentials</a></li>';
    } else {
        $credentials = false;
    }
    if (checkModule('radiation-manager') && userSystemRights($uid, 'radiation')) {
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=radiation-record" '.$rad_sel.'>Radiation Record</a></li>';
    } else {
        $radiation_record = false;
    }
    if (checkModule('bulletins') && userSystemRights($uid, 'add_bulletins')) {
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=secure&o=post-bulletin" '.$bb_sel.'>Post Bulletin</a></li>';
    } else {
        $post_bulletin = false;
    }
    if (userSystemRights($uid, 'gen_admin') || userSystemRights($uid, 'sys_admin')) {
        $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_LOC.'console/index.php?t=launch">Console</a></li>';
    }
    $templateArray['{nav}'] .= '<li><a href="'.WEBSITE_REF.'?p=logoff">Log Off</a></li>';
    
    //update details
    if ($update_details) {
        if ($_POST['update-details']) {
            $ext = cleanNumber($_POST['ext']);
            $mob = cleanNumber($_POST['mob']);
            $q_upd_details = sql("UPDATE `user_ext` SET `phone` = '".$ext."', `mobile` = '".$mob."' WHERE `uid` = '".$uid."'");
            if ($q_upd_details) {
                $success[] = sysMsg(44);
            } else {
                $errs[] = sysMsg(8);
            }
        }
        //data
        $q_usr = sql("SELECT u.id, u.uname, u.email, u.active, ue.fname, ue.lname, ue.phone, ue.mobile, ue.title FROM user u, user_ext ue WHERE u.id=ue.uid AND u.id = '".$uid."'");
        $r_usr = mysqli_fetch_assoc($q_usr);
        $usr = $r_usr['uname'];
        $e = $r_usr['email'];
        $act = $r_usr['active'];
        $fn = $r_usr['fname'];
        $ln = $r_usr['lname'];
        $ext = $r_usr['phone'];
        $mob = $r_usr['mobile'];
        $title = $r_usr['title'];
        $templateArray['{nav-tabs}'] = '
		<p>'.drawFld("text", "fn", $fn, "First Name", "", "", 1).'</p>
		<p>'.drawFld("text", "ln", $ln, "Last Name", "", "", 1).'</p>
		<p>'.drawFld("text", "usr", $usr, "Username", "", "", 1).'</p>
		<p>'.drawFld("text", "e", $e, "Email", "", "", 1).'</p>
		<p>'.drawFld("text", "title", $title, "Job Title", "", "", 1).'</p>
		<p>'.drawFld("text", "ext", $ext, "Extension").'</p>
		<p>'.drawFld("text", "mob", $mob, "Mobile").'</p>
		<p>'.drawFld("submit", "update-details", "Update Details", "&nbsp;", "submit").'</p>';
    }
    //end
    
    //change password
    if ($change_password) {
        if ($_POST['change-password']) {
            $cp_sel = 'class="selected"';
            if ($_POST['pass1'] || $_POST['pass2']) {
                if (validateInput($_POST['pass1']) && validateInput($_POST['pass2'])) {
                    $pass1 = cleanInput($_POST['pass1']);
                    $pass2 = cleanInput($_POST['pass2']);
                    if ($pass1 == $pass2) {
                        if (strlen($pass1) < 73) {
                            $hasher = new PasswordHash(9, false);
                            $hash = $hasher->HashPassword($pass1);
                            if (strlen($hash) >= 20) {
                                $q_cp = sql("UPDATE `user` SET `pass` = '".$hash."', `changepass` = '0' WHERE `id` = '".$uid."'");
                                if ($q_cp) {
                                    $success[] = sysMsg(44);
                                    unset($warning);
                                } else {
                                    $errs[] = sysMsg(8);
                                }
                            } else {
                                $errs[] = "Passwords: Error hashing password";
                            }
                        } else {
                            $errs[] = "Passwords: Length must be less than 72 characters";
                        }
                    } else {
                        $errs[] = "Passwords: Values entered do not match.";
                    }
                } else {
                    $errs[] = "Passwords: ".sysMsg(6);
                }
            } else {
                $errs[] = "Passwords: ".sysMsg(6);
            }//post pass
        }
        //data
        $templateArray['{nav-tabs}'] = '<p>'.drawFld("password", "pass1", "", "Password").'</p>
		<p>'.drawFld("password", "pass2", "", "Confirm Password").'</p>
		<p>'.drawFld("submit", "change-password", "Change Password", "&nbsp;", "submit").'</p>';
    }
    //end
    //managers
    if ($managers) {
        $fext_attr = 'onsubmit="selectAllOptions(\'sm\');"';
        if ($_POST['managers']) {
            $man_sel = 'class="selected"';
            $q_del = sql("DELETE FROM `user_managers` WHERE `uid` = '".$uid."'");
            if ($q_del) {
                if ($_POST['sm']) {
                    foreach ($_POST['sm'] as $k => $v) {
                        $q_ins = sql("INSERT INTO `user_managers` (`mid`, `uid`) VALUES ('".$v."','".$uid."')");
                    }
                }
            }
            if ($q_del || $q_ins) {
                $success[] = sysMsg(44);
            } else {
                $err[] = sysMsg(8);
            }
        }
        //data
        $q_cman = sql("SELECT `mid` FROM `user_managers` WHERE `uid` = '".$uid."'");
        while ($r_cman = mysqli_fetch_assoc($q_cman)) {
            $man_arr[] = $r_cman['mid'];
        }
        $q_man = sql("SELECT u.id, ue.fname, ue.lname FROM user u, user_ext ue WHERE u.id=ue.uid AND u.active = '1' AND u.id != '".$uid."' AND u.id != '1' ORDER BY ue.fname ASC");
        while ($r_man = mysqli_fetch_assoc($q_man)) {
            if (userSystemRights($r_man['id'], "approve_credentials")) {
                if ($man_arr && in_array($r_man['id'], $man_arr)) {
                    $sm .= '<option value="'.$r_man['id'].'">'.$r_man['fname'].' '.$r_man['lname'].'</option>';
                } else {
                    $lom .= '<option value="'.$r_man['id'].'">'.$r_man['fname'].' '.$r_man['lname'].'</option>';
                }
            }
        }
        $templateArray['{nav-tabs}'] = '
		<p>You can self nominate your managers by adding your manager(s) into the "Attached Managers" window below. Managers are your direct notifcation channels for credential approval, education notifications. If no manager is selected, then the system default manager will be used.</p>
		<p class="multiple-select-h">List of Managers</p>
		<p class="switch-h">&nbsp;</p>
		<p class="multiple-select-h">Assigned Managers</p>
		<div class="clear"></div>
		<p class="multiple-select"><select name="lom[]" multiple id="lom" class="multiple-select">'.$lom.'</select></p>
		<p class="switch"><a href="#" id="add" class="text-submit">Add >></a><br /><br /><br /><a href="#" id="remove" class="text-submit"><< Remove</a></p>
		<p  class="multiple-select"><select name="sm[]" multiple id="sm" class="multiple-select">'.$sm.'</select></p>
		<div class="clear"></div><p>'.drawFld("submit", "managers", "Update Managers", "", "submit").'</p>';
    }
    //end
    //credentials
    if ($credentials) {
        $fext_attr = 'enctype="multipart/form-data"';
        if ($_POST['credentials'] || $_POST['update-credentials']) {
            require_once(SERVER_PATH.'_functions/mailout.php');
            $q_managers = sql("SELECT u.email FROM user u, user_managers um WHERE um.mid=u.id AND um.uid = '".$uid."'");
            $c_managers = mysqli_num_rows($q_managers);
            if (!$c_managers) {
                $q_managers = sql("SELECT u.email FROM user u, system_settings s WHERE s.value=u.id AND s.id = '6'");
                $r_managers = mysqli_fetch_assoc($q_managers);
                $to[] = $r_managers['email'];
            } else {
                while ($r_managers = mysqli_fetch_assoc($q_managers)) {
                    $to[] = $r_managers['email'];
                }
            }
            $to_list = implode(",", $to);
            $app = makeRandom();
            
            $q_usrn = sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$uid."'");
            $r_usrn = mysqli_fetch_assoc($q_usrn);
            $user = $r_usrn['fname'].' '.$r_usrn['lname'];
            
            $tpl = sysMsg(47);
            $tpl_arr['{user_name}'] = $user;
            $tpl_arr['{link}'] = WEBSITE_REF.'?p=credential-approval&o='.$app;
            $tpl_arr['{year}'] = date("Y", time());
            $tpl_arr['{company}'] = EMAIL_COMPANY;
            foreach ($tpl_arr as $k=>$v) {
                $ks[] = $k;
                $vs[] = $v;
            }
            $html = str_replace($ks, $vs, $tpl);
            $date_now = new DateTime('now');
            $date_now = $date_now->format('Y-m-d');
        }
        //add credentials
        if ($_POST['credentials']) {
            foreach ($_POST['id'] as $k=>$v) {
                if ($_FILES['pdf']['name'][$k]) {
                    if (getExt($_FILES['pdf']['name'][$k]) == "pdf") {
                        $pdf = makeRandom().'.'.getExt($_FILES['pdf']['name'][$k]);
                    } else {
                        $errs[] = "File (.pdf): ".sysMsg(23);
                    }
                    if (!$errs) {
                        if ($_POST['n'][$k]) {
                            $v = '';
                            $n = cleanString($_POST['n'][$k]);
                        } else {
                            $n = '';
                        }
                        move_uploaded_file($_FILES['pdf']['tmp_name'][$k], $ud.$pdf);
                        $q_cred_ins = sql("INSERT INTO `user_credentials` (`uid`, `tid`, `date`, `name`, `app`, `link`) VALUES ('".$uid."', '".$v."', '".cleanString($_POST['date'][$k])."', '".$n."', '".$app."', '".$pdf."')");
                        q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Credential(s) Require Approval', $html, $date_now, MAIL_SEND_CODE);
                    }
                }
            }
            if ($q_cred_ins) {
                $success[] = sysMsg(44);
                $lvl3 = '';
            }
        }
        //end add credentials
        
        //edit credentials
        if ($lvl3) {
            $fext = $lvl3;
            if (!$cid = cleanNumber($lvl3)) {
                $errs[] = sysMsg(4);
            }
            if (!$errs) {
                if ($_POST['update-credentials']) {
                    if ($_FILES['pdf']['name']) {
                        if (getExt($_FILES['pdf']['name']) == "pdf") {
                            $pdf = makeRandom().'.'.getExt($_FILES['pdf']['name']);
                        } else {
                            $errs[] = "File (.pdf): ".sysMsg(23);
                        }
                        if (!$errs) {
                            if ($_POST['n']) {
                                $n = cleanString($_POST['n']);
                            } else {
                                $n = '';
                            }
                            if ($_POST['tid']) {
                                $tid = cleanNumber($_POST['tid']);
                            } else {
                                $tid = '';
                            }
                            //archive old
                            $q_archive = sql("UPDATE `user_credentials` SET `archive` = '1' WHERE `uid` = '".$uid."' AND `id` = '".$lvl3."'");
                            move_uploaded_file($_FILES['pdf']['tmp_name'], $ud.$pdf);
                            $q_cred_ins = sql("INSERT INTO `user_credentials` (`uid`, `tid`, `date`, `name`, `app`, `link`) VALUES ('".$uid."', '".$tid."', '".cleanString($_POST['date'])."', '".$n."', '".$app."', '".$pdf."')");
                            q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Credential(s) Require Approval', $html, $date_now, MAIL_SEND_CODE);
                        } //errs
                    } //$files
                    if ($q_cred_ins) {
                        $success[] = sysMsg(44);
                        $lvl3 = '';
                    }
                }
                if ($lvl3) {
                    $q_cred_edit = sql("SELECT * FROM `user_credentials` WHERE `uid` = '".$uid."' AND `id` = '".$lvl3."'");
                    $c_cred_edit = mysqli_num_rows($q_cred_edit);
                    if (!$c_cred_edit) {
                        $errs[] = sysMsg(4);
                    } else {
                        $r_cred_edit = mysqli_fetch_assoc($q_cred_edit);
                        if (!$r_cred_edit['date']) {
                            $date_exp = new DateTime('now');
                            $exp_date = $date_exp->format('Y-m-d');
                        } else {
                            $exp_date = $r_cred_edit['date'];
                        }
                        $templateArray['{dates}'] .= "$(\"#editdate\").datepicker({ dateFormat: 'yy-mm-dd',defaultDate: \"$exp_date\", showButtonPanel: true });";
                        if ($r_cred_edit['tid']) {
                            $fclass = 'highlight';
                            $msg = 'Update mandatory credentials';
                            $q_ctype = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_cred_edit['tid']."'");
                            $r_ctype = mysqli_fetch_assoc($q_ctype);
                            $cred_name = drawFld("text", "n", $r_ctype['name'], "Credential Name", "", "", 1);
                        } else {
                            $fclass = 'highlight-nonm';
                            $msg = 'Update personal credentials';
                            $cred_name = drawFld("text", "n", $r_cred_edit['name'], "Credential Name");
                        }
                        //data
                        $cred_ext .='
					<br /><fieldset class="'.$fclass.'"><legend class="'.$fclass.'">'.$msg.'</legend>
					<p>Please update credential details here</p>
					<p>'.drawFld("hidden", "tid", $r_cred_edit['tid']).$cred_name.'</p>
					<p><label>Expiry Date</label><input type="text" id="editdate" name="date" value="'.$exp_date.'" class="date_inp" />
					<p>'.drawFld("file", "pdf", "", "Document (.pdf)").'</p>
					<p>'.drawFld("submit", "update-credentials", "Update credentials", "&nbsp;", "submit").'
					<a href="'.WEBSITE_REF.'?p=secure&o=credentials" class="text-submit-cancel">Cancel</a></p></fieldset>';
                    } //$c_cred_edit
                } //!$lvl3
            } //$errs
        } //$lvl3 / cred edit
        
        //table data out
        $q_man_cred = sql("SELECT tl.id, tl.name FROM type_list tl, user_rights_ext ure, user_groups ug WHERE tl.id=ure.tid AND ure.rid=ug.rid AND ug.uid = '".$uid."' AND tl.group = 'cred_type' GROUP BY tl.id, tl.name ORDER BY tl.name ASC");
        while ($r_man_cred = mysqli_fetch_assoc($q_man_cred)) {
            $cred_arr[''.$r_man_cred['id'].''] = $r_man_cred['name'];
        }
        $q_cred = sql("SELECT * FROM `user_credentials` WHERE `uid` = '".$uid."' AND `archive` = '0' ORDER BY `name` ASC");
        $i = '0';
        while ($r_cred = mysqli_fetch_assoc($q_cred)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            if (array_key_exists($r_cred['tid'], $cred_arr)) {
                unset($cred_arr[''.$r_cred['tid'].'']);
            }
            if ($r_cred['tid']) {
                $q_type = sql("SELECT `name` FROM `type_list` WHERE `id` = '".$r_cred['tid']."'");
                $r_type = mysqli_fetch_assoc($q_type);
                $name = $r_type['name'];
            } else {
                $name = $r_cred['name'];
            }
                            
            if (is_file(SERVER_PATH.FILES_DIR.$uid.'/'.$r_cred['link'])) {
                $link = '<a href="'.WEBSITE_LOC.FILES_DIR.$uid.'/'.$r_cred['link'].'" target="_blank"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/certificate.gif" style="vertical-align: middle;" /></a>';
                $file_not_found = false;
            } else {
                $link = '<img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/certificate-error.gif" style="vertical-align: middle;" />';
                $file_not_found = true;
            }
            
            $date = $r_cred['date'];
                        
            if ($r_cred['app']) {
                if ($file_not_found) {
                    $app = 'Unapproved';
                } else {
                    $app = 'Pending Approval';
                }
            } else {
                $date_now = new DateTime('now');
                $date_now = $date_now->format('Y-m-d');
                if ($r_cred['date'] < $date_now) {
                    if ($file_not_found) {
                        $app = 'Unapproved';
                    } else {
                        $app = 'Expired';
                    }
                } else {
                    if ($file_not_found) {
                        $app = 'Unapproved';
                    } else {
                        $app = 'Approved';
                    }
                }
            }
            $cred_rows .= '<tr '.$tr_style.'><td>'.$link.' <a href="'.WEBSITE_REF.'?p=secure&o=credentials&v='.$r_cred['id'].'">'.$name.'</a></td><td>'.dateConvert($date).'</td><td>'.$app.'</td></tr>';
            $i++;
        }
        $templateArray['{nav-tabs}'] = '<table id="credentials" class="tablesorter"><thead><tr><th>Credential Name</th><th>Expiry</th><th>Status</th></thead><tbody>'.$cred_rows.'</tbody></table>'.$cred_ext;
    
    
        //credentials extended / mandatory criteria missing
        if (!$lvl3) {
            $i = 0;
            if ($cred_arr) {
                foreach ($cred_arr as $k=>$v) {
                    if (!$exp_date) {
                        $date_exp = new DateTime('now');
                        $exp_date = $date_exp->format('Y-m-d');
                    }
                    $templateArray['{dates}'] .= "$(\"#date$i\").datepicker({ dateFormat: 'yy-mm-dd',defaultDate: \"$exp_date\", showButtonPanel: true });";
                    $templateArray['{nav-tabs}'] .='
				<br /><fieldset class="highlight"><legend class="highlight">Missing Mandatory Credential: '.$v.'</legend>
				<p>Please upload your credential details immediately</p>
				<p>'.drawFld("hidden", "id[$i]", $k).drawFld("text", "n[$i]", $v, "Credential Name", "", "", 1).'</p>
				<p><label>Expiry Date</label><input type="text" id="date'.$i.'" name="date['.$i.']" value="'.$exp_date.'" class="date_inp" />
				<p>'.drawFld("file", "pdf[$i]", "", "Document (.pdf)").'</p>
				<p>'.drawFld("submit", "credentials", "Add credentials", "&nbsp;", "submit").'</p></fieldset>';
                    $i++;
                }
            }
            //add non manadatory credential fields
            if (!$exp_date) {
                $date_exp = new DateTime('now');
                $exp_date = $date_exp->format('Y-m-d');
            }
            $templateArray['{dates}'] .= "$(\"#date$i\").datepicker({ dateFormat: 'yy-mm-dd',defaultDate: \"$exp_date\", showButtonPanel: true });";
            $form_id = "add-credentials";
            $templateArray['{nav-tabs}'] .= '<p><a href="#" id="button" class="text-submit">Add Personal Credential</a></p>
		<br /><fieldset class="highlight-nonm" id="add-personal-credentials"><legend class="highlight-nonm">Add personal credentials</legend>
		<p>Please upload your personal credential details here</p>
		<p>'.drawFld("hidden", "id[$i]", '').drawFld("text", "n[$i]", '', "Credential Name", "", "", "", 1).'</p>
		<p><label>Expiry Date</label><input type="text" id="date'.$i.'" name="date['.$i.']" value="'.$exp_date.'" class="date_inp" /></p>
		<p>'.drawFld("file", "pdf[$i]", "", "Document (.pdf)").'</p>
		<p>'.drawFld("submit", "credentials", "Add credentials", "", "submit").' '.drawFld("button", "cancel", "Cancel", "&nbsp;", "submit-cancel").'</p></fieldset>';
        } //$!lvl3
    } //end credentials
    
    //Radiation Record
    if ($radiation_record) {
        $q_rads = sql("SELECT `dose`, `date`, YEAR(date) AS `year` FROM `radiation_manager` WHERE `uid` ='".$uid."' ORDER BY `date` DESC");
        $c_rads = mysqli_num_rows($q_rads);
        if (!$c_rads) {
            $templateArray['{nav-tabs}'] = '<p>'.sysMsg(19).'</p>';
        } else {
            $i = 2;
            while ($r_rads = mysqli_fetch_assoc($q_rads)) {
                $int = $i/2;
                if (is_int($int)) {
                    $tr_style = 'class = "odd"';
                } else {
                    $tr_style = '';
                }
                if (!$max_date) {
                    $max_date = $r_rads['date'];
                }
                $min_date = $r_rads['date'];
                if (is_numeric($r_rads['dose'])) {
                    $total += $r_rads['dose'];
                    $unit = " mSv";
                } else {
                    $unit = "";
                }
                $rad_tbl .= '<tr '.$tr_style.'><td>'.$r_rads['date'].'</td><td>'.$r_rads['dose'].$unit.'</td></tr>';
                $i++;
            }
            if (!$total) {
                $total = "MIN";
            }
            $templateArray['{nav-tabs}'] = '
			<p><span style="font-weight:bold;">Date range of dose report:</span> '.$min_date.' - '.$max_date.'
			<p><span style="font-weight:bold;">Total accumulated radiation dose:</span> '.$total.' mSv</p> <table id="radiation" class="tablesorter"><thead><tr><th>Date</th><th>Dose (mSv)</th></thead><tbody>'.$rad_tbl.'</tbody></table>';
        }
    }
    //end
    
    //Post Bulletin
    if ($post_bulletin) {
        if ($_POST['publish-bulletin']) {
            $bb_date = cleanString($_POST['bb_date']);
            $bb_tid = cleanNumber($_POST['type']);
            $notice = $_POST['notice'];
            $btitle = cleanString($_POST['btitle']);
                
            foreach ($_POST['notification'] as $k=>$v) {
                if ($k == '0') {
                    $all = true;
                }
                $rid[] = $k;
            }
            $rights = implode(',', $rid);
                
                
            if ($all) {
                $q_rights = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` = '4' AND `id` != '1' ORDER BY `id` ASC");
                while ($r_rights = mysqli_fetch_assoc($q_rights)) {
                    $all_rights[] = $r_rights['id'];
                }
                foreach ($all_rights as $k=>$v) {
                    $all_rids[] = $v;
                }
                $rights = implode(',', $all_rids);
            }
            if (!$btitle) {
                $errs[] = 'Title must be specified';
            }
            if (!$notice) {
                $errs[] = 'There must be some text to send';
            }
            
            if (!$errs) {
                $q_add_bb = sql("INSERT INTO `bb` (`title`, `date`, `tid`, `rid`, `uid`, `text`) VALUES ('".$btitle."','".$bb_date."', '".$bb_tid."', '".$rights."', '".$uid."', '".$notice."')");
                //add to mail list
                require_once(SERVER_PATH.'_functions/mailout.php');
                if ($bb_tid == '31') {
                    $tpl_arr['{urgent}'] = 'URGENT: ';
                } else {
                    $tpl_arr['{urgent}'] = '';
                }
                $tpl = sysMsg(45);
                $tpl_arr['{title}'] = $btitle;
                $tpl_arr['{notice}'] = $notice;
                $tpl_arr['{year}'] = date("Y", time());
                $tpl_arr['{company}'] = EMAIL_COMPANY;
                foreach ($tpl_arr as $k=>$v) {
                    $ks[] = $k;
                    $vs[] = $v;
                }
                $html = str_replace($ks, $vs, $tpl);
                    
                if ($_POST['notification']) {
                    foreach ($_POST['notification'] as $k=>$v) {
                        if ($k == '0') {
                            $email = 'all';
                        } else {
                            $q_list = sql("SELECT u.email FROM user u, user_groups ur WHERE u.id=ur.uid AND ur.rid = '".$k."' AND u.active = '1'");
                            $c_list = mysqli_num_rows($q_list);
                            if ($c_list) {
                                while ($r_list = mysqli_fetch_assoc($q_list)) {
                                    $to[] = $r_list['email'];
                                }
                            }
                        }
                    }
                } //if notification
                    
                if ($email == 'all') {
                    $q_usr = sql("SELECT `value` FROM `system_settings` WHERE `id`= '3'");
                    $r_usr = mysqli_fetch_assoc($q_usr);
                    if ($r_usr['value']) {
                        $to[] = $r_usr['value'];
                    } else {
                        $q_email = sql("SELECT `email` FROM `user` WHERE `active` = '1'");
                        while ($r_email = mysqli_fetch_assoc($q_email)) {
                            $to[] = $r_email['email'];
                        }
                    }
                } //email all
                $to = array_unique($to);
                $to_list = implode(",", $to);
                q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Bulletin Notice', $html, $bb_date, MAIL_SEND_CODE);
            
                if ($q_add_bb) {
                    $success[] = sysMsg(46);
                    $bb_date = '';
                    $notice = '';
                    $bb_tid = '';
                } else {
                    $errs[] = sysMsg(8);
                }
            }//$errs
        } //$post
    
        //data
        $q_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'bulletin'");
        while ($r_typ = mysqli_fetch_assoc($q_typ)) {
            $t_arr[$r_typ['id']] = $r_typ['name'];
        }
        if (!$type) {
            $type = "30";
        }
        if (!$bb_date) {
            $date_bb = new DateTime('now');
            $bb_date = $date_bb->format('Y-m-d');
        }
        
        //notifcation groups
        $q_usr_rights = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` = '4' AND `id` != '1' ORDER BY `id` ASC");
        $c_usr_rights = mysqli_num_rows($q_usr_rights);
        $i = 1;
        $lim = ($c_usr_rights - 1) / 3;
        $sel_rights = explode(',', $rights);
        while ($r_usr_rights = mysqli_fetch_assoc($q_usr_rights)) {
            if ($i == 1) {
                $std_beg = '<span class="std-grp">';
            } else {
                $std_beg = '';
            }
            if ($i > $lim) {
                $std_end = '</span>';
                $i=1;
            } else {
                $i++;
                $std_end = '';
            }
            if (in_array($r_usr_rights['id'], $sel_rights)) {
                $sel = 'checked="checked"';
            } else {
                $sel = '';
            }
            $notf .= $std_beg.'<p><label>'.$r_usr_rights['name'].'</label><input type="checkbox" name="notification['.$r_usr_rights['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
        }
        $notify = '<p>'.drawFld("checkbox", "notification[0]", 1, "Notify all users?", "chk").'</p>'.$notf;
        
        //generate html for input
        
        $templateArray['{dates}'] .= "$(\"#bb_date\").datepicker({ dateFormat: 'yy-mm-dd',defaultDate: \"$bb_date\", showButtonPanel: true });";
        $templateArray['{nav-tabs}'] = '
		<p>To add a bulletin notice, please enter in the details below. Please note that all bulletin notices are emailed to users on the publish date.</p>
		<p>'.drawSelect("type", $t_arr, $type, "Notification type").'</p>
		<p><label>Publish Date</label><input type="text" id="bb_date" name="bb_date" value="'.$bb_date.'" class="date_inp" /></p>
		<div id="match-lt">'.$notify.'</div>
		<p>'.drawFld("text", "btitle", $btitle, "Title").'</p>
		<p>'.drawTxtBox("notice", $notice).'</p>
		<p>'.drawFld("submit", "publish-bulletin", "Publish Bulletin", "", "submit").'</p>';
        $templateArray['{ck}'] = "CKEDITOR.replace( 'notice', { toolbar : 'Limited', height: 140 });";
    }
    //end
    
    //do dialog warnings
    if (!$_SESSION['dialog-warning']) {
		$q_man_grp = sql("SELECT tl.id, tl.name FROM type_list tl
							LEFT JOIN user_rights_ext ure ON tl.id=ure.tid
							LEFT JOIN user_groups ug ON ure.rid=ug.rid
							WHERE ug.uid = '".$uid."' AND tl.group = 'cred_type' AND tl.custom = 'yes' GROUP BY tl.id ORDER BY tl.name ASC");
        $c_man_grp = mysqli_num_rows($q_man_grp);
        if ($c_man_grp) {
            while ($r_man_grp = mysqli_fetch_assoc($q_man_grp)) {
                $man_grp[''.$r_man_grp['id'].''] = $r_man_grp['name'];
            }
        }
        
        $date_now = new DateTime('now');
        $date_now = $date_now->format('Y-m-d');
        $q_usr_cred = sql("SELECT uc.name, uc.date, uc.app, tl.id, tl.name AS man_type FROM user_credentials uc LEFT JOIN type_list tl ON uc.tid=tl.id WHERE uc.uid = '".$uid."' AND uc.archive = '0' ORDER BY man_type, uc.name ASC");
        $c_usr_cred = mysqli_num_rows($q_usr_cred);
            
        if ($c_usr_cred) {
            //check records are still ok and remove ids from $man_grp if they exist
            
            while ($r_usr_cred = mysqli_fetch_assoc($q_usr_cred)) {
                if (array_key_exists($r_usr_cred['id'], $man_grp)) {
                    unset($man_grp[''.$r_usr_cred['id'].'']);
                }
                
                if (!$r_usr_cred['app']) { //do only if documents approved
                    if ($r_usr_cred['date'] <= $date_now) {
                        $app = '<span class="expired">Expired: ';
                        $expired = true;
                    } else {
                        $date1 = date_create($date_now);
                        $date2 = date_create($r_usr_cred['date']);
                        $days = date_diff($date1, $date2);
                        $days = $days->format('%a');
                        if ($days <= 30) {
                            $app = 'Expires in <strong>'.$days.'</strong> days: ';
                        } else {
                            $app = '';
                        }
                    }
                    if ($app) {
                        if ($r_usr_cred['name']) {
                            $name = $r_usr_cred['name'];
                        }
                        if ($r_usr_cred['man_type']) {
                            $name = $r_usr_cred['man_type'];
                        }
                        $dialog .= '<li>Test'.$app.$name.'</li>';
                    }
                }
            } //while
        }
        if ($man_grp) {
            foreach ($man_grp as $k=>$v) {
                $man_dialog .= '<li>Missing Mandatory Credential: '.$v.'</li>';
            }
        }

        if ($dialog || $man_dialog) {
            if ($man_dialog || $expired) {
                $templateArray['{dialog_bg}'] = '#CC0000';
                if ($man_dialog) {
                    $title = 'Missing Essential Credentials detected!';
                } else {
                    $title = 'Expired Credentials detected!';
                }
            } else {
                $templateArray['{dialog_bg}'] = '#FFCC00';
                $title = 'Warnings detected';
            }
            $templateArray['{dialog-warnings}'] = '<div id="dialog-message" title="'.$title.'">
			<p>The system has detected warning notifications with the following documents: <ul>'.$man_dialog.$dialog.'</ul></p><p>Please update your documents immediately. <a href="'.WEBSITE_REF.'?p=secure&o=credentials">Click here to view</a></p>
			</div>';
        } else {
            $templateArray['{dialog_bg}'] = '#FFF';
        }
    } //do dialogs
    $templateArray['{fhead}'] = '<form method="post" action="'.WEBSITE_REF.'?p=secure&o='.$lvl2.'&v='.$fext.'" '.$fext_attr.' id="'.$form_id.'">';
    $templateArray['{fend}'] = '</form>';
    if (!$success) {
        $templateArray['{success}'] = '';
    } else {
        $templateArray['{success}'] = '<div class="errors">'.writeMsgs($success, "success").'</div>';
    }
    if (!$errs) {
        $templateArray['{error}'] = '';
    } else {
        $templateArray['{error}'] = writeMsgs($errs);
    }
    if (!$warning) {
        $templateArray['{warning}'] = '';
    } else {
        $templateArray['{warning}'] = writeMsgs($warning, "warning");
    }
    if (!$templateArray['{d_nav}']) {
        $templateArray['{d_nav}'] = 'block';
    }
    if (!$templateArray['{nav-tabs}']) {
        $templateArray['{nav-tabs}'] = '';
    }
    if (!$templateArray['{dates}']) {
        $templateArray['{dates}'] = '';
    }
    if (!$templateArray['{ck}']) {
        $templateArray['{ck}'] = '';
    }
}
if (!$templateArray['{dialog-warnings}']) {
    $templateArray['{dialog-warnings}'] = '';
} $templateArray['{uid}'] = $uid;
