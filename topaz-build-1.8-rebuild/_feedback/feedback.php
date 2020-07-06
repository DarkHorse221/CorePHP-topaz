<?php define('TOPAZ', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE); ini_set("display_errors", 1);
include('../_constants/constants.php'); include('../_constants/db.php'); include('../_functions/strings.php'); include('../_functions/requests.php');
session_start(); $sid = session_id(); $uid = userID($sid);

//get parameters
$fid = cleanString($_GET['fid']);
$qid = cleanString($_GET['qid']);
$total = cleanString($_GET['total']);
$thankyou = cleanString($_GET['thankyou']);
$respid = cleanString($_GET['respid']);

//check which page to load
if($fid && !$qid) {
    
    //get feedback data and latest version
    $q_fid = sql("SELECT fe.id AS ext_id, f.name, f.status, fe.status, f.type_id, f.unit, f.mids FROM qi f LEFT JOIN qi_ext fe ON fe.fid=f.id LEFT JOIN type_list tl ON f.type_id=tl.id WHERE f.status = '1' AND fe.status = '1' AND f.id = '".$fid."'");
    $c_fid = mysqli_num_rows($q_fid);
    if (!$c_fid) {
        $templateArray['{system-block}'] = 'none';
        $err[] = sysMsg(4);
    } else {
        $templateArray['{home-display}'] = 'block';
        $r_fid = mysqli_fetch_assoc($q_fid);
        
        //get first question id
        $q_qid = sql("SELECT * FROM `qi_q` WHERE `feid` = '".$r_fid['ext_id']."' ORDER BY `order` ASC");
        $c_qid = mysqli_num_rows($q_qid); $start_total = $c_qid;
        if (!$c_qid) {
            $templateArray['{system-block}'] = 'none';
            $err[] = sysMsg(4);
        } else {
            $i = 1;
            while($r_qid = mysqli_fetch_assoc($q_qid)) {
                if($i == 1) {
                    $int_qid = $r_qid['id'];
                }
                $i++;
            }
        }
    }
}
if($qid) {
    $templateArray['{home-display}'] = 'none';

        $q_qid = sql("SELECT * FROM `qi_q` WHERE `id` = '".$qid."'");
        $c_qid = mysqli_num_rows($q_qid);

        if (!$c_qid) {
            $templateArray['{system-block}'] = 'none';
            $err[] = sysMsg(4);
        } else {
            //load questions
            $templateArray['{question-display}'] = 'block';
            $r_qid = mysqli_fetch_assoc($q_qid);
            $curr_ques_id = $qid;
            $curr_order = $r_qid['order'];

            //get next question if applicable else do thankyou page
            if($curr_order < $total) {
                
                $templateArray['{thankyou}'] = '';
                $next_ques = $curr_order + 1;
                //get next question
                $q_nqid = sql("SELECT * FROM `qi_q` WHERE `feid` = '".$r_qid['feid']."' AND `order` = '".$next_ques."'");
                $r_nqid = mysqli_fetch_assoc($q_nqid);
                $next_ques_id = $r_nqid['id'];
            } else {
                $templateArray['{thankyou}'] = 'true';
            }
                //question name
                $templateArray['{question}'] = $r_qid['question'];
                //do questions by type smileys-5    
                if($r_qid['type'] == 'smileys-5') {
                    $templateArray['{question-answer}'] = '
                    <div class="question-answer">
                    <p>
                    <label>
                    <input type="radio" name="faces" value="smileys-1" class="faces">
                    <img src="_images/face-1-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="smileys-2" class="faces"> 
                    <img src="_images/face-2-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="smileys-3" class="faces">
                    <img src="_images/face-3-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="smileys-4" class="faces">
                    <img src="_images/face-4-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="smileys-5" class="faces">
                    <img src="_images/face-5-150.png">
                    </label>
                    </p>
                </div>';
                } //smileys 5
                //do questions by type smileys-3    
                if($r_qid['type'] == 'smileys-3') {
                    $templateArray['{question-answer}'] = '
                    <div class="question-answer">
                    <p>
                    <label>
                    <input type="radio" name="faces" value="smileys-1" class="faces">
                    <img src="_images/face-1-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="smileys-3" class="faces">
                    <img src="_images/face-3-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="smileys-5" class="faces">
                    <img src="_images/face-5-150.png">
                    </label>
                    </p>
                </div>';
                } //smileys 3
                //do questions by type numeric-5    
                if($r_qid['type'] == 'numeric-5') {
                    $templateArray['{question-answer}'] = '
                    <div class="question-answer">
                    <p>
                    <label>
                    <input type="radio" name="faces" value="numeric-1" class="faces">
                    <img src="_images/numeric-1-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="numeric-2" class="faces"> 
                    <img src="_images/numeric-2-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="numeric-3" class="faces">
                    <img src="_images/numeric-3-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="numeric-4" class="faces">
                    <img src="_images/numeric-4-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="numeric-5" class="faces">
                    <img src="_images/numeric-5-150.png">
                    </label>
                    </p>
                </div>';
                } //numeric 5

                //do questions by type numeric-3    
                if($r_qid['type'] == 'numeric-3') {
                    $templateArray['{question-answer}'] = '
                    <div class="question-answer">
                    <p>
                    <label>
                    <input type="radio" name="faces" value="numeric-1" class="faces">
                    <img src="_images/numeric-1-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="numeric-2" class="faces">
                    <img src="_images/numeric-2-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="numeric-3" class="faces">
                    <img src="_images/numeric-3-150.png">
                    </label>
                    </p>
                </div>';
                } //numeric 3

                //do questions by type yes-no   
                if($r_qid['type'] == 'yes-no') {
                    $templateArray['{question-answer}'] = '
                    <div class="question-answer">
                    <p>
                    <label>
                    <input type="radio" name="faces" value="yes" class="faces">
                    <img src="_images/yes-150.png">
                    </label>

                    <label>
                    <input type="radio" name="faces" value="no" class="faces">
                    <img src="_images/no-150.png">
                    </label>
                    </p>
                </div>';
                } //yes-no

        } //else    
}

if(!$qid) { $qid = $int_qid; }
if($next_ques_id) { $qid = $next_ques_id;  }
if(!$total) { $total = $start_total; }
if($thankyou) {
    $qid = '';
    $total = '';
    $templateArray['{thankyou-display}'] = 'block'; $templateArray['{question-display}'] = 'none'; $templateArray['{home-display}'] = 'none';
}
$templateArray['{fid}'] = $fid;
$templateArray['{qid}'] = $qid;
$templateArray['{total}'] = $total;
if($curr_ques_id) { $templateArray['{curr_ques_id}'] = $curr_ques_id; } else { $templateArray['{curr_ques_id}'] = ''; }
if($respid) { $templateArray['{respid}'] = $respid; } else { $templateArray['{respid}'] = ''; }
if (!$templateArray['{error}']) { $templateArray['{error}'] = writeMsgs($err); }
if(!$templateArray['{home-display}']) { $templateArray['{home-display}'] = 'none'; }
if(!$templateArray['{question-display}']) { $templateArray['{question-display}'] = 'none'; }
if(!$templateArray['{thankyou-display}']) { $templateArray['{thankyou-display}'] = 'none'; }
if(!$templateArray['{thankyou}']) { $templateArray['{thankyou}'] = ''; }

$templateContent = "feedback.html";
$mainContent = replaceTemplate($templateArray, $templateContent);
echo $mainContent;
?>