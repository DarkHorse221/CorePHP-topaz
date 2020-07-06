<?php if(!defined('TOPAZ')) { die("Unauthorised access detected."); }
if(DEMO_MODE) { $header['{demo_mode}'] = '<div id="demo">!!! THIS VERSION OF EVO DMS IS IN DEMO MODE FOR TRAINING PURPOSES ONLY !!!</div>'; $header['{logo}'] = 'console_logo.jpg'; } else { $header['{demo_mode}'] = ''; $header['{logo}'] = 'console_logo.jpg'; }
if(D4600135D233F_LOCKOUT) { $header['{lockout_mode}'] = '<div id="lockout">!!! YOUR LICENCE KEY HAS EXPIRED. LOCKOUT MODE ENABLED !!!</div>'; } else { $header['{lockout_mode}'] = ''; }

$header['{website_loc}'] = WEBSITE_LOC; $header['{website_img}'] = WEBSITE_LOC.IMAGES_DIR; $header['{website_scripts}'] = WEBSITE_LOC.SCRIPTS_DIR;
$header['{website_loc}'] = WEBSITE_LOC; $header['{title}'] = WEBSITE_TITLE;
if(userAuthorise($sid)) {
	$header['{nav}'] = '
	<ul id="menu" class="topmenu">
	<li class="topfirst"><a href="'.WEBSITE_LOC.'console/index.php?t=launch" style="height:18px;line-height:18px;">Home</a></li>
	<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=user-manager" style="height:18px;line-height:18px;"><span>User Manager</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=users">Manage Users</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=groups">Manage Groups</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=user-manager&o=rights">Manage Rights</a></li>
	</ul></li>';
	
	if(checkModule('media-manager') && $cmod['media-manager']) {
	$header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=media-manager" style="height:18px;line-height:18px;">Media Manager</a></li>';
	}
	
	if(checkModule('radiation-manager') && $cmod['radiation-manager']) {
	$header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager" style="height:18px;line-height:18px;"><span>Radiation Manager</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager&o=view-radiation">View Radiation Records</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=radiation-manager&o=add-radiation">Add Radiation Records</a></li>
	</ul></li>'; }
	
	if(checkModule('bulletin-board') && $cmod['bulletin-board']) {
	$header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=bulletin-board" style="height:18px;line-height:18px;">Bulletins</a></li>';
	}
	
	$header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=document-manager" style="height:18px;line-height:18px;">Document Manager</a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=document-manager&o=documents&pid=0&search=true">Search documents</a></li>
	</ul>
	</li>
	';
	
	if(checkModule('education-tracker') && $cmod['education-tracker']) {
	$header['{nav}'] .= '
	<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker" style="height:18px;line-height:18px;"><span>Education</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=ins">In-services</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=education-tracker&o=conf">Conferences</a></li>
		';
	$header['{nav}'] .= '</ul></li>';
	}
	
	if(checkModule('rt-qa-audits') && $cmod['rt-qa-audits']) {
	$header['{nav}'] .= '
	<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=rt-qa-audits" style="height:18px;line-height:18px;"><span>RT Audits</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=rt-qa-audits&o=rt-qa-records">RT QA Records</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=rt-qa-audits&o=rt-qa-checklist">RT QA Checklist</a></li>
	</ul></li>';
	}
	
	if(checkModule('machine-qa') && $cmod['machine-qa']) {
	$header['{nav}'] .= '
	<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa" style="height:18px;line-height:18px;"><span>Machine QA</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-records">QA Records</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=qa-checklist">QA Checklist</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=machine-qa&o=machine-list">Machine List</a></li>
	</ul></li>';
	}
	
	if(checkModule('faults') && $cmod['faults']) {
	$header['{nav}'] .= '
		<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=faults" style="height:18px;line-height:18px;">Faults Manager</a></li>';
	}
	
	if(checkModule('checklist-manager') && $cmod['checklist-manager']) {
	$header['{nav}'] .= '
		<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=checklist-manager" style="height:18px;line-height:18px;">Checklist Manager</a></li>';
	}
	
	if(checkModule('qa-audits') && $cmod['qa-audits']) {
	$header['{nav}'] .= '
	<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits" style="height:18px;line-height:18px;"><span>Audit Manager</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-records">Records</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=qa-audits&o=qa-checklist">Audits</a></li>
	</ul></li>';
	}
	
	if(checkModule('reports') && $cmod['reports']) { $header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=reports" style="height:18px;line-height:18px;">Reports</a></li>'; }
	
	if(checkModule('system') && $cmod['system']) {	$header['{nav}'] .= '<li class="topmenu"><a href="'.WEBSITE_LOC.'console/index.php?t=system" style="height:18px;line-height:18px;"><span>System</span></a>
	<ul>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=system&o=information">System Information</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=system&o=settings">System Settings</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=system&o=typelists">Type List Manager</a></li>
		<li><a href="'.WEBSITE_LOC.'console/index.php?t=system&o=email-templates">Email Templates</a></li>
	</ul>
	
	</li>'; }
	$header['{nav}'] .= '<li class="toplast"><a href="'.WEBSITE_LOC.'console/index.php?t=logoff" style="height:18px;line-height:18px;">Log Off</a></li>
</ul>';
} else { $header['{nav}'] = ''; }
?>