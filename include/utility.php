<?php
require("../phpmailer/class.phpmailer.php");
require("../phpmailer/class.smtp.php");
require("./validator.php");

function GetAbsoluteURLFolder()
{
	$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
	$scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
	return $scriptFolder;
}

function MakeConfirmationMd5($email)
{
	$myrandom = 732574;
	$randno1 = rand();
	$randno2 = rand();
	return urlencode(md5($email.$randno1.$myrandom.$randno2));
}

function SendUserConfirmationEmail($email_id, $name, $confirmcode)
{
	$mailer = new PHPMailer(true);
	
	$mailer->IsSMTP();                                          // set mailer to use SMTP
	$mailer->Host = "ssl://smtp.gmail.com";                     // specify main and backup server
	$mailer->Port = 465;                                        // set the port to use
	$mailer->SMTPAuth = true;                                   // turn on SMTP authentication
	$mailer->Username = "";                     // your SMTP username or your gmail username
	$mailer->Password = "";                          // your SMTP password or your gmail password
	$mailer->From = "";            //sender mail-id
	$mailer->FromName = "";                       // Name to indicate where the email came from when the recepient received

	$mailer->AddReplyTo("","Webmaster");     // Reply to this email
	
	$mailer->CharSet = 'utf-8';
	$mailer->WordWrap = 50;                                     // set word wrap
	
	$mailer->AddAddress($email_id, $name);
	$mailer->Subject = "Confirm Your registration";
	$confirm_url = GetAbsoluteURLFolder().'/dologin.php?code='.$confirmcode;
	$mailer->Body ="Hello ".$name."\r\n\r\n".
	"Thanks for registering.\r\n".
	"Please click the link below to confirm your registration.\r\n".
	"$confirm_url\r\n".
	"\r\n".
	"Regards,\r\n".
	"Team \r\n";
	
	if(!$mailer->Send())
	{
		$error = "Mailer Error: " . $mailer->ErrorInfo;
		return false;
	}
	return true;
}

function SendNewPassword($email_id, $name, $password)
{
    $mailer = new PHPMailer(true);
    
    $mailer->IsSMTP();                                          // set mailer to use SMTP
    $mailer->Host = "ssl://smtp.gmail.com";                     // specify main and backup server
    $mailer->Port = 465;                                        // set the port to use
    $mailer->SMTPAuth = true;                                   // turn on SMTP authentication
    $mailer->Username = "";                     // your SMTP username or your gmail username
    $mailer->Password = "";                          // your SMTP password or your gmail password
    $mailer->From = "";            //sender mail-id
    $mailer->FromName = "Team ";                       // Name to indicate where the email came from when the recepient received

    $mailer->AddReplyTo("","Webmaster");     // Reply to this email
    
    $mailer->CharSet = 'utf-8';
    $mailer->WordWrap = 50;                                     // set word wrap
    
    $mailer->AddAddress($email_id, $name);
    $mailer->Subject = "New password";
    $mailer->Body ="Hello ".$name."\r\n\r\n".
    "Your new password is\r\n".
    "$password\r\n".
    "\r\n".
    "Regards,\r\n".
    "Team \r\n";
    
    if(!$mailer->Send())
    {
        $error = "Mailer Error: " . $mailer->ErrorInfo;
        return false;
    }
    return true;
}

function ValidateRegistrationSubmission()
    {
        $validator = new FormValidator();
        $validator->addValidation("username","req","Please fill in Username");
        $validator->addValidation("email","email","The input should be a valid Email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("password","req","Please fill in Password");
        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $error_message .= $error."\r\n";
            return false;
        }        
        return true;
    }
  
?>
