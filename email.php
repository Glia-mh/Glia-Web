<?
$email = $_POST['email'];
$code = $_POST['code'];

echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';
mail("alexlyeh@gmail.com", "Your Confirmation Code for Team Roots", "erwwer");
?>