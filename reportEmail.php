
<?php
$email = $_POST['email'];
$body = $_POST['body'];
$second= $_POST['second'];

echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';

$subject = "Team Roots Emergency Report";

$message = 'Hi, my name is Cynthia Hsu. I am reporting a conversation on Team Roots. Here\'s a link to our conversation: <br> <br>' . $body;
$message .= ' <br> <br> You can reply to this email if you have more questions. <br>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: teamrootsemergency@teamroots.org" . "\r\n";
$headers .= "Reply-To: $second" . "\r\n";

mail($email,$subject,$message,$headers);
?>
