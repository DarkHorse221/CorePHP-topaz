<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
function logError($txt, $file = "error")
{
    $file = SERVER_PATH.LOG_DIR.$file.'.log';
    $fh = fopen($file, 'a+') or die("Error: can't open log file");
    $txt = date('Y-m-d H:i:s')." ".strip_tags($txt)."\n";
    fwrite($fh, $txt);
    fclose($fh);
}
function sysMsg($msg_id)
{
    $q_sysmsg = sql("SELECT `text` FROM `system_templates` WHERE `id` = '".$msg_id."'");
    $r_sysmsg = mysqli_fetch_assoc($q_sysmsg);
    return $r_sysmsg['text'];
}
function sysMsgEmail($msg_id)
{
    $q_sysmsg = sql("SELECT `emailText` FROM `system_templates` WHERE `id` = '".$msg_id."'");
    $r_sysmsg = mysqli_fetch_assoc($q_sysmsg);
    return $r_sysmsg['text'];
}
function writeMsgs($err, $class = "err")
{
    if ($err) {
        if ($class == "err") {
            $img = 'error.gif';
        }
        if ($class == "success") {
            $img = 'success.gif';
        }
        if ($class == "warning") {
            $img = 'warning.gif';
        }
        if ($class == "info") {
            $img = 'info.gif';
        }
        $e_out = '';

        //only do unique errs then loop thorugh to get errs (prevents duplicates)
        $err = array_unique($err);
        foreach ($err as $v) {
            if ($v) {
                $e_out .= '<p><div class="img_error"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/'.$img.'" border="0" /></div>'.$v.'</p>';
                if ($class !== "success") {
                    auditEvent($v, "", $class);
                }
            }
        }
        if ($e_out) {
            return '<div class="'.$class.'">'.$e_out.'</div>';
        } else {
            return false;
        }
    }
}
function docEvents($d, $u, $e, $link = "", $txt = "")
{
    $date = new DateTime('now');
    $date = $date->format('Y-m-d H:i:s');
    $q_ev = sql("INSERT INTO `document_events` (`did`, `uid`, `eid`, `date`, `link`, `text`) VALUES ('".$d."', '".$u."', '".$e."', '".$date."', '".$link."', '".$txt."')");
    if ($q_ev) {
        return true;
    } else {
        return false;
    }
}
function loginUser($u, $p, $sid)
{
    logOff($u, $sid);
    if (validateEmail($u)) {
        $q_chk = sql("SELECT `id`, `pass` FROM `user` WHERE `email` = '".$u."' AND `active` = '1'");
        $c_chk = mysqli_num_rows($q_chk);
    } else {
        $q_chk = sql("SELECT `id`, `pass`, `active` FROM `user` WHERE `uname` = '".$u."' AND `active` = '1'");
        $c_chk = mysqli_num_rows($q_chk);
    }
    if (!$c_chk) {
        return false;
    } else {
        $r_data = mysqli_fetch_assoc($q_chk);
        $id = $r_data['id'];
        $pass = '*';
        $pass = $r_data['pass'];
        $hasher = new PasswordHash(9, false);
        $check = $hasher->CheckPassword($p, $pass);
        if ($check) {
            $q_ext = sql("SELECT `fname`,`lname`,`terms_accept` FROM `user_ext` WHERE `uid` = '".$id."'");
            $r_ext = mysqli_fetch_assoc($q_ext);
            session_regenerate_id();
            $_SESSION['f'] = $r_ext['fname'];
            $_SESSION['l'] = $r_ext['lname'];
            $_SESSION['t'] = time();
            $_SESSION['ta'] = $r_ext['terms_accept'];
            $q_grp = sql("SELECT r.sys_admin, r.gen_admin FROM user_groups g, user_rights r WHERE g.rid=r.id AND g.uid = '".$id."'");
            while ($r_grp = mysqli_fetch_assoc($q_grp)) {
                if ($r_grp['sys_admin'] == '1') {
                    $admin = true;
                }
                if ($r_grp['gen_admin'] == '1') {
                    $admin = true;
                }
            }
            if ($admin) {
                $_SESSION['KCFINDER']['disabled'] = false;
            }
            session_write_close();
            $new_sid = session_id();
            logSession($id, $new_sid);
            auditEvent("User logged in", "", "userlogin", $r_ext['fname']." ".$r_ext['lname']);
            return true;
        } else {
            return false;
        }
    } //else
} //function
function logOff($u, $sid)
{
    $q_del = sql("DELETE FROM `user_sessions` WHERE `uid` = '".cleanString($u)."' OR `session_id` = '".cleanString($sid)."'");
    unset($_SESSION['f']);
    unset($_SESSION['l']);
    unset($_SESSION['t']);
    unset($_SESSION['ta']);
    unset($_SESSION['KCFINDER']);
    unset($_SESSION['dialog-warning']);
}
function userID($sid)
{
    $q_id = sql("SELECT `uid` FROM `user_sessions` WHERE `session_id` = '".cleanString($sid)."'");
    $r_id = mysqli_fetch_assoc($q_id);
    return $r_id['uid'];
}
function logSession($uid, $sid)
{
    $now = time();
    $q = sql("INSERT INTO `user_sessions` (`session_id`, `uid`, `session_exp`) VALUES ('".$sid."', '".$uid."', '".date("Y-m-d H:i:s", $now)."')");
}
function userSystemRights($uid, $right)
{
    $q_rgts = sql("SELECT g.rid FROM user_groups g, user_rights r WHERE g.rid=r.id AND g.uid = '".cleanNumber($uid)."' AND r.tid = '4' AND r.".cleanInput($right)." = '1'");
    $c_rgts = mysqli_num_rows($q_rgts);
    if ($c_rgts) {
        return true;
    } else {
        return false;
    }
}
function userAuthorise($sid)
{
    $q_sess = sql("SELECT `uid`, `session_exp` FROM `user_sessions` WHERE `session_id` = '".cleanString($sid)."'");
    $c_sess = mysqli_fetch_assoc($q_sess);
    if (!$c_sess) {
        return false;
    } else {
        if (isset($_SESSION['t']) && (time() - $_SESSION['t'] > 60*TIME_OUT_DELAY)) {
            $uid = userID($sid);
            logOff($uid, $sid);
            return false;
        } else {
            $time = time();
            $now = $time;
            $_SESSION['t'] = $time;
            session_write_close();
            $q_sess_update = sql("UPDATE `user_sessions` SET `session_exp` = '".date("Y-m-d H:i:s", $now)."' WHERE `session_id` = '".cleanString($sid)."'");
            return true;
        }
    }
}
function userAuthOnce($user, $p)
{
    $e = validateEmail($user);
    $p = cleanInput($p);
    if (!$e) {
        $u = validateInput($user);
        if (!$u) {
            return false;
        } else {
            $in = cleanInput($user);
        }
    } else {
        $in = cleanEmail($user);
    }
    if ($in) {
        if ($e) {
            $q_chk = sql("SELECT `id`, `pass` FROM `user` WHERE `email` = '".$in."' AND `active` = '1'");
            $c_chk = mysqli_num_rows($q_chk);
        } else {
            $q_chk = sql("SELECT `id`, `pass` FROM `user` WHERE `uname` = '".$in."' AND `active` = '1'");
            $c_chk = mysqli_num_rows($q_chk);
        }
        if (!$c_chk) {
            return false;
        } else {
            $r_data = mysqli_fetch_assoc($q_chk);
            $id = $r_data['id'];
            $pass = '*';
            $pass = $r_data['pass'];
            $hasher = new PasswordHash(9, false);
            $check = $hasher->CheckPassword($p, $pass);
            if ($check) {
                return $id;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

function userName($uid)
{
    $q_uid= sql("SELECT `fname`, `lname` FROM `user_ext` WHERE `uid` = '".$uid."'");
    $c_uid = mysqli_num_rows($q_uid);
    if (!$c_uid) {
        return false;
    } else {
        $r_uid = mysqli_fetch_assoc($q_uid);
        return $r_uid['fname']." ".$r_uid['lname'];
    }
}

function userUnit($uid)
{
    $q_uunit= sql("SELECT `unit` FROM `user_ext` WHERE `uid` = '".$uid."'");
    $c_uunit = mysqli_num_rows($q_uunit);
    if (!$c_uunit) {
        return false;
    } else {
        $r_uunit = mysqli_fetch_assoc($q_uunit);
        return $r_uunit['unit'];
    }
}

function userHomeScreen($user_id = "", $sid = "")
{
    //get user groups
    if (!$user_id) {
        $user_id = userID($sid);
    }
    $q_grp = sql("SELECT `rid` FROM `user_groups` WHERE `uid` = '".$user_id."'");
    $c_grp = mysqli_num_rows($q_grp);
    if (!$c_grp) {
        return 'home';
    } else {
        while ($r_grp = mysqli_fetch_assoc($q_grp)) {
            $grps[] = $r_grp['rid'];
        }
        $grp = implode(",", $grps);
        $q_sql = sql("SELECT dp.link AS doclink FROM document_properties dp LEFT JOIN user_rights_pages ur ON ur.did=dp.did WHERE ur.urid IN (".$grp.") ORDER BY doclink ASC LIMIT 0,1;");
        $c_sql = mysqli_num_rows($q_sql);
        //no function to deal with multiple groups yet so just redirect to secure. appleid limit in sql statementas well
        if (!$c_sql) {
            return 'home';
        } else {
            $r_sql = mysqli_fetch_assoc($q_sql);
            return $r_sql['doclink'];
        }
    } //else
}

function mkdir_chmod($dir)
{
    if (!file_exists($dir)) {
        mkdir($dir, 0777) or die("Failed to create Directory");
        chmod($dir, 0777) or die("Directory can no be chmod");
    }
}
function img_upload($f, $dir, $rw = '1000', $del = '0')
{
    mkdir_chmod($dir);
    $ext = getExt($dir.$f);
    if ($ext == 'jpg') {
        $sImg  = imagecreatefromjpeg($dir.$f) or die('Cant create jpg image');
    }
    if ($ext == 'gif') {
        $sImg  = imagecreatefromgif($dir.$f) or die('Cant create gif image');
    }
    if ($ext == 'png') {
        $sImg  = imagecreatefrompng($dir.$f) or die('Cant create png image');
    }
    list($w, $h) = getimagesize($dir.$f);
    $nImg  = imagecreatetruecolor($w, $h); //Generate blank image
    $did = date("d-m-Y", time());
    $nImg_src = $did.'-'.$f;
    imagecopyresampled($nImg, $sImg, 0, 0, 0, 0, $w, $h, $w, $h);
    if ($ext == 'jpg') {
        imagejpeg($nImg, $dir.$nImg_src, 100);
    }
    if ($ext == 'gif') {
        imagegif($nImg, $dir.$nImg_src);
    }
    if ($ext == 'png') {
        imagepng($nImg, $dir.$nImg_src);
    }
    if ($w > $rw) { //check for resize if $rw larger than original width
        $ratio = $rw / $w;
        $rh = abs($h * $ratio);
        $rImg  = imagecreatetruecolor($rw, $rh);
        $rImg_src = $did.'-rsz-'.$f;
        imagecopyresampled($rImg, $sImg, 0, 0, 0, 0, $rw, $rh, $w, $h);
        if ($ext == 'jpg') {
            imagejpeg($rImg, $dir.$rImg_src, 100);
        }
        if ($ext == 'gif') {
            imagegif($rImg, $dir.$rImg_src);
        }
        if ($ext == 'png') {
            imagepng($rImg, $dir.$rImg_src);
        }
        chmod($dir.$rImg_src, 0777);
        if ($del == '1') { //only remove original if told to
            unlink($dir.$nImg_src);
        }
    }
    unlink($dir.$f);
    chmod($dir.$nImg_src, 0777);
    return array($nImg_src, $rImg_src);
}
function generateKeys($id)
{
    $k1 = makeSalt();
    $k2 = makeSalt();
    $k3 = makeSalt();
    $k4 = makeSalt();
    $k5 = makeSalt();
    if (!$id) {
        return array($k1,$k2,$k3,$k4,$k5);
    } else {
        $q_keys = sql("UPDATE `domains` SET `key1` = '".$k1."', `key2` = '".$k2."', `key3` = '".$k3."', `key4` = '".$k4."', `key5` = '".$k5."' WHERE `id` = '".$id."'");
        if ($q_keys) {
            return true;
        } else {
            logError("Key generation failure.", "db");
            return false;
        }
    }
}
function encode($s, $k)
{
    $k = sha1($k);
    $strLen = strlen($s);
    $keyLen = strlen($k);
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($s, $i, 1));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($k, $j, 1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }
    return $hash;
}
function decode($s, $k)
{
    $k = sha1($k);
    $strLen = strlen($s);
    $keyLen = strlen($k);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($s, $i, 2)), 36, 16));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($k, $j, 1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}
function breadcrumbAdmin($id, $loc)
{
    $q_vals = sql("SELECT dp.name, dt.lft, dt.rgt FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.id = '".$id."'");
    $r_vals = mysqli_fetch_assoc($q_vals);
    $q_doc = sql("SELECT dt.id, dp.name FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.lft < '".$r_vals['lft']."' AND dt.rgt > '".$r_vals['rgt']."' ORDER BY dt.lft ASC");
    while ($r_doc = mysqli_fetch_assoc($q_doc)) {
        $n .= '<a href="'.$loc.$r_doc['id'].'">'.$r_doc['name'].'</a> > ';
    }
    if ($id == '0') {
        $ext = "";
    } else {
        $ext = " > ";
    }
    $nav .= '<a href="'.$loc.'">Root</a>'.$ext.$n.'<a href="'.$loc.$id.'">'.$r_vals['name'].'</a>';
    return $nav;
}
function breadCrumb($did, $loc)
{
    $q_vals = sql("SELECT dp.name, dt.lft, dt.rgt, dp.link FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.id = '".$did."'");
    $r_vals = mysqli_fetch_assoc($q_vals);
    $q_doc = sql("SELECT dt.id, dp.name, dp.link FROM document_tree dt, document_properties dp WHERE dt.id=dp.did AND dt.lft < '".$r_vals['lft']."' AND dt.rgt > '".$r_vals['rgt']."' ORDER BY dt.lft ASC");
    $nav .= 'You are here: ';
    while ($r_doc = mysqli_fetch_assoc($q_doc)) {
        $n .= '<a href="'.$loc.'?p='.$r_doc['link'].'">'.$r_doc['name'].'</a> > ';
    }
    $nav .= $ext.$n.'<a href="'.$loc.'?p='.$r_vals['link'].'">'.$r_vals['name'].'</a>';
    return $nav;
}
function rebuild_tree($pid, $l)
{
    $r = $l+1;
    $q_ids = sql("SELECT `id` FROM `document_tree` WHERE `parent_id` = '".$pid."'");
    while ($r_ids = mysqli_fetch_assoc($q_ids)) {
        $r = rebuild_tree($r_ids['id'], $r);
    }
    sql("UPDATE `document_tree` SET `lft` = '".$l."', `rgt`='".$r."' WHERE `id`='".$pid."'");
    return $r+1;
}
function goBack($url)
{
    $go_back = '<span class="back"><a href="'.$url.'"><img src="'.WEBSITE_LOC.IMAGES_DIR.'_layout/back-button.png" /></a></span><span class="back-txt"><a href="'.$url.'" class="back">Go Back</a></span>';
    return $go_back;
}
function getDocumentIcon($ext)
{
    $icon['pdf'] = 'icon-pdf.gif';
    $icon['docx'] = 'icon-word.png';
    $icon['docm'] = 'icon-word.png';
    $icon['dotx'] = 'icon-word.png';
    $icon['dotm'] = 'icon-word.png';
    $icon['xls'] = 'icon-excel.png';
    $icon['xlt'] = 'icon-excel.png';
    $icon['xlm'] = 'icon-excel.png';
    $icon['xlsx'] = 'icon-excel.png';
    $icon['xlsm'] = 'icon-excel.png';
    $icon['xltx'] = 'icon-excel.png';
    $icon['xltm'] = 'icon-excel.png';
    $icon['ppt'] = 'icon-powerpoint.png';
    $icon['pps'] = 'icon-powerpoint.png';
    $icon['pptx'] = 'icon-powerpoint.png';
    $icon['pptm'] = 'icon-powerpoint.png';
    $icon['potx'] = 'icon-powerpoint.png';
    $icon['potm'] = 'icon-powerpoint.png';
    $icon['mdb'] = 'icon-access.png';
    $icon['accdb'] = 'icon-access.png';
    $icon['accde'] = 'icon-access.png';
    $icon['accdt'] = 'icon-access.png';
    $icon['accdr'] = 'icon-access.png';
    $icon['pub'] = 'icon-publisher.png';
    $icon['puz'] = 'icon-publisher.png';
    $icon['vdx'] = 'icon-visio.png';
    $icon['vsd'] = 'icon-visio.png';
    $icon['vss'] = 'icon-visio.png';
    $icon['vst'] = 'icon-visio.png';
    $icon['vsx'] = 'icon-visio.png';
    $icon['vtx'] = 'icon-visio.png';
    if ($icon[''.$ext.'']) {
        return $icon[''.$ext.''];
    } else {
        return 'icon-reference.png';
    }
}
function systemSettings($sys)
{
    $q_sys = sql("SELECT `value` FROM `system_settings` WHERE `id` = '".$sys."'");
    $c_sys = mysqli_num_rows($q_sys);
    if (!$c_sys) {
        return false;
    } else {
        $r_sys = mysqli_fetch_assoc($q_sys);
        if ($r_sys['value'] == '1') {
            return true;
        } else {
            return false;
        }
    }
}

function systemSettingsValue($sys)
{
    $q_sys = sql("SELECT `value` FROM `system_settings` WHERE `id` = '".$sys."'");
    $c_sys = mysqli_num_rows($q_sys);
    if (!$c_sys) {
        return false;
    } else {
        $r_sys = mysqli_fetch_assoc($q_sys);
        return $r_sys['value'];
    }
}
function auditEvent($name = "", $short_desc = "", $type = "", $long_desc = "", $custom = "")
{
    $name = $name;
    $short_desc = $short_desc;
    $type = $type;
    $long_desc = $long_desc;
    $custom = $custom;
    $q_log_event = sql("INSERT INTO `audit_events` (`name`, `short_desc`, `type`, `long_desc`, `custom`) VALUES ('".$name."', '".$short_desc."', '".$type."', '".$long_desc."', '".$custom."')");
}
function userPreference($uid, $custom)
{
	$q_up = sql("SELECT up.value FROM `user_preferences` up JOIN `type_list` tl ON up.tid=tl.id WHERE tl.custom = '".$custom."' AND up.uid= '".$uid."'");
	$c_up = mysqli_num_rows($q_up);
	
    if ($c_up) {
		$r_up = mysqli_fetch_assoc($q_up);
        if ($r_up['value'] == 1) {
			return true;
        } else {
			return false;
        }
    } else {
        //insert value
        $q_tid = sql("SELECT `id` FROM `type_list` WHERE custom = '".$custom."'");
        $r_tid = mysqli_fetch_assoc($q_tid);
        $q_ins = sql("INSERT INTO `user_preferences` (`uid`, `tid`, `value`) VALUES ('".$uid."', '".$r_tid['id']."', '1')");
		return true;
    }
}

function updUserPreference($uid, $custom, $val)
{
    $q_tid = sql("SELECT `id` FROM `type_list` WHERE custom = '".$custom."'");
    $r_tid = mysqli_fetch_assoc($q_tid);
    $q_up_upd = sql("UPDATE `user_preferences` SET `value` = '".$val."' WHERE `uid` = '".$uid."' AND `tid` = '".$r_tid['id']."'");
    return true;
}