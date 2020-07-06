<?php if (!defined('TOPAZ')) {
    die("Unauthorised access detected.");
}

function mysql_escape_mimic($inp)
{
    if (is_array($inp)) {
        return array_map(__METHOD__, $inp);
    }

    if (!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
}

function q_smtpmailer($to, $from, $from_name, $subject, $body, $mail_date, $authcode, $del = "1", $ack = "0")
{
    $arr = explode(",", $to);
    $body = mysql_escape_mimic($body);
    foreach ($arr as $k=>$v) {
        $q_mail = sql("INSERT INTO `mail_queue` (`to`, `from`, `from_name`, `subject`, `body`, `mail_date`, `authcode`, `ack`, `del`) VALUES ('".$v."', '".$from."', '".$from_name."', '".$subject."', '".$body."', '".$mail_date."', '".$authcode."', '".$ack."', '".$del."')");
    }
}

function message($to, $from, $from_name, $subject, $body, $mail_date, $authcode, $del = "1", $ack = "0")
{
    $arr = explode(",", $to);
    $body = mysql_escape_mimic($body);
    foreach ($arr as $k=>$v) {
        $q_mail = sql("INSERT INTO `mail_queue` (`to`, `from`, `from_name`, `subject`, `body`, `mail_date`, `authcode`, `ack`, `del`) VALUES ('".$v."', '".$from."', '".$from_name."', '".$subject."', '".$body."', '".$mail_date."', '".$authcode."', '".$ack."', '".$del."')");
    }
}

function smtpmailer($to, $from, $from_name, $subject, $body, $authcode)
{
    if ($authcode == MAIL_SEND_CODE) {
        global $error;
        $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->IsHTML(true);
        $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = SMTP_AUTH;  // authentication enabled
    $mail->SMTPSecure = SMTP_SSL; // secure transfer enabled REQUIRED for GMail
    $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if (!$mail->Send()) {
            logError('Mail error: '.$mail->ErrorInfo);
            $error = 'Mail error: '.$mail->ErrorInfo;
            return false;
        } else {
            //logError('Mail out succesfull');
            $error = 'Mail out succesfull';
            return true;
        }
    } else {
        logError("Mail error:Authoristation code not matched");
    }
}
