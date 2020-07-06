<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
$q_list = sql("SELECT tl.id, tl.name, st.link FROM type_list tl LEFT JOIN system_templates_ext ste ON ste.dtid=tl.id LEFT JOIN system_templates st ON ste.stid=st.id WHERE tl.group = 'doc_type' AND tl.id != '37' ORDER BY tl.name ASC");

if (userAuthorise($sid)) {
    $q_usr_grps = sql("SELECT `rid` FROM `user_groups` WHERE `uid` = '".userID($sid)."'");
    $c_usr_grps = mysqli_num_rows($q_usr_grps);
    if ($c_usr_grps) {
        while ($r_usr_grps = mysqli_fetch_assoc($q_usr_grps)) {
            $groups[] = $r_usr_grps['rid'];
        }
    }
}


while ($r_list = mysqli_fetch_assoc($q_list)) {
    if ($lvl2 == $r_list['id']) {
        $sel = ' class="selected"';
    } else {
        $sel = '';
    }
    $types .= '<li><a href="#'.$r_list['id'].'"'.$sel.'>'.$r_list['name'].'</a></li>';
    $types_list .= '<div id="'.$r_list['id'].'">';
    $class = $r_list['link'];
    if (!$class) {
        $class = 'document';
    }
    $q_docs = sql("SELECT dp.name, dp.link, dpe.pdf, dpe.private, dpe.related_docs FROM document_properties dp LEFT JOIN document_properties_ext dpe ON dp.did=dpe.did WHERE dp.active = '1' AND dp.doc_type = '".$r_list['id']."' ORDER BY dp.name ASC");
    while ($r_docs = mysqli_fetch_assoc($q_docs)) {
        
        //private folders
        if ($r_docs['private']) {
            if (userAuthorise($sid)) {
                $priv_display = false;
                $private = explode(';', $r_docs['private']);
                foreach ($private as $k=>$v) {
                    if (in_array($v, $groups)) {
                        $priv_display = true;
                    }
                }
            } else {
                $priv_display = false;
            }
        } else {
            $priv_display = true;
        }
        
        if ($priv_display) {
            if (AWS_STORAGE) {
                $file_url = WEBSITE_LOC.'api/aws-s3/document.php?objectname='.$r_docs['pdf'].'&s='.$sid;
            } else {
                $file_url = WEBSITE_LOC.UPLOAD_DIR.'files/'.$r_docs['pdf'];
            }
			
			if($r_docs['related_docs']) {
				$rel_docs = ' <a href="'.WEBSITE_REF.'?p='.$r_docs['link'].'" class="sm_prop">(Related Documents)</a>';
			} else { 
				$rel_docs = '';
			}

            if ($r_docs['pdf']) {
                $docs .= '<li><span class="'.$class.'"><a href="'.$file_url.'" target="_blank">'.$r_docs['name'].'</a>'.$rel_docs.' <a href="'.WEBSITE_REF.'?p='.$r_docs['link'].'" class="sm_prop">(Properties)</a></span></li>';
            } else {
                $docs .= '<li><span class="'.$class.'"><a href="'.WEBSITE_REF.'?p='.$r_docs['link'].'">'.$r_docs['name'].'</a>'.$rel_docs.'</span></li>';
            }
        }
    }
    if (!$docs) {
        $docs = '<p>No documents found.</p>';
    }
    $types_list .= '<ul id="subtree">'.$docs.'</ul></div>';
    $docs = '';
}
$templateArray['{types}'] = $types; $templateArray['{types-list}'] = $types_list;
