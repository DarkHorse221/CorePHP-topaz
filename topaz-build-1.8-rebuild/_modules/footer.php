<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}
$footer['{website_loc}'] = WEBSITE_LOC; $footer['{website_ref}'] = WEBSITE_REF;  $footer['{website_img}'] = WEBSITE_LOC.IMAGES_DIR; $footer['{website_scripts}'] = WEBSITE_LOC.SCRIPTS_DIR;
$footer['{year}'] = date("Y", time());
