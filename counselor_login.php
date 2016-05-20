<?php  require_once('vendor/autoload.php'); session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<!--useless comment-->
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/style.css">
	<title>Team Roots</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://www.parsecdn.com/js/parse-1.5.0.min.js"></script>
	
	<script src='https://cdn.layer.com/sdk/0.9/layer-websdk.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js'></script>
  	<script src='https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js'></script>

	<script>
		Parse.initialize("pya3k6c4LXzZMy6PwMH80kJx4HD2xF6duLSSdYUl", "nsAogGRd3LmObBE5jk1E3pilVTDbPGAEHpTZwvob");
	</script>
</head>
<body>
	<div id="container">
		<img id="title" src="img/team-roots-logo.png">

		<form id="login-form" method="POST">
			<input type="email" name="email" class="form-field" placeholder="Email" required><br>
			<input type="password" name="password" class="form-field" placeholder="Password" required><br>
			<input type="submit" class="button" value="Log In"><br>
			<p><a href="counselor_activation.html"><small>Do you have a code?</small></a></p>
			<p id="note"></p>
		</form>
	</div>

<?php 
		
		
		use Parse\ParseClient;
		use Parse\ParseException;
		use Parse\ParseSessionStorage;
		ParseClient::initialize("pya3k6c4LXzZMy6PwMH80kJx4HD2xF6duLSSdYUl", "GCXBJB5K5GY7jU9yRkU2vkNZoS158dw8VeFOrl6Z" , "nsAogGRd3LmObBE5jk1E3pilVTDbPGAEHpTZwvob");
		ParseClient::setStorage( new ParseSessionStorage() );

		use Parse\ParseUser;



		if (isset($_POST['password']) && isset($_POST['email'])) {
			
			
			
			
			try {
				//echo 'alert("test");';
				$user = ParseUser::logIn($_POST['email'], $_POST['password']);
				if($user)
					$_SESSION['globalSession']=$user->get("counselorType");
				echo '<script> alert("' . $user->getObjectId() . '"); alert("hello");</script>';
				echo '<script> var currentUser;

				Parse.User.logIn("' . $_POST['email'] . '", "' . $_POST['password'] . '").then(function (user) {
					currentUser = user;
					
				}, function (error) {
					alert("Error: " + error.code + " " + error.message);
				})
				.then(function () {
					if (currentUser.get("photoURL") && currentUser.get("bio")){
					    window.layerSampleConfig = {
					      appId: \'layer:///apps/staging/e25bc8da-9f52-11e4-97ea-142b010033d0\',
					      userId: currentUser.id
					    };
						window.location = "ChatUI/ChatUI.php";
					}else
						window.location = "counselor_welcome.php";
				}); </script>';
			} catch (ParseException $error) {
	  			// The login failed. Check error to see why.
			}

		}
	?>
	<script>
		var currentUser = Parse.User.current();
    	if (currentUser) {
				if (currentUser.get("photoURL") && currentUser.get("bio")){
				    window.layerSampleConfig = {
				      appId: 'layer:///apps/staging/e25bc8da-9f52-11e4-97ea-142b010033d0',
				      userId: currentUser.id
				    };
					window.location = "ChatUI/ChatUI.php";
				}else
					window.location = "counselor_welcome.php";
		}
		
	</script>

	<div id="footer">
		<a href="mailto:spencer@teamroots.org" class="get-notified">Contact us</a>
	</div>
</body>
</html>
