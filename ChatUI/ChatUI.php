<?php require_once  __DIR__ . '/../vendor/autoload.php'; session_start();
	use Parse\ParseClient;
	use Parse\ParseSessionStorage;
	use Parse\ParseUser;



	ParseClient::initialize("pya3k6c4LXzZMy6PwMH80kJx4HD2xF6duLSSdYUl", "GCXBJB5K5GY7jU9yRkU2vkNZoS158dw8VeFOrl6Z" , "nsAogGRd3LmObBE5jk1E3pilVTDbPGAEHpTZwvob");
	ParseClient::setStorage( new ParseSessionStorage() );
	//ParseClient::setServerURL('http://YOUR_PARSE_SERVER:1337/parse');
	//ParseClient::setServerURL('http://adityaaggarwal.com/Team-Roots-Web/vendor/parse/');


	?>
<html>

<head>
	<title>Chat UI</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/style.css"/>

	<!-- resizing the window/ compacting css -->
	<style>
		@media (max-width: 1200px) {
			.right-sidebar {
				display: none;
			}
			.center-container {
				margin-right: 10px;
			}
			.message-box {
				width: calc(100% - 90px);
			}
		}

		@media(max-width: 910px) {
			.sidebar {
				width: 70px;
			}
			#chat-name {
				display: none;
			}
			.online {
				display: none;
			}
			.time {
				display: none;
			}
			#preview-mssg {
				display: none;
			}
			.class-message-box-container {
				
			}
			.center-container {
				margin-left: 70px;
				margin-right: 0px;
			}
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="http://www.parsecdn.com/js/parse-1.5.0.min.js"></script>

	<!-- Backbone and its Dependencies -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js'></script>

	<!-- Layer Web SDK -->
  <script src='https://cdn.layer.com/sdk/0.9/layer-websdk.min.js'></script>


	<!--App Instance Setup-->
	<script type="text/javascript">

	  Parse.initialize("pya3k6c4LXzZMy6PwMH80kJx4HD2xF6duLSSdYUl", "nsAogGRd3LmObBE5jk1E3pilVTDbPGAEHpTZwvob");
	    var currentUser = Parse.User.current();
	    if (!currentUser) window.location = "../counselor_login.php";
	    if(currentUser.attributes.rootsAuthData=="banned"){
	    	window.location = "../counselor_login.php";
	    } else if (currentUser.attributes.rootsAuthData=="notverified") {
			window.location = "../counselor_register.html";
		} 
	    window.layerSampleConfig = {
	      appId: 'layer:///apps/staging/e25bc8da-9f52-11e4-97ea-142b010033d0',
	      userId: currentUser.id
	    };

	    window.layerSampleApp = {};
	    $( document ).ready(function() {
	      $( "#signout" ).click(function() {
	        Parse.User.logOut();
	        window.location="../counselor_login.php"
	      });
	    });




	    // TextArea Resizing 
	    $(window).load(function() {

	    	
	    	

	    });










	</script>






<script>

	


	$(window).load(function() {
		
		// When the user clicks on <span> (x), close the modal
		$("#close").click(function() {
			var modal = document.getElementById("myModal");
			modal.style.display = "none";
			document.getElementById("OKModal").style.display="inline";
		});

		$("#cancelModal").click(function() {
			var modal = document.getElementById("myModal");
			modal.style.display = "none";
			document.getElementById("OKModal").style.display="inline";
		});
	});


	

</script>





	
	

<?php 	$currentUser= ParseUser::getCurrentUser();
		if (strcmp($currentUser->get("counselorType"), "0")==0){
			
			echo '<script language="javascript"> 
	
		var generate = function () {
			var alphabet = "abcdefghijklmnopqrstuvwxyz".split(\'\');
			var code_array = [];
			for (var i = 0; i < 15; i++) {
				code_array[i] = alphabet[Math.floor(Math.random() * 10)];
				if (Math.floor((Math.random() * 2) + 1) % 2 == 0)
					code_array[i] = code_array[i].toUpperCase();
			}
			var code = code_array.join("");

			// Check Parse for existing code
			var Student_Code = Parse.Object.extend("Confirmation_Codes");
			var query = new Parse.Query(Student_Code);
			query.limit(1000); 
			query.equalTo("code", code);
			return query.find().then(function (results) {
				if (results.length != 0) {
					return generate();
				}
				else {
					return code;
				}
			},
			function (err) {
					document.getElementById("OKModal").style.display="none";
			    	document.getElementById("modal-text").innerHTML= \'There seems to be a problem with our website. Email us at <a href="mailto:teamroots@teamroots.org">teamroots@teamroots.org</a>. With the following information: <br>  Error \' +err.code + \' \' + err.message + \'.\';
			    	var modal = document.getElementById(\'myModal\');
			    	modal.style.display="block";
			});
		}
		var save_student = function(studentObj) {
			var sessionToken = Parse.User.current().getSessionToken();
			var user = new Parse.User();
			user.set("username", studentObj.email);
			user.set("password", studentObj.code);
			user.set("email", studentObj.email);
			user.set("counselorType", "1");
			user.set("schoolID" , currentUser.attributes.schoolID);
			user.set("isAvailable", true);
			user.set("rootsAuthData", "notverified");

			user.signUp(null, {
			  success: function(user) {
			    Parse.User.become(sessionToken);
			    var php_data = "email=" + studentObj.email + "&code=" + studentObj.code;
			    console.log(php_data);
			    $.ajax({
						type: "POST",
						url: \'../email.php\',
						data: php_data,
						success: function() {}
				});
			  },
			  error: function(user, error) {
			    // Show the error message somewhere and let the user try again.
			    if(error.code=202){
			    	document.getElementById("OKModal").style.display="none";
			    	document.getElementById("modal-text").innerHTML= \'<a href="mailto:\' +studentObj.email + \'">\' + studentObj.email + \'</a>  has already been added as a counselor.\';
			    	var modal = document.getElementById(\'myModal\');
			    	modal.style.display="block";
			    } else {
			    	document.getElementById("OKModal").style.display="none";
			    	document.getElementById("modal-text").innerHTML= \'There seems to be a problem with our website. Email us at <a href="mailto:teamroots@teamroots.org">teamroots@teamroots.org</a>. With the following information: <br>  Error \' +error.code + \' \' + error.message + \'.\';
			    	var modal = document.getElementById(\'myModal\');
			    	modal.style.display="block";
			    }
			  }
			});

		}


		var send_email = function (em_arr) {
			for (var i = 0; i < em_arr.length; i++) {
				save_student(em_arr[i]);
			}
		}

		$(window).load(function() {
			if(Parse.User.current().attributes.counselorType != 0){
				$("#adduserssection").hide();
			} else {
				$("#reporturgentsection").hide();
				$("#class-message-box-container-mainchat").hide();
				document.getElementById("adduser").addEventListener("click", function () {
					var modal = document.getElementById(\'myModal\');
					

					



					document.getElementById("modal-text").innerHTML= "Are you sure you want to add these emails as counselors?";
					document.getElementById("OKModal").value="Add Users";
					document.getElementById("OKModal").style.border="solid 1px #51C781";
					document.getElementById("OKModal").style.backgroundColor="#64c87a";
					$("#OKModal").hover(function(){
					    $(this).css("background-color", "#5CA759");
					    }, function(){
					    $(this).css("background-color", "#64c87a");
					});
				
					$( "#OKModal").unbind("click");

					//OK Button
					$("#OKModal").click(function() {
						var email_text = document.getElementById("emails").value.replace(/\s/g, \'\');
						var num_commas = (email_text.match(/,/g) || []).length;
						var promise_array = [];
						alert("reset");
						for (var i = 0; i < num_commas + 1; i++) {
							promise_array[i] = generate().then(function (code) {
								if (email_text.indexOf(\',\') == -1) {
									return {email: email_text, code: code};
								} else {
									var email = email_text.substring(0, email_text.indexOf(\',\'));
									email_text = email_text.substring(email_text.indexOf(\',\') + 1, email_text.length);
									return {email: email, code: code};
								}
							}, function(reason) {
	  							console.log(reason); // Error!
							});
						}
						modal.style.display = "none";
						Promise.all(promise_array).then(function (email_array) {
							console.log(promise_array);
							console.log(email_array);
							send_email(email_array);
							document.getElementById("emails").value="";
						});
					});

					//show modal
					modal.style.display = "block";

						

						

					
					
					
				});
			}
		});</script>';
		} else {
			echo '<script language="javascript"> $(window).load(function() {$("#adduserssection").hide(); $("#unreportsection").hide()}); </script> ';
		}

		
	?>



   <!-- Views -->
  <script src="../views/conversation-list.js"></script>
  <script src="../views/user-list-dialog.js"></script>
  <script src="../views/titlebar.js"></script>
  <script src="../views/conversation-list-header.js"></script>
  <script src="../views/message.js"></script>
  <script src="../views/message-list.js"></script>
  <script src="../views/message-composer.js"></script>

  <!-- Controllers and Utilities -->
  <script src="../controller.js"></script>
  <script src="../index.js"></script>
  <script src="../identity-services.js"></script>
 <!-- <script src="../addUsers.js"></script> -->

</head>

<body>

	


<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="close">×</span>
    <br>
    <p id="modal-text">Some text in the Modal..</p>
     <br>
	<div class="modal-options">
		<input type="submit" class="button" id="OKModal" value="Ok">
		<input type="submit" class="button-subtheme" id="cancelModal" value="Cancel">
	</div>
  </div>
</div>
<header>

	<img src = "https://cdn2.iconfinder.com/data/icons/power-symbol/512/powe_symbol_4-512.png" id = "signout">
	<span id = "user-name"></span>

	<img src = "../img/id-logo.jpg" id = "profile-logo">
	<script type="text/javascript">
		if(Parse.User.current())
			if(Parse.User.current().attributes.photoURL)
				$(window).load(function() { $("#profile-logo").attr("src", Parse.User.current().attributes.photoURL)});
		
	</script>
	<img src = "../img/team-roots-logo.png" id = "header-logo">
	
</header>

<script type="text/javascript">
	document.getElementById("user-name").textContent = currentUser.get("name");
</script>

<aside class = "sidebar">

</aside>







	<section class="center-container">
		<section id ="chat-content-header">
			<!--<span class="name-chatting-to-header"> Click on a Message </span>-->
		</section>

		<section class="chat-content-wrapper">
			

		</section> 

		<form style = "overflow: hidden" id="class-message-box-container-mainchat" class="class-message-box-container">

		
		</form>
	</section> 



<aside class = "right-sidebar">

	<section>
		<section class="bottomborder-sidebar" id="bottomborder-sidebar-top">

		<img src = "../img/id-logo.jpg" class = "logo" id="logo-sidebar"> <span id= "chat-name-sidebar" class= "chat-name"> Participant Name </span> <!--<br> <span id="preview-mssg-sidebar" class= "preview-mssg"> University of Southern California </span> -->
		

		</section>

		<section id="reporturgentsection" class="bottomborder-sidebar">
			<br>
			<textarea id = "notes" rows = "8" cols = "35" class="sidetextarea" placeholder = "Enter notes..."></textarea>
			<br><br>
			<button id = "report">Report Urgent</button> 

			<br>
		</section>

		<section id="adduserssection" class="bottomborder-sidebar">
			<br>
			<textarea id = "emails" rows = "8" cols = "35" class="sidetextarea" placeholder = "Enter emails..."></textarea>
			<br><br>
			<button id = "adduser">Add Users</button> 
			<button id = "banuser">Ban Users</button> 
			<br>
		</section>
		<section id="unreportsection" class="bottomborder-sidebar">
			<br>
			<button id = "unreport">Undo Report</button> 
			<br>
		</section>



	</section>
	<br>
<!-- 	<button id = "request">Request ID</button>
	<br><br> -->
	

</aside>



</body>

</html>
