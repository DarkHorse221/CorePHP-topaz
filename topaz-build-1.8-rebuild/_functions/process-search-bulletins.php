<?php define('TOPAZ', true);
include('../_constants/constants.php'); include('../_constants/db.php'); include('strings.php'); include('requests.php');
$search = cleanInput($_POST['queryString']); $date = new DateTime('now'); $curr_date = $date->format('Y-m-d');
$q_search = sql("SELECT `id`, `date`, `title`, MATCH(`title`, `text`) AGAINST ('".$search."*' IN BOOLEAN MODE) AS `score` FROM `bb` WHERE MATCH(`title`, `text`) AGAINST ('".$search."*' IN BOOLEAN MODE) AND `date` <= '".$curr_date."' ORDER BY `score` DESC LIMIT 0,".SEARCH_ROWS."");
$c_search = mysqli_num_rows($q_search); $docs = '';
if($c_search) { $i = 2;
	while($r_search = mysqli_fetch_assoc($q_search)) {
		$date = new DateTime(''.$r_search['date'].''); $date = $date->format('jS F Y');
		$int = $i/2; if(is_int($int)) { $tr_style = 'class = "odd"'; } else {$tr_style = ''; }
		$docs .= '<tr '.$tr_style.'><td><a href="'.WEBSITE_REF.'?p=bulletins&o=summary&v='.$r_search['id'].'">'.$r_search['title'].'</a></td><td>'.$date.'</td><td>'.($r_search['score']*100).'%</td></tr>';
		$i++;
	}
	$msg = '<table id="search" class="tablesorter"><thead><tr><th>Bulletin</th><th>Post Date</th><th>Match (%)</th></tr></thead><tbody>'.$docs.'</tbody></table>';
} else { $msg = '<p>No bulletins that match your search criteria.</p>'; }
echo($msg);
?>