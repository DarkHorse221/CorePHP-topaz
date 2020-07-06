<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }	
//Paths
	define('BACKUP_DIR','_backup/');
	define('CSS_DIR','_css/');
	define('FUNCTIONS_DIR','_functions/');
	define('FILES_DIR','_files/');
	define('COURSES_DIR','_courses/');
	define('IMAGES_DIR','_images/');
	define('LOG_DIR','_log/');
	define('MODULES_DIR','_modules/');
	define('SCRIPTS_DIR','_scripts/');
	define('TEMPLATE_DIR','_templates/');
	define('UPLOAD_DIR','_uploads/');
//Server Info
	date_default_timezone_set('Australia/Perth');
	define('PATH_FROM_BASE', '');	
	define('WEBSITE_LOC', 'http://localhost/'.PATH_FROM_BASE);
	define('WEBSITE_REF', WEBSITE_LOC);
	define('SERVER_PATH', 'C:/Program Files (x86)/Ampps/www/'.PATH_FROM_BASE);
	define('SERVER_PATH_DB', ''); //use only if cloud hosted to load DB details from outside of root path
//Other definitions
	define('WEBSITE_TITLE', 'Topaz v1.8');	
	define('WEBSITE_AUTHOR', 'Innovative Informatics Pty. Ltd.');	
	define('WEBSITE_OWNER', 'Innovative Informatics Pty. Ltd.');	
//mail settings
	define('EMAIL_COLLATE', '0');
	define('EMAIL_COMPANY', 'Innovative Informatics Pty. Ltd.');
	define('ADMIN_EMAIL', 'no-reply@innovativeinformatics.com.au');
	define('ACCOUNTS_EMAIL', 'no-reply@innovativeinformatics.com.au');
	define('NO_REPLY_EMAIL', 'no-reply@innovativeinformatics.com.au');
	define('SMTP_SSL', 'tls');
	define('SMTP_HOST', '');
	define('SMTP_PORT', '587');
	define('SMTP_USER', '');
	define('SMTP_PASS', '');
	define('MAIL_SEND_CODE', 'y89isd7800JJK[]789hYtRekiYyyhlsoUqwe783nbmcb@#$!dh'); //no more than 50 characters
	define('MAIL_SEND_LIMIT', '14'); //no more than 50 characters
	if(strlen(MAIL_SEND_CODE) > 50) { echo '<div class="head_err">Mail send code is over 50 characters. Please edit in constants.php</div>'; }
//System Version
	define('SYSTEM_VERSION', 'Topaz');
	define('SYSTEM_VERSION_INFO', 'Topaz v1.8');
	define('DEMO_MODE', '0');
//AWS bucket connection for file storage
	define('AWS_STORAGE', '0');
	define('AWS_BUCKET', '');
	define('AWS_SECRET_KEY', '');
	define('AWS_KEY_SECRET', '');
?>