<?php
function send_mail_lazypeople($to, $subject = 'Your register infomation', $body) {
    $loc_host = "SAE";        
    $smtp_acc = "你的账号地址";
    $smtp_pass="你的密码";      
    $smtp_host="SMTP地址";  
    $from="你的邮箱地址";    
    $headers = "Content-Type: text/plain; charset=\"utf-8\"\r\nContent-Transfer-Encoding: base64";
    $lb="\r\n";             //linebreak
       
    $hdr = explode($lb,$headers);  
   if($body) {$bdy = preg_replace("/^\./","..",explode($lb,$body));}//??????Body

    $smtp = array(
          array("EHLO ".$loc_host.$lb,"220,250","HELO error: "),
          array("AUTH LOGIN".$lb,"334","AUTH error:"),
          array(base64_encode($smtp_acc).$lb,"334","AUTHENTIFICATION error : "),
          array(base64_encode($smtp_pass).$lb,"235","AUTHENTIFICATION error : "));
    $smtp[] = array("MAIL FROM: <".$from.">".$lb,"250","MAIL FROM error: ");
    $smtp[] = array("RCPT TO: <".$to.">".$lb,"250","RCPT TO error: ");
    $smtp[] = array("DATA".$lb,"354","DATA error: ");
    $smtp[] = array("From: ".$from.$lb,"","");
    $smtp[] = array("To: ".$to.$lb,"","");
    $smtp[] = array("Subject: ".$subject.$lb,"","");
    foreach($hdr as $h) {$smtp[] = array($h.$lb,"","");}
    $smtp[] = array($lb,"","");
    if($bdy) {foreach($bdy as $b) {$smtp[] = array(base64_encode($b.$lb).$lb,"","");}}
    $smtp[] = array(".".$lb,"250","DATA(end)error: ");
    $smtp[] = array("QUIT".$lb,"221","QUIT error: ");
    $fp = @fsockopen($smtp_host, 25);
    if (!$fp) echo "Error: Cannot conect to ".$smtp_host."
";
    while($result = @fgets($fp, 1024)){if(substr($result,3,1) == " ") { break; }}
   
    $result_str="";
    foreach($smtp as $req){
          @fputs($fp, $req[0]);
          if($req[1]){
                while($result = @fgets($fp, 1024)){
                    if(substr($result,3,1) == " ") { break; }
                };
                if (!strstr($req[1],substr($result,0,3))){
                    $result_str.=$req[2].$result."
";
                }
          }
    }
    @fclose($fp);
    return $result_str;
}

send_mail_lazypeople('377087477@qq.com','hello','hello');//测试
?>
