<?php
define('TOPAZ', true);
include('../../_constants/constants.php'); include('../../_constants/db.php'); include('../../_functions/requests.php'); include('../../_functions/strings.php');
backup_tables(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
function backup_tables($host,$user,$pass,$name,$tables = '*') {
  if($tables == '*') {
    $tables = array(); $q_tabs = sql('SHOW TABLES');
    while($r_tabs = mysqli_fetch_row($q_tabs)) { $tables[] = $r_tabs[0]; }
  } else { $tables = is_array($tables) ? $tables : explode(',',$tables); }
  foreach($tables as $table) {
    $result = sql('SELECT * FROM '.$table); $num_fields = mysqli_num_fields($result);
    $row2 = mysqli_fetch_row(sql('SHOW CREATE TABLE '.$table)); $return.= "\n\n".$row2[1].";\n\n";
    for ($i = 0; $i < $num_fields; $i++) {
      while($row = mysqli_fetch_row($result)) {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    } $return.="\n\n\n";
  }
  $date = new DateTime('now'); $curr_date = $date->format('Y-m-d'); $handle = fopen(SERVER_PATH.BACKUP_DIR.$curr_date.'-db-backup'.'-'.time().'.sql','w+');
  fwrite($handle,$return); fclose($handle);
}
?>