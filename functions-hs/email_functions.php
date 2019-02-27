<?php 

/*************************************************************************************************************/
/*This Function Used For send mail to zion wen user used max doc-2 /functions-hs/registration.php */
/*************************************************************************************************************/
function send_email_before_max_doc($name,$email,$phone,$company_name,$company_id,$max_doc_count,$doc_cunt){
   
    $to = 'zioncrm@gmail.com';
    $adminEmail = MAIL_ADMIN;
    $adminName = ADMIN_NAME;
    $headers = '';
    $subject = "התראת כמות מסמכים";
    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= '<tr style="background: #eee;">';
    $message .= '<td colspan="2"><strong>שים לב! במערכת '.SITE_TITLE.' ללקוח '.$name.' נותרו עוד 2 מסמכים מתוך '.$max_doc_count.'   מסמכים שהפיק: '.$doc_cunt.'</strong> </td>';
    $message .= '</tr>';
    $message .= '<tr style="background: #eee;">';
    $message .= '<td colspan="2"><strong>פרטי משתמש </strong></td>';
    $message .= '</tr>';
    $message .= '<tr>';
    $message .= '<td><strong>שם</strong></td>';
    $message .= '<td><strong>' . $name. '</strong></td>';
    $message .= '</tr>';
    $message .= '<tr>';
    $message .= '<td><strong>אימייל</strong></td>';
    $message .= '<td><strong>' . $email. '</strong></td>';
    $message .= '</tr>';
    $message .= '<tr>';
    $message .= '<td><strong>טלפון</strong></td>';
    $message .= '<td><strong>' . $phone. '</strong></td>';
    $message .= '</tr>';
    $message .= '<tr>';
    $message .= '<td><strong>מספר עוסק</strong></td>';
    $message .= '<td><strong>' . $company_id. '</strong></td>';
    $message .= '</tr>';
    $message .= '<tr>';
    $message .= '<td><strong>שם חברה</strong></td>';
    $message .= '<td><strong>' . $company_name. '</strong></td>';
    $message .= '</tr>';
    $message .= '</body></html>';
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers .= "From: " . $adminName . "<crmyouco@janga.spd.co.il>" . "\r\n";
    $headers .= "Return-Path:crmyouco@janga.spd.co.il\r\n";
    $send = mail($to, $subject, $message, $headers);
}

/*************************************************************************************************************/
/*This Function Used For send mail to custumer wen sigenup /functions-hs/registration.php */
/*************************************************************************************************************/
function send_email_registration($name,$email,$password,$phone)
{
$adminEmail=$email;
$adminName = ADMIN_NAME;
$to = MAIL_SUPADMIN;
$subject  ="משתמש חדש נרשם ל-".ADMIN_NAME;
$message = '<html><body>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= '<tr>';
$message .= '<td colspan="2"><img src="http://'.$_SERVER['HTTP_HOST'].'/'.LOGO.'" height="90px" width="90px" /></td>';
$message .= '</tr>';
$message .= '<tr style="background: #eee;">';
$message .= '<td colspan="2"><strong>פרטי משתמש חדש</strong></td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td><strong>שם</strong></td>';
$message .= '<td><strong>' . $name. '</strong></td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td><strong>אימייל</strong></td>';
$message .= '<td><strong>' . $email. '</strong></td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td><strong>סיסמא</strong></td>';
$message .= '<td><strong>' . $password. '</strong></td>';
$message .= '</tr>';
$message .= '<tr>';
$message .= '<td><strong>טלפון</strong></td>';
$message .= '<td><strong>' . $phone. '</strong></td>';
$message .= '</tr>';
$message .= '</tr>';
$message .= '</table>';
$message .= '</body></html>';
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: " . $adminName . "<crmyouco@janga.spd.co.il>" . "\r\n";
$headers .= "Return-Path:crmyouco@janga.spd.co.il\r\n";
if (mail($to, $subject, $message, $headers)) {
    $headers = "";
    $adminEmail= MAIL_ADMIN;
    $adminName = ADMIN_NAME;
    $to = $email;
    $subject  ="משתמש חדש נוצר ב-".ADMIN_NAME;
    $message = '<html><body>';
    $message .= '<p>תודה על הצטרפותך ל-'.ADMIN_NAME.'</p>';
    $message .= '</body></html>';
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . $adminName . "<crmyouco@janga.spd.co.il>" . "\r\n";
    $headers .= "Return-Path:crmyouco@janga.spd.co.il\r\n";
    if (mail($to, $subject, $message, $headers)) {
        //echo "ההרשמה בוצעה בהצלחה";
    } else {
     //   echo "הראת שגיאה: ".print_r(error_get_last());
    }
} else {
    //echo "הראת שגיאה: ".print_r(error_get_last());
}

}

/*****************************************************************************************/
/*This Function Used For send mail to ukrain and admin wen user send expance /functions-hs/listing-house.php */
/*****************************************************************************************/
//send_email_attachment($person_name,$user_email,$location,$invoice_id,$invoice_amount,$datepicker,"ukrainecpa@gmail.com",$newFile,$filePath);

function send_email_attachment($person_name,$from_email,$location,$invoice_id,$invoice_amount,$company_name,$datepicker,$recipient_email,$file_name,$var_path)
{
    $mail_to = $recipient_email;
    $from_mail = $from_email;
    $from_name =$person_name;
    $reply_to = $recipient_email;
    $subject = "הוצאה ממערכת ".SITE_TITLE;
    $message = "I want image attachment";
    $row=get_row_col_single1("tbl_user","phone","email",$from_email);
    
    /* Attachment File */
    // Attachment location
    $file_name = $file_name;
    $path = $var_path;
    
    // Read the file content
    $file = $path.$file_name;
    
    //     $file_size = filesize($file);
    //     $handle = fopen($file, "rb");
    //     $content = fread($handle, $file_size);
    //     fclose($handle);
    //     $content = chunk_split(base64_encode($content));
    $filename = $file;//store that zip file in ur root directory
    
    if (!is_dir($file)) {
        echo "no file exist!!!!!!!!!!";
       
    }else{
        $attachment = chunk_split(base64_encode(file_get_contents($file)));
    }
    
    
    
    $separator = md5(time());
    
    // carriage return type (we use a PHP end of line constant)
    $eol = PHP_EOL;
    
    // Email header
    $from_name1= $from_name."<".$from_mail.">";
    
    $headers .= "From: " . $from_name . "<crmyouco@janga.spd.co.il>" . "\r\n";
    $headers .= "Return-Path:crmyouco@janga.spd.co.il\r\n";
    $headers .= "MIME-Version: 1.0".$eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";
    
    
    // no more headers after this, we start the body! //
    
    $body = "--".$separator.$eol;
    $body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
    //$body .= "This is a MIME encoded message.".$eol;
    
    // Email content
    // Content-type can be text/plain or text/html
    $message_body= '<html><body>';
    $message_body.= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message_body.= '<tr>';
    $message_body.= '<td><strong>Name</strong></td>';
    $message_body.= '<td><strong>' .$from_name. '</strong></td>';
    $message_body.= '</tr>';
    $message_body .= '<tr style="background: #eee;">';
    $message_body.= '<td><strong>Email-Id</strong></td>';
    $message_body.= '<td><strong>' . $from_mail . '</strong></td>';
    $message_body.= '</tr>';
    $message_body.= '<tr>';
    $message_body.= '<td><strong>Phone</strong></td>';
    $message_body.= '<td><strong>' . $row['phone'] . '</strong></td>';
    $message_body.= '</tr>';
    $message_body.= '<tr>';
    $message_body.= '<td><strong>Location</strong></td>';
    $message_body.= '<td><strong>' . $location . '</strong></td>';
    $message_body.= '</tr>';
    $message_body.= '<tr>';
    $message_body.= '<td><strong>Invoice id</strong></td>';
    $message_body.= '<td><strong>' . $invoice_id . '</strong></td>';
    $message_body.= '</tr>';
    $message_body.= '<tr>';
    $message_body.= '<td><strong>Invoice amount</strong></td>';
    $message_body.= '<td><strong>' . $invoice_amount . '</strong></td>';
    $message_body.= '</tr>';
    $message_body.= '<tr>';
    $message_body.= '<td><strong>Date</strong></td>';
    $message_body.= '<td><strong>' . $datepicker . '</strong></td>';
    $message_body.= '</tr></table>';
    $message_body.= '</body></html>';
    
    
    $body .= "--".$separator.$eol;
    $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
    $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
    $body .= $message_body.$eol;
    
    // attachment
    $body .= "--".$separator.$eol;
    $body .= "Content-Type: application/octet-stream; name=\"".$file_name."\"".$eol;
    $body .= "Content-Transfer-Encoding: base64".$eol;
    $body .= "Content-Disposition: attachment".$eol.$eol;
    $body .= $attachment.$eol;
    $body .= "--".$separator."--";
    
    // send message
    if (mail($mail_to, $subject, $body, $headers)) {
        $mail_sent=true;
        echo "mail sent";
    } else {
        $mail_sent=false;
        echo "Error,Mail not sent";
        
    }
}


function send_email_office_registration($name,$email,$phone,$company_name)
{
   $headers = "";
    $adminEmail= MAIL_ADMIN;
    $adminName = ADMIN_NAME;
    $to = 'zioncrm@gmail.com';
    $subject  ="משתמש חדש נרשם לאופיס גאי ב-".ADMIN_NAME;
    $message = '<html><body>';
    $message .= '<p>תודה על הצטרפותך ל-'.ADMIN_NAME.'</p>';
    $message .= '<p>פרטי המשתמש:</p>';
    $message .= '<p>'.$name.'</p>';
    $message .= '<p>'.$email.'</p>';
    $message .= '<p>'.$phone.'</p>';
    $message .= '<p>'.$company_name.'</p>';
    $message .= '</body></html>';
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . $adminName . "<crmyouco@janga.spd.co.il>" . "\r\n";
    $headers .= "Return-Path:crmyouco@janga.spd.co.il\r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "ההרשמה בוצעה בהצלחה";
    } else {
        echo "הראת שגיאה: ".print_r(error_get_last());
    }
}

?>