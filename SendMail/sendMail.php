<?php
/* Send Mail Exchange
 * @author MEPR
 * $date 01/17/2019
*/

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

$group_tester = 'your_group_id_telegram';

include("Telegram.php");
$bot_id  = "your_bot_id";
$telegram = new Telegram($bot_id);
 
 // Include Mailer
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;
 require 'src/Exception.php';
 require 'src/PHPMailer.php';
 require 'src/SMTP.php';
 
 // Server settings
 $mail = new PHPMailer;
 $mail->isSMTP();
 $mail->SMTPDebug = 0;
 $mail->Host = 'ip_address';
 $mail->Port = 465;
 $mail->SMTPAuth = true;
 $mail->AuthType = 'LOGIN';
 $mail->Username = 'your_username';
 $mail->Password = 'your_password';
 $mail->SMTPSecure = 'tls';
 $mail->SMTPOptions = array('ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		      ));

// Get all the new updates and set the new correct update_id
$req = $telegram->getUpdates();
for ($i = 0; $i < $telegram-> UpdateCount(); $i++)
{
	// You NEED to call serveUpdate before accessing the values of message in Telegram Class
	$telegram->serveUpdate($i);
	$text    = $telegram->Text();
	$chat_id = $telegram->ChatID();
	$name    = $telegram->FirstName();
	//$Message_id = $telegram->MessageID();
	$keyres       = explode(" ", $text);
	$keyresdaftar = explode("#", $text);
	$Hi           = "Hi <b>" . $name . "</b>,\n";

	//emoji
	$emojiwarning        = "\xE2\x9A\xA0";
	$emojicek            = "\xE2\x9C\x85";
	$emojisilang         = "\xE2\x9D\x8C";
	$emojiorang          = "\xF0\x9F\x91\xA4";
	$emojiid             = "\xF0\x9F\x86\x94";
	$emojiapprove        = "\xF0\x9F\x91\x8C";
	$emojihandphone      = "\xF0\x9F\x93\x9E";
	$emojiemail          = "\xF0\x9F\x93\xA7";
	$emojilist           = "\xF0\x9F\x94\x85";
	$emojiHiasBesar      = "\xF0\x9F\x94\xB6";
	$emojiHiasKecil      = "\xF0\x9F\x94\xB8";
	$emojitunjuk         = "\xF0\x9F\x91\x89";
	$emojilarangan       = "\xE2\x9B\x94";
	$emojiregistrasiuser = "\xF0\x9F\x9A\xBB";
	$emojihelpme         = "\xF0\x9F\x92\xA1";
	$emojigroup          = "\xE2\x99\xA8";
	$emojiaplikasi       = "\xF0\x9F\x94\xB0";
	$emojibook 	     		 = "\xF0\x9F\x93\x99";
	$emojisearch	     	 = "\xF0\x9F\x94\x8E";
	$emojikey	     			 = "\xF0\x9F\x94\x91";
	$emojilink	     		 = "\xF0\x9F\x94\x97";
	
	if($keyres[0] == "/start")
	{
		$reply = $Hi. "Selamat datang di [TESTER_BOT]\n\n   " . json_decode('"' . $emojiHiasKecil . '"') . json_decode('"' . $emojiHiasKecil . '"') . json_decode('"' . $emojiHiasBesar . '"') . "  <b>SM-LibraryBot</b>  " . json_decode('"' . $emojiHiasBesar . '"') . json_decode('"' . $emojiHiasKecil . '"') . json_decode('"' . $emojiHiasKecil . '"') . "\n\nTelegram Bot ini berfungsi untuk mendapatkan informasi-informasi yang dibutuhkan oleh team divisi (nama_divisi).\n\n---------------------------" . json_decode('"' . $emojiHiasKecil . '"') . "---------------------------\n\n<i>Note : \nSilahkan ketik </i><b>/helpme</b> <i>untuk mengetahui cara penggunaan Bot ini.</i>";
        	$content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=>'html');
        	$telegram->sendMessage($content);
		exit;	
	}
	elseif(strtolower($text) == "/send")
	{
		// Setting
		$from_e  = "from_mail"; // Email From
		$from_n  = "yaour_name"; // Name From
		$to      = "to_rmail";
		$attach  = "attachments/phpmailer_mini.png";
		$attach2 = "attachments/file.txt";
		$subject = "Tes Subject Email";
		$body    = "Tes body email (FORMAT HTML).<br/>
			   <b>#IniBold</b><br><br/>
			   Regard,<br/><br/>
			   <b>Your Name</b><br/>
			   Divisi Name<br/>
			   ------------------------------------- <br/>
			   PT Bank Danamon Indonesia, Tbk.<br/>
			   Bank Danamon<br/>
			   your_mail | www.danamon.co.id<br/>";

		$body1   = "Tes body email (FORMAT HTML).<br/>
			   <b>#IniBold</b><br><br/>
			   Regard,<br/><br/>
			   <b>Your Name</b><br/>
			   Divisi Name<br/>
			   <img src='cid:img/danamon.png' width='220' height='60' alt='Danamon'><br/>
			   PT Bank Danamon Indonesia, Tbk.<br/>
			   Bank Danamon<br/>
			   your_mail | www.danamon.co.id<br/>
			   <img src='img/sosialdanamon.png' alt='Sosial Danamon'>";
		
 		// Recipients
 		$mail->setFrom($from_e, $from_n); // Sender
 		$mail->addAddress($to); // Send To
 		# $mail->addReplyTo('replyto@example.com', 'First Last');
 		# $mail->addCC('cc@example.com');

 		// Attachments
 		# $mail->addAttachment($attach); // Add attachments
		# $mail->addAttachment($attach2); // Add attachments (lebih dari 1)

 		// Content
 		$mail->isHTML(true);
 		$mail->Subject = $subject;
 		# $mail->Body    = $body;	
 		$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //body from external file

 		// Send the message, check for errors
 		if(!$mail->send()) {
		  echo "Mailer Error : " . $mail->ErrorInfo;
		  $reply = json_decode('"'. $emojilarangan .'"')." <b>Email Unsuccessfully</b> ".json_decode('"'. $emojiemail .'"')."\n\n<i>Keterangan :</i>\n". $mail->ErrorInfo;
		} else {
		  echo "Message sent!";
		  $reply = json_decode('"'. $emojicek .'"')." <b>Email Successfully</b> ".json_decode('"'. $emojiemail .'"');
		}

        	$content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=>'html');
        	$telegram->sendMessage($content);
	}

	elseif(strtolower($text) == "/tes")
	{
		$reply = "wkwk heeh, naha kitu boa eah?";
			$content = array('chat_id' => $group_tester, 'text' => $reply, 'parse_mode'=>'html');
			$telegram->sendMessage($content);
			exit;
	}

	else
	{
		$reply = json_decode('"' . $emojilarangan . '"')  . " <b>Access Denied</b>\n\n" . $Hi . "Command yang Anda ketik tidak sesuai.\n\nSilahkan ketik /helpme untuk mengetahui penggunaan command-command yang ada di dalam Telegram SM-LibraryBot TESTER!!";
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode'=>'html');
		$telegram->sendMessage($content);
		exit;
	}
}

?>