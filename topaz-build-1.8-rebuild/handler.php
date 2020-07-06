<?php
define('TOPAZ', true);
include('_constants/constants.php'); include('_constants/db.php'); include('_functions/strings.php'); include('_functions/requests.php'); include('_functions/PasswordHash.php'); $error = true;
session_start(); $sid = session_id(); $uid = userID($sid);

    if ($_GET['lvl1']) {
        $ud = UPLOAD_DIR.'files/_references/';
        if (is_file($ud.$_GET['lvl1'])) {
            $ext = getExt($_GET['lvl1']);
            $exceptions = explode(';', EXCEPTIONS_LIST);
            if (in_array($ext, $exceptions)) {
                $error = false;
                // Headers for an download:
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.$_GET['lvl1'].'"');
                header('Content-Transfer-Encoding: binary');
                // load the file to send:
                readfile($ud.$_GET['lvl1']);
            } else {
                if (userSystemRights($uid, "edit_documents")) {
                    $error = false;
                    // Headers for an download:
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.$_GET['lvl1'].'"');
                    header('Content-Transfer-Encoding: binary');
                    // load the file to send:
                    readfile($ud.$_GET['lvl1']);
                } else {
                    $msg = 'You must be logged in and have the correct user rights to perform this action.';
                }//edit docs rights
            }
        } else {
            $msg = 'File does not exist';
        }
    } else {
        $msg = 'No file selected.';
    }


if ($error) {
    header('HTTP/1.0 403 Forbidden');
    echo("<h1>Forbidden</h1><p>You don't have permission to access this folder</p><p>".$msg."</p>");
}
