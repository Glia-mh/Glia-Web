<?
$email = $_POST['email'];
$code = $_POST['code'];

$body = $code . '<br> Click this link: <a href="http://teamroots.org/Team-Roots-Web/counselor_login.php">http://teamroots.org/Team-Roots-Web/counselor_login.php</a> to sign in.';
// Always set content-type when sending HTML email
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: teamrootsemergency@teamroots.org" . "\r\n";
mail($email, "Your Confirmation Code for Team Roots", $body, $headers);
?>