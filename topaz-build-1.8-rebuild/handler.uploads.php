<?php
define('TOPAZ', true);
include('_constants/constants.php'); include('_constants/db.php'); include('_functions/strings.php'); include('_functions/requests.php'); include('_functions/PasswordHash.php'); $error = true;
session_start(); $sid = session_id(); $uid = userID($sid); $app = 'application/octet-stream'; $view = 'attachment';
    $msg = '';
    //check force logon
    $q_sys = sql("SELECT `value` FROM `system_settings` WHERE `id` = '12'"); $r_sys = mysqli_fetch_assoc($q_sys);
    if ($r_sys[0] == '1') {
        $force_log = true;
    } else {
        $force_log = false;
    }
    if ($_GET['lvl1']) {
        $ud = UPLOAD_DIR.'files/';
        if (is_file($ud.$_GET['lvl1'])) {
            $ext = getExt($_GET['lvl1']);
            if ($force_log) {
                if (userAuthorise($sid)) {
                    $error = false;
                    if ($ext == "pdf") {
                        $app = 'application/pdf';
                        $view = 'inline';
                    }
                    // Headers for a download or view inline:
                    header('Content-Type: '.$app.'');
                    header('Content-Disposition: '.$view.'; filename="'.$_GET['lvl1'].'"');
                    header('Content-Transfer-Encoding: binary');
                    // load the file to send:
                    readfile($ud.$_GET['lvl1']);
                } else {
                    $msg = 'You must be logged in to perform this action.';
                }//edit docs rights
            } else {
                $error = false;
                if ($ext == "pdf") {
                    $app = 'application/pdf';
                    $view = 'inline';
                }
                // Headers for a download or view inline:
                header('Content-Type: '.$app.'');
                header('Content-Disposition: '.$view.'; filename="'.$_GET['lvl1'].'"');
                header('Content-Transfer-Encoding: binary');
                // load the file to send:
                readfile($ud.$_GET['lvl1']);
            }
        }
    } else {
        $msg = 'File does not exist';
    }


if ($error) {
    header('HTTP/1.0 403 Forbidden');
    echo("<h1>Forbidden</h1><p>You don't have permission to access this folder</p><p>".$msg."</p>");
}
