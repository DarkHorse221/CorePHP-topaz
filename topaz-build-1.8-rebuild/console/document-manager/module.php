<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
//set options
$uid = userID($sid);
$o = cleanInput($_GET['o']); $pid = cleanNumber($_GET['pid']); $cid = cleanNumber($_GET['cid']); $search = cleanInput($_GET['search']);
$del_id = cleanNumber($_GET['del']); $confirm = cleanNumber($_GET['confirm']); $stat = cleanNumber($_GET['status']); $move = cleanInput($_GET['move']); $mid = cleanNumber($_GET['mid']); $pagn = cleanNumber($_GET['pg']);

if (!$pid) {
    $pid = "0";
} if (!$o) {
    $o = "documents";
} $doc_no_setting = systemSettings('11');
//edit user
$sect_head = "Document Manager";

if (!userSystemRights($uid, "edit_documents")) {
    $err[] = sysMsg('17');
    $templateArray['{system-rights}'] = "none";
} else {
    $templateArray['{system-rights}'] = "block";
}

if ($o == "add-documents") { //not add etc.
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    if ($pid) {
        $templateArray['{add-documents}'] = "block";
        $templateArray['{sect_head_ext}'] = ": Add Document";
        if (!D4600135D233F_LOCKOUT) {
            if ($_POST['add-doc']) {
                if ($doc_no_setting) {
                    $doc_no = cleanInput($_POST['doc_number_h']);
                } else {
                    $doc_no = cleanInput($_POST['doc_number']);
                }
                $act = cleanNumber($_POST['act']);
                $unit = cleanNumber($_POST['unit']);
                $imp_date = cleanString($_POST['date-imp']);
                $rev_date = cleanString($_POST['date-rev']);
                $doc_type = cleanNumber($_POST['doc_type']);
                $author = cleanInput($_POST['author']);
                $reviewer = cleanInput($_POST['reviewer']);
                $approver = cleanInput($_POST['approver']);
                $version = cleanNumber($_POST['version_h']);
                if (!$version) {
                    $version = "0";
                }
                $no_revision_date = cleanNumber($_POST['no_revision_date']);
                if ($no_revision_date) {
                    $rev_date = '0000-00-00';
                }
                $stan = $_POST['std'];
                if ($stan) {
                    foreach ($stan as $k=>$v) {
                        $stds[] = $k;
                    }
                    $stan = implode(';', $stds);
                }
                $q_doc = sql("SELECT `docno` FROM `document_properties` WHERE `docno` = '".$doc_no."'");
                $c_doc = mysqli_num_rows($q_doc);
                if ($c_doc) {
                    if ($doc_no_setting) {
                        $doc_no = docNumber();
                    } else {
                        $doc_no = $doc_no.'_1';
                    }
                    $warning[] = "Document number was updated to prevent document number duplication.";
                }
                if (validateInput($_POST['name'])) {
                    $name = cleanInput($_POST['name']);
                } else {
                    $name = $_POST['name'];
                    $err[] = "Document name: ".sysMsg(6);
                    $n_err = "input_err";
                }
                if (validateInput($_POST['doc-link'])) {
                    $doc_link = strtolower(sanitize($_POST['doc-link']));
                } else {
                    $doc_link = strtolower(sanitize($_POST['name']));
                }
                $q_chk = sql("SELECT `did` FROM `document_properties` WHERE `link` = '".$doc_link."'");
                $c_chk = mysqli_num_rows($q_chk);
                if ($c_chk) {
                    $doc_link = $doc_link."-".$doc_no;
                }
        
        
                $exceptions = explode(';', EXCEPTIONS_LIST);
                if ($_FILES['pdf']['name']) {
                    if (getExt($_FILES['pdf']['name']) == "pdf") {
                        $version = "1";
                        $pdf = $doc_no.'_v'.$version.'.'.getExt($_FILES['pdf']['name']);
                    } elseif (in_array(getExt($_FILES['pdf']['name']), $exceptions)) {
                        $version = "1";
                        $pdf = $doc_no.'_v'.$version.'.'.getExt($_FILES['pdf']['name']);
                    } else {
                        $err[] = "File 1 (pdf;".EXCEPTIONS_LIST."): ".sysMsg(23);
                        $p_err = "input_err";
                    }
                }
                if ($_FILES['doc']['name']) {
                    $version = "1";
                    $doc = $doc_no.'_v'.$version.'.'.getExt($_FILES['doc']['name']);
                }
        
        
                if (!$err) {
                    //get privacy of parent
                    $q_privacy = sql("SELECT `private` FROM `document_properties_ext` WHERE `did` = '".$pid."'");
                    $c_privacy = mysqli_num_rows($q_privacy);
                    if (!$c_privacy) {
                        $private = '';
                    } else {
                        $r_privacy = mysqli_fetch_assoc($q_privacy);
                        $private = $r_privacy['private'];
                    }
        
                    $q_dt = sql("INSERT INTO `document_tree` (`parent_id`) VALUES ('".$pid."')");
                    $last_id  = mysqli_insert_id($conn);
                    $q_dp = sql("INSERT INTO `document_properties` (`did`, `name`, `link`, `active`, `docno`, `author`, `reviewer`, `approver`, `doc_type`, `imp_date`, `rev_date`, `unit`) VALUES ('".$last_id."','".$name."', '".$doc_link."', '".$act."', '".$doc_no."', '".$author."', '".$reviewer."', '".$approver."', '".$doc_type."', '".$imp_date."', '".$rev_date."', '".$unit."')");
                    $q_dpe = sql("INSERT INTO `document_properties_ext` (`did`, `pdf`, `doc`, `version`, `standards`,`private`) VALUES ('".$last_id."', '".$pdf."', '".$doc."', '".$version."', '".$stan."', '".$private."')");
                    rebuild_tree(0, 0);
                    docEvents($last_id, $uid, 66);
                    $q_doc_search = sql("INSERT INTO `document_search` (`did`, `name`, `link`, `keywords`, `gentext`, `active`) VALUES ('".$last_id."', '".$name."', '".$doc_link."','', '', '".$act."')");
                    $ud = SERVER_PATH.UPLOAD_DIR.'files/';
                    $udr = SERVER_PATH.UPLOAD_DIR.'files/_references/';
                    if ($_FILES['pdf']['name']) {
                        move_uploaded_file($_FILES['pdf']['tmp_name'], $ud.$pdf);
                        docEvents($last_id, $uid, 24, $pdf);
                        docEvents($last_id, $uid, 28, $version);
            
                        include(SERVER_PATH.'_functions/class.pdf2text.php');
                        //use pdf extraction class
                        $a = new PDF2Text();
                        $a->setFilename($ud.$pdf);
                        $a->decodePDF();
                        $text = $a->output();
                        //remove all irrelevant punctuation
                        $gentext = preg_replace('/[^a-z ]+/i', '', $text);
                        //get keywords list
                        $words = extractCommonWords($gentext, 15);
                        $keywords = implode(',', array_keys($words));
                        $q_doc_search = sql("UPDATE `document_search` SET `keywords` = '".$keywords."', `gentext` = '".$gentext."' WHERE `did` = '".$last_id."'");
                
                        if (AWS_STORAGE) {
                            $payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$pdf.'&objectsource=display');
                        }
                    } //files
                    if ($_FILES['doc']['name']) {
                        move_uploaded_file($_FILES['doc']['tmp_name'], $udr.$doc);
                        docEvents($last_id, $uid, 26, $doc);
                    }
            
                    if (AWS_STORAGE) {
                        $payload = file_get_contents(WEBSITE_LOC.'api/aws-s3/upload.php?objectname='.$doc.'&objectsource=references');
                    }
            
                    //do notifications
                    if ($_POST['notification']) {
                        $read_request = false;
                        foreach ($_POST['notification'] as $k=>$v) {
                            if ($k == '0') {
                                $email = 'all';
                                $read_request_notf = 'All Groups';
                            } else {
                                $q_list = sql("SELECT u.email, u.id FROM user u, user_groups ur WHERE u.id=ur.uid AND ur.rid = '".$k."' AND u.active = '1'");
                                $c_list = mysqli_num_rows($q_list);
                                if ($c_list) {
                                    while ($r_list = mysqli_fetch_assoc($q_list)) {
                                        $to[] = $r_list['email'];
                                        $ids[] = $r_list['id'];
                                    }
                                }
                        
                                $q_usr_rights_grp = sql("SELECT `name` FROM `user_rights` WHERE `id` = '".$k."'");
                                $r_usr_rights_grp = mysqli_fetch_assoc($q_usr_rights_grp);
                                $read_request_notfi .= $r_usr_rights_grp['name'].',';
                            }
                        }
                        if (!$read_request_notf) {
                            $read_request_notf = substr($read_request_notfi, 0, -1);
                        }
            
                        include('../_functions/mailout.php');
                        $tmp = sysMsg(62);
                        $t_arr['{link}'] = WEBSITE_LOC.'?p='.$doc_link;
                        $t_arr['{doc_name}'] = $name;
                        $t_arr['{year}'] = date("Y", time());
                        $t_arr['{company}'] = EMAIL_COMPANY;
                        if ($_POST['read_request']) {
                            $t_arr['{read_request}'] = '<p>You have been request to acknowledge reading this document.<p>
										<div>
<!--[if mso]>
  <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="'.WEBSITE_LOC.'?p='.$doc_link.'&o=read-request" style="height:40px;v-text-anchor:middle;width:300px;" arcsize="10%" stroke="f" fillcolor="#d62828">
    <w:anchorlock/>
    <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">
      Button Text Here!
    </center>
  </v:roundrect>
  <![endif]-->
  <![if !mso]>
  <table cellspacing="0" cellpadding="0"> <tr> 
  <td align="center" width="300" height="40" bgcolor="#d62828" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
    <a href="'.WEBSITE_LOC.'?p='.$doc_link.'&o=read-request" style="font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">
    <span style="color: #ffffff;">
      Complete read request
    </span>
    </a>
  </td> 
  </tr> </table> 
  <![endif]>
</div>';
                        } else {
                            $t_arr['{read_request}'] = "<p>Please ensure that you have read the new document.</p>";
                        }
                
                        foreach ($t_arr as $k=>$v) {
                            $ks[] = $k;
                            $vs[] = $v;
                        }
                        $html = str_replace($ks, $vs, $tmp);
                        $date_now = new DateTime('now');
                        $date_now = $date_now->format('Y-m-d');
                        if ($email == 'all') {
                            $q_usr = sql("SELECT `value` FROM `system_settings` WHERE `id`= '3'");
                            $r_usr = mysqli_fetch_assoc($q_usr);
                            if ($r_usr['value']) {
                                $to[] = $r_usr['value'];
                            } else {
                                $q_email = sql("SELECT `id`, `email` FROM `user` WHERE `active` = '1'");
                                while ($r_email = mysqli_fetch_assoc($q_email)) {
                                    $to[] = $r_email['email'];
                                    $ids[] = $r_email['id'];
                                }
                            }
                        }
                        $to = array_unique($to);
                        $to_list = implode(",", $to);
                        $ids = array_unique($ids);
                        q_smtpmailer($to_list, NO_REPLY_EMAIL, WEBSITE_OWNER, 'Document has been added', $html, $date_now, MAIL_SEND_CODE);
                
                        //add to history
                        if ($_POST['read_request']) {
                            docEvents($last_id, $uid, 60, "", $read_request_notf);
                            $last_id_de  = mysqli_insert_id($conn);
                            foreach ($ids as $k=>$v) {
                                $q_ins = sql("INSERT INTO `document_reads` (`did`, `deid`,`uid`) VALUES ('".$last_id."','".$last_id_de."','".$v."')");
                            }
                        }
                    }
                    //end notifications
            
        
            
                    if ($q_dt && $q_dp) {
                        $o = "documents";
                        $templateArray['{add-documents}'] = "none";
                        $templateArray['{sect_head_ext}'] = "";
                        $sect_nav_ext = "";
                        $success[] = sysMsg(9);
                    } else {
                        $err[] = sysMsg(8);
                    }
                }
            }
            $q_sett = sql("SELECT `value` FROM `system_settings` WHERE `id` = '2'");
            $r_sett = mysqli_fetch_assoc($q_sett);
            $q_std = sql("SELECT * FROM `standards` WHERE `type` = '".$r_sett['value']."'");
            if ($err) {
                $standards = explode(';', $stan);
            }
            $i=1;
            $lim = 12;
            while ($r_std = mysqli_fetch_assoc($q_std)) {
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
                if ($err) {
                    if (in_array($r_std['id'], $standards)) {
                        $sel = 'checked="checked"';
                    } else {
                        $sel = '';
                    }
                }
                $std .= $std_beg.'<p><label class="chk">'.$r_std['name'].'</label><input type="checkbox" name="std['.$r_std['id'].']" value="1" class="chk" '.$sel.' /></p>'.$std_end;
            }
            $templateArray['{standards}'] = $std;
        } else {
            $err[] = sysMsg('57');
            $templateArray['{system-rights}'] = "none";
        }//lockout mode
    } else {
        $err[] = sysMsg('4');
        $templateArray['{system-rights}'] = "none";
    }
}

if ($o == "add-folder") { //not add etc.
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/cancel.gif" class="img" /></a>';
    if ($pid) {
        $templateArray['{add-folder}'] = "block";
        $templateArray['{sect_head_ext}'] = ": Add Folder";
        if (!D4600135D233F_LOCKOUT) {
            if ($_POST['add-folder']) {
                $doc_no = cleanNumber($_POST['doc_number_h']);
                $act = cleanNumber($_POST['act']);
                $unit = cleanNumber($_POST['unit']);
                $fold_type = cleanNumber($_POST['fold_type']);
                $version = cleanNumber($_POST['version_h']);
                if (!$version) {
                    $version = "0";
                }
                $q_doc = sql("SELECT `docno` FROM `document_properties` WHERE `docno` = '".$doc_no."'");
                $c_doc = mysqli_num_rows($q_doc);
                if ($c_doc) {
                    $doc_no = docNumber();
                    $warning[] = "Document number was updated to prevent document number duplication.";
                }
                if (validateInput($_POST['name'])) {
                    $name = cleanInput($_POST['name']);
                } else {
                    $name = $_POST['name'];
                    $err[] = "Folder name: ".sysMsg(6);
                    $n_err = "input_err";
                }
                if (validateInput($_POST['doc-link'])) {
                    $doc_link = strtolower(sanitize($_POST['doc-link']));
                } else {
                    $doc_link = strtolower(sanitize($_POST['name']));
                }
                $q_chk = sql("SELECT `did` FROM `document_properties` WHERE `link` = '".$doc_link."'");
                $c_chk = mysqli_num_rows($q_chk);
                if ($c_chk) {
                    $doc_link = $doc_link."-".$doc_no;
                }
        
        
                if (!$err) {
                    //get privacy of parent
                    $q_privacy = sql("SELECT `private` FROM `document_properties_ext` WHERE `did` = '".$pid."'");
                    $c_privacy = mysqli_num_rows($q_privacy);
                    if (!$c_privacy) {
                        $private = '';
                    } else {
                        $r_privacy = mysqli_fetch_assoc($q_privacy);
                        $private = $r_privacy['private'];
                    }
        
                    $q_dt = sql("INSERT INTO `document_tree` (`parent_id`) VALUES ('".$pid."')");
                    $last_id  = mysqli_insert_id($conn);
                    $q_dp = sql("INSERT INTO `document_properties` (`did`, `name`, `link`, `active`, `docno`, `author`, `reviewer`, `approver`, `doc_type`, `imp_date`, `rev_date`, `unit`) VALUES ('".$last_id."','".$name."', '".$doc_link."', '".$act."', '".$doc_no."', '', '', '', '".$fold_type."', '', '0000-00-00', '".$unit."')");
                    $q_dpe = sql("INSERT INTO `document_properties_ext` (`did`, `pdf`, `doc`, `version`, `standards`,`private`) VALUES ('".$last_id."', '', '', '".$version."', '', '".$private."')");
                    rebuild_tree(0, 0);
                    docEvents($last_id, $uid, 66);
            
                    if ($q_dt && $q_dp) {
                        $o = "documents";
                        $templateArray['{add-folder}'] = "none";
                        $templateArray['{sect_head_ext}'] = "";
                        $sect_nav_ext = "";
                        $success[] = sysMsg(9);
                    } else {
                        $err[] = sysMsg(8);
                    }
                }
            }
        } else {
            $err[] = sysMsg('57');
            $templateArray['{system-rights}'] = "none";
        }//lockout mode
    } else {
        $err[] = sysMsg('4');
        $templateArray['{system-rights}'] = "none";
    }
}


if ($o == "documents") { //not add etc.
    $templateArray['{documents}'] = "block";
    if (cleanInput($_POST['move-submit'])) {
        $new_pid = cleanNumber($_POST['new_pid']);
        $doc_id = cleanNumber($_POST['doc_id']);
        if ($new_pid && $doc_id) {
            $q_move = sql("UPDATE `document_tree` SET `parent_id` = '".$new_pid."' WHERE `id` = '".$doc_id."'");
            if ($q_move) {
                $success[] = sysMsg(21);
                $pid = $new_pid;
                rebuild_tree(0, 0);
            } else {
                $err[] = sysMsg(22);
            }
        } else {
            $err[] = sysMsg(4);
        }
    }
    if ($del_id) {
        if ($confirm) {
            $q_del = sql("DELETE FROM `document_properties` WHERE `did` = '".$del_id."'");
            $q_del_tree = sql("DELETE FROM `document_tree` WHERE `id` = '".$del_id."'");
            $q_del_prop_ext = sql("DELETE FROM `document_properties_ext` WHERE `did` = '".$del_id."'");
            $q_del_events = sql("DELETE FROM `document_events` WHERE `did` = '".$del_id."'");
            $q_del_search = sql("DELETE FROM `document_search` WHERE `did` = '".$del_id."'");
            if ($q_del && $q_del_tree) {
                rebuild_tree(0, 0);
                $success[] = sysMsg(13);
            } else {
                $err[] = sysMsg(14);
            }
        } else {
            $q_chk = sql("SELECT `lft`, `rgt` FROM `document_tree` WHERE `id` = '".$del_id."'");
            $r_chk = mysqli_fetch_assoc($q_chk);
            $chk = $r_chk['rgt'] - $r_chk['lft'];
            if ($chk == '1') {
                $warning[] = sysMsg(15).' <a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&del='.$del_id.'&confirm=1&pg='.$pagn.'">Continue</a> or <a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&pg='.$pagn.'">Cancel</a>.';
            } else {
                $err[] = sysMsg(20);
            }
        }
    }
    if (($stat == "0") || ($stat == "1")) {
        if ($cid && ($cid !== '1')) {
            $q_upd = sql("UPDATE `document_properties` SET `active` = '".$stat."' WHERE `did` = '".$cid."'");
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
    if (cleanString($_GET['upactive']) == 'yes') {
        updUserPreference($uid, 'view-active-documents', 1);
    }
    if (cleanString($_GET['upactive']) == 'no') {
        updUserPreference($uid, 'view-active-documents', 0);
    }
    //get user preferences
    $usr_p = userPreference($uid, 'view-active-documents');
    if (!$usr_p) {
        $active = " AND dp.active != 0";
        $templateArray['{checked}'] = '';
    } else {
        $active = "";
        $templateArray['{checked}'] = 'checked';
    }


    $q_cat = sql("SELECT dt.id, dt.lft, dt.rgt, dp.name, dp.link, dp.active, dp.rev_date, dp.lock, dp.doc_type, dpe.private FROM document_tree dt, document_properties dp, document_properties_ext dpe WHERE dt.id=dp.did AND dt.id=dpe.did AND dt.parent_id = '".$pid."' ".$active." ORDER BY dp.name ASC");
    $c_cat = mysqli_num_rows($q_cat);
    if ($c_cat) {
        $num_limit = DISP_ROWS;
        if ($c_cat > $num_limit) { //apply limits to query
            if (!$_GET['pg']) {
                $limit = " LIMIT 0, ".$num_limit."";
            } else {
                $multi = cleanNumber($_GET['pg']);
                $row = ($multi * $num_limit) - $num_limit;
                $limit = " LIMIT ".$row.", ".$num_limit."";
            }
            $q_cat = sql("SELECT dt.id, dt.lft, dt.rgt, dp.name, dp.link, dp.active, dp.rev_date, dp.lock, dp.doc_type, dpe.private FROM document_tree dt, document_properties dp, document_properties_ext dpe WHERE dt.id=dp.did AND dt.id=dpe.did AND dt.parent_id = '".$pid."' ORDER BY dp.name ASC ".$limit."");
            $x = ceil($c_cat/$num_limit);
            $i = 1;
            while ($i <= $x) {
                if ($i == cleanNumber($_GET['pg'])) {
                    $class = 'pagination_current';
                } else {
                    $class = 'pagination';
                }
                $pagination .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&pg='.$i.'" class="'.$class.'">'.$i.'</a>';
                $i++;
            }
        }
        $i = 2;
        $date_now = new DateTime('now');
        $date_now = $date_now->format('Y-m-d');
        while ($r_cat = mysqli_fetch_assoc($q_cat)) {
            $int = $i/2;
            if (is_int($int)) {
                $tr_style = 'class = "odd"';
            } else {
                $tr_style = '';
            }
            $d = $r_cat['rgt'] - $r_cat['lft'];
            if (($d > 1) || ($r_cat['doc_type'] == '37')) {
                $d_typ = 'folder.gif';
            } else {
                $d_typ = 'doc.gif';
            }
            if ($pid == '0') {
                $d_typ = 'folder.gif';
            }
            if ($r_cat['lock']) {
                $lck = ' <img src="'.WEBSITE_LOC.'console/_images/lock.png" class="img" />';
            } else {
                $lck = "";
            }
            if ($r_cat['private']) {
                $priv = ' <img src="'.WEBSITE_LOC.'console/_images/priv.png" class="img" />';
            } else {
                $priv = "";
            }
            if ($pid) {
                $d_move = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&move=true&mid='.$r_cat['id'].'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/move.gif" class="img" /></a>';
            } else {
                $d_move = "";
            }
            if (userSystemRights($uid, "delete")) {
                $del = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&del='.$r_cat['id'].'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/delete.gif" class="img" /></a>';
            } else {
                $del = '';
            }
            if ($r_cat['active']) {
                $act = '0';
                $im = 'active.gif';
            } else {
                $act = '1';
                $im = 'non-active.gif';
            }
            $status = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&status='.$act.'&cid='.$r_cat['id'].'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/'.$im.'" class="img" /></a>';
            if ($r_cat['id'] == '1') {
                $del = "";
                $status = "";
            }
            $doc_tree .= '<tr '.$tr_style.'><td width="30">';
            //check if last in the level
            if (($d == 1) && !($r_cat['doc_type'] == '37')) {
                $doc_tree .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&id='.$r_cat['id'].'&pg='.$pagn.'">';
            } else {
                $doc_tree .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&pid='.$r_cat['id'].'&pg='.$pagn.'">';
            }
            $doc_tree .= '<img src="'.WEBSITE_LOC.'console/_images/'.$d_typ.'" class="img" /></a></td><td>';
            //check if last in the level
            if (($d == 1) && !($r_cat['doc_type'] == '37')) {
                $doc_tree .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&id='.$r_cat['id'].'&pg='.$pagn.'">'.$r_cat['name'].'</a>';
            } else {
                $doc_tree .= '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&pid='.$r_cat['id'].'">'.$r_cat['name'].'</a>';
            }
            $doc_tree .= $lck.$priv.'</td><td width="40">'.$status.'</td><td width="40"><a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&id='.$r_cat['id'].'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/edit.gif" class="img" /></a></td><td width="40">'.$d_move.'</td><td width="40">'.$del.'</td></tr>';
            $i++;
        } //while
        $templateArray['{doc_tree}'] = '<table id="documents" class="tablesorter"><tbody>'.$doc_tree.'</tbody></table>';
    } else {
        $templateArray['{doc_tree}'] = sysMsg(19);
    } //if
}

if ($search) {
    if (cleanInput($_POST['search-submit'])) {
        $st = $_POST['searched'];
        
        if (!$st) {
            $templateArray['{doc_tree}'] = sysMsg(19);
        } else {
            $q_search = sql("SELECT `did`, `name`, `link`, `doc_type`, MATCH(`name`, `link`, `docno`) AGAINST ('".$st."*' IN BOOLEAN MODE) AS `score` FROM `document_properties` WHERE MATCH(`name`, `link`, `docno`) AGAINST ('".$st."*' IN BOOLEAN MODE) ORDER BY `score` DESC");
            $c_search = mysqli_num_rows($q_search);
            if (!$c_search) {
                $templateArray['{doc_tree}'] = sysMsg(19);
            } else {
                while ($r_search = mysqli_fetch_assoc($q_search)) {
                    if ($r_search['doc_type'] == '37') {
                        $d_typ = 'folder.gif';
                    } else {
                        $d_typ = 'doc.gif';
                    }
                    $docs .= '<tr><td><a href="'.WEBSITE_LOC.'console/index.php?t=document-editor&id='.$r_search['did'].'"><img src="'.WEBSITE_LOC.'console/_images/'.$d_typ.'" class="img" /> '.$r_search['name'].'</a></td><td>'.($r_search['score']*100).'%</td></tr>';
                }
                $templateArray['{doc_tree}'] = '<table id="search" class="tablesorter"><thead><tr><th>Document</th><th>Match (%)</th></tr></thead><tbody>'.$docs.'</tbody></table>';
            }
        }
    }
}


if (!$pid) {
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&search=true"><img src="'.WEBSITE_LOC.'console/_images/search.gif" class="img" /></a>';
} elseif (!$sect_nav_ext) {
    $sect_nav_ext = '<a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid='.$pid.'&search=true"><img src="'.WEBSITE_LOC.'console/_images/search.gif" class="img" /></a><a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=add-documents&pid='.$pid.'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/add-document.gif" class="img" /></a><a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=add-folder&pid='.$pid.'&pg='.$pagn.'"><img src="'.WEBSITE_LOC.'console/_images/add-folder.gif" class="img" /></a>';
} else {
    $sect_nav_ext = $sect_nav_ext;
}

//Nav
if (!$templateArray['{section_nav}']) {
    $templateArray['{section_nav}'] = breadcrumbAdmin($pid, WEBSITE_LOC.'console/index.php?t=document-manager&pid=');
}
if (!$sect_head) {
    $sect_head = "Error";
}
if (!$templateArray['{sect_head}']) {
    $templateArray['{sect_head}'] = $sect_head;
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
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=document-manager&o='.$o.'&pid='.$pid, "", "", true);

//for document add /folder add
$templateArray['{fhead-doc}'] = $fhead; $templateArray['{fend-doc}'] = $fend;
$templateArray['{name}'] = drawFld("text", "name", $name, "Document Name", $n_err);
$templateArray['{author}'] = drawFld("text", "author", $author, "Author");
$templateArray['{reviewer}'] = drawFld("text", "reviewer", $reviewer, "Reviewer");
$templateArray['{approver}'] = drawFld("text", "approver", $approver, "Approver");
$templateArray['{doc-link}'] = drawFld("text", "doc-link", $doc_link, "Link (Slug)");
if (!$doc_no) {
    $doc_no = docNumber();
}
if ($doc_no_setting || ($o == "add-folder")) {
    $templateArray['{doc_no}'] = drawFld("text", "doc_number", $doc_no, "Document Number", "", "", 1);
    $templateArray['{doc_no_h}'] = drawFld("hidden", "doc_number_h", $doc_no);
} else {
    $templateArray['{doc_no}'] = drawFld("text", "doc_number", $doc_no, "Document Number");
    $templateArray['{doc_no_h}'] = '';
}
if (!$imp_date) {
    $date_imp = new DateTime('now');
    $imp_date = $date_imp->format('Y-m-d');
}
if (!$templateArray['{date-imp}']) {
    $templateArray['{date-imp}'] = $imp_date;
}
if (!$rev_date) {
    $date_rev = new DateTime('now');
    $date_rev->add(new DateInterval('P1Y'));
    $rev_date = $date_rev->format('Y-m-d');
}
if (!$templateArray['{date-rev}']) {
    $templateArray['{date-rev}'] = $rev_date;
}
$templateArray['{no_rev_date}'] = '<input type="checkbox" name="no_revision_date" value="1" '.$sel.' class="chk" />';
//for folder add
$templateArray['{fhead-folder}'] = $fhead; $templateArray['{fend-folder}'] = $fend;
$templateArray['{submit-folder}'] = drawFld("submit", "add-folder", "Add Folder", "&nbsp;", "submit");

//notifcation groups
$q_usr_rights = sql("SELECT `id`, `name` FROM `user_rights` WHERE `tid` = '4' ORDER BY `id` ASC");
$c_usr_rights = mysqli_num_rows($q_usr_rights);
$i = 1; $lim = ($c_usr_rights - 1) / 2;

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
    $notf .= $std_beg.'<p>'.drawFld("checkbox", "notification[".$r_usr_rights['id']."]", 1, $r_usr_rights['name'], "chk").'</p>'.$std_end;
}
$templateArray['{notification}'] = '<span class="std-grp"><p>'.drawFld("checkbox", "notification[0]", 1, "Notify document add to ALL users?", "chk").'</p></span>
<span class="std-grp shadow"><p>'.drawFld("checkbox", "read_request", 1, "Request read acknowledgement?", "chk").'</p></span>
<br /><p style="font-weight:bold;">Or specify groups:</p>'.$notf;
//notifcation groups

$templateArray['{submit-doc}'] = drawFld("submit", "add-doc", "Add Document", "&nbsp;", "submit");
$act_arr = array("0" => "Disabled","1" => "Active"); if (!$act) {
    $act = "1";
}
$templateArray['{act}'] = drawSelect("act", $act_arr, $act, "Status");

$q_unit = sql("SELECT * FROM `type_list` WHERE `group` = 'units' ORDER BY `name` ASC");
$unit_arr[0] = 'All Units';
while ($r_unit = mysqli_fetch_assoc($q_unit)) {
    $unit_arr[$r_unit['id']] = $r_unit['name'];
}
$templateArray['{unit}'] = drawSelect("unit", $unit_arr, $unit, "Unit");

if (!$version) {
    $version = "0";
}
$templateArray['{version}'] = drawFld("text", "version", $version, "Version", "date", "", 1);
$templateArray['{version_h}'] = drawFld("hidden", "version_h", $version);
$templateArray['{pdf}'] = drawFld("file", "pdf", "", "Display File (pdf;".EXCEPTIONS_LIST.")", $p_err);
$templateArray['{doc}'] = drawFld("file", "doc", "", "Reference File", $d_err);

$q_doc_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'doc_type' AND `id` != '37' ORDER BY `name` ASC");
while ($r_doc_typ = mysqli_fetch_assoc($q_doc_typ)) {
    $type_arr[''.$r_doc_typ['id'].''] = $r_doc_typ['name'];
}
$templateArray['{doc_type}'] = drawSelect("doc_type", $type_arr, $doc_type, "Document Type");

$q_fold_typ = sql("SELECT `id`, `name` FROM `type_list` WHERE `group` = 'doc_type' AND `id` = '37' ORDER BY `name` ASC");
while ($r_fold_typ = mysqli_fetch_assoc($q_fold_typ)) {
    $fold_type_arr[''.$r_fold_typ['id'].''] = $r_fold_typ['name'];
}
$templateArray['{fold_type}'] = drawSelect("fold_type", $fold_type_arr, $fold_type, "Document Type");

if (!$templateArray['{pagination}']) {
    $templateArray['{pagination}'] = '<p>'.$pagination.'</p>';
}
if (!$templateArray['{add-documents}']) {
    $templateArray['{add-documents}'] = 'none';
}
if (!$templateArray['{add-folder}']) {
    $templateArray['{add-folder}'] = 'none';
}
if (!$templateArray['{doc_tree}']) {
    $templateArray['{doc_tree}'] = "";
}
if (!$templateArray['{documents}']) {
    $templateArray['{documents}'] = "none";
}
if (!$templateArray['{sect_head_ext}']) {
    $templateArray['{sect_head_ext}'] = "";
}

//for search
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=document-manager&o='.$o.'&pid='.$pid.'&search='.$search);
$info[] = $fhead.drawFld("text", "searched", "").drawFld("hidden", "search-submit", "true").drawFld("submit", "search-box", "", "", "search").$fend;
if ($search) {
    $templateArray['{info}'] = writeMsgs($info, "info");
} if (!$templateArray['{info}']) {
    $templateArray['{info}'] = '';
}

//for move
unset($warning);
list($fhead, $fend) = drawFormTags('p', WEBSITE_LOC.'console/index.php?t=document-manager&o='.$o.'&pid='.$pid);
$q_doc = sql("SELECT dp.name, dt.lft, dt.rgt, dp.doc_type FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.id = '".$mid."'"); $r_doc = mysqli_fetch_assoc($q_doc);
$q_nodes = sql("SELECT `lft`, `rgt` FROM `document_tree` WHERE `parent_id` = '0'"); $r_nodes = mysqli_fetch_assoc($q_nodes); $right = array();
$q_desc = sql("SELECT dt.id, dt.lft, dt.rgt, dp.name, dp.doc_type FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.lft BETWEEN '".$r_nodes['lft']."' AND '".$r_nodes['rgt']."' ORDER BY dt.lft ASC");
while ($r_desc = mysqli_fetch_assoc($q_desc)) {
    if (count($right)>0) {
        while ($right[count($right)-1]<$r_desc['rgt']) {
            array_pop($right);
        }
    }
    if (!(($r_desc['lft'] >= $r_doc['lft']) && ($r_desc['rgt'] <= $r_doc['rgt']))) {
        if ($r_desc['doc_type'] == '37' || $r_desc['id'] == '1') {
            $folder_arr[''.$r_desc['id'].''] = str_repeat("- ", count($right)).$r_desc['name'];
        }
        $right[] = $r_desc['rgt'];
    }
}
$warning[] = '<p>You are about to move a document and its child nodes</p><br />'.$fhead.'<p>'.drawFld("hidden", "doc_id", $mid, "").drawFld("text", "doc_to_move", $r_doc['name'], "Document name", "", "", 1).'</p><p>'.drawSelect("new_pid", $folder_arr, $new_pid, "New Parent Node").'</p><p>'.drawFld("submit", "move-submit", "Move Document", "&nbsp;", "submit").' or <a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&pid='.$pid.'&pg='.$pagn.'">Cancel</a></p>'.$fend;
if ($move) {
    $templateArray['{warning}'] = writeMsgs($warning, "warning");
} if (!$templateArray['{warning}']) {
    $templateArray['{warning}'] = '';
}


$templateArray['{checkedurl}'] = WEBSITE_LOC.'console/index.php?t=document-manager&pid='.$pid.'&upactive=yes';
$templateArray['{checkedurlfalse}'] = WEBSITE_LOC.'console/index.php?t=document-manager&pid='.$pid.'&upactive=no';
