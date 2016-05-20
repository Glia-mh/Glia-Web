<?php require_once('../vendor/autoload.php'); session_start();
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
		@media (max-width: 1100px) {
			.right-sidebar {
				display: none;
			}
			.center-container {
				margin-right: 10px;
			}
			.message-box {
				width: calc(100% - 80px);
			}
		}

		@media(max-width: 900px) {
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
				margin-left: 22px;
			}
			.center-container {
				margin-left: 60px;
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
	    if (!currentUser) window.location = "../counselor_login.html";
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
		var txt = $('#comments'),
		    hiddenDiv = $(document.createElement('div')),
		    content = null;

		txt.addClass('txtstuff');
		hiddenDiv.addClass('hiddendiv message-box');

		$('class-message-box-container').append(hiddenDiv);

		txt.on('keyup', function () {

		    content = $(this).val();

		    content = content.replace(/\n/g, '<br>');
		    hiddenDiv.html(content + '<br class="lbr">');

		    $(this).css('height', hiddenDiv.height());

		});
		});








	</script>




	
	<script>		
$(window).load(function() {
		var send_email = function (em_arr) {
			for (var i = 0; i < em_arr.length; i++) {
				/*var Student_Code = Parse.Object.extend("Confirmation_Codes");
				var student_code = new Student_Code();
				student_code.set("email", em_arr[i].email);
				student_code.set("code", em_arr[i].code);
				student_code.save();*/
				console.log(document.getElementById("notes").value +"test");
				var email = currentUser.attributes.email;
				var php_data = "email=" + em_arr[i] + "&second="+ email + "&body=" + document.getElementById("notes").value;
				console.log(php_data);
				$.ajax({
					type: "POST",
					url: '../reportEmail.php',
					data: php_data,
					success: function() {}
				});
			}
		};

		document.getElementById("report").addEventListener("click", function () {

			var email_array=["agga140@usc.edu"];
			console.log(email_array);
			send_email(email_array);
		});
	}); </script>

<?php 	$currentUser= ParseUser::getCurrentUser();
		if (strcmp($currentUser->get("counselorType"), "0")==0){
			//echo '<script language="javascript"> alert("' . $currentUser->getObjectId() . '"); alert("hi"); </script>';
			echo '<script language="javascript"> var _0x9dae=["","\x73\x70\x6C\x69\x74","\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x74\x6F\x55\x70\x70\x65\x72\x43\x61\x73\x65","\x6A\x6F\x69\x6E","\x43\x6F\x6E\x66\x69\x72\x6D\x61\x74\x69\x6F\x6E\x5F\x43\x6F\x64\x65\x73","\x65\x78\x74\x65\x6E\x64","\x4F\x62\x6A\x65\x63\x74","\x6C\x69\x6D\x69\x74","\x63\x6F\x64\x65","\x65\x71\x75\x61\x6C\x54\x6F","\x6C\x65\x6E\x67\x74\x68","\x53\x6F\x6D\x65\x74\x68\x69\x6E\x67\x20\x62\x61\x64\x20\x68\x61\x73\x20\x68\x61\x70\x70\x65\x6E\x65\x64\x21","\x74\x68\x65\x6E","\x66\x69\x6E\x64","\x65\x6D\x61\x69\x6C","\x73\x65\x74","\x63\x6F\x64\x65\x43\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x54\x79\x70\x65","\x63\x75\x72\x72\x65\x6E\x74","\x55\x73\x65\x72","\x73\x63\x68\x6F\x6F\x6C\x49\x44","\x61\x74\x74\x72\x69\x62\x75\x74\x65\x73","\x73\x61\x76\x65","\x65\x6D\x61\x69\x6C\x3D","\x26\x63\x6F\x64\x65\x3D","\x50\x4F\x53\x54","\x2E\x2E\x2F\x65\x6D\x61\x69\x6C\x2E\x70\x68\x70","\x61\x6A\x61\x78","\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x54\x79\x70\x65","\x68\x69\x64\x65","\x23\x61\x64\x64\x75\x73\x65\x72\x73\x73\x65\x63\x74\x69\x6F\x6E","\x63\x6C\x69\x63\x6B","\x72\x65\x70\x6C\x61\x63\x65","\x76\x61\x6C\x75\x65","\x65\x6D\x61\x69\x6C\x73","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x6D\x61\x74\x63\x68","\x2C","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x61\x6C\x6C","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x61\x64\x64\x75\x73\x65\x72","\x6C\x6F\x61\x64"];var generate=function(){var _0x1ca2x2=_0x9dae[2][_0x9dae[1]](_0x9dae[0]);var _0x1ca2x3=[];for(var _0x1ca2x4=0;_0x1ca2x4<15;_0x1ca2x4++){_0x1ca2x3[_0x1ca2x4]=_0x1ca2x2[Math[_0x9dae[4]](Math[_0x9dae[3]]()*10)];if(Math[_0x9dae[4]]((Math[_0x9dae[3]]()*2)+1)%2==0){_0x1ca2x3[_0x1ca2x4]=_0x1ca2x3[_0x1ca2x4][_0x9dae[5]]()}};var _0x1ca2x5=_0x1ca2x3[_0x9dae[6]](_0x9dae[0]);var _0x1ca2x6=Parse[_0x9dae[9]][_0x9dae[8]](_0x9dae[7]);var _0x1ca2x7= new Parse.Query(_0x1ca2x6);_0x1ca2x7[_0x9dae[10]](1000);_0x1ca2x7[_0x9dae[12]](_0x9dae[11],_0x1ca2x5);return _0x1ca2x7[_0x9dae[16]]()[_0x9dae[15]](function(_0x1ca2x8){if(_0x1ca2x8[_0x9dae[13]]!=0){return generate()}else {return _0x1ca2x5}},function(_0x1ca2x9){alert(_0x9dae[14])})};var save_student=function(_0x1ca2xb){var _0x1ca2x6=Parse[_0x9dae[9]][_0x9dae[8]](_0x9dae[7]);var _0x1ca2xc= new _0x1ca2x6();_0x1ca2xc[_0x9dae[18]](_0x9dae[17],_0x1ca2xb[_0x9dae[17]]);_0x1ca2xc[_0x9dae[18]](_0x9dae[11],_0x1ca2xb[_0x9dae[11]]);_0x1ca2xc[_0x9dae[18]](_0x9dae[19],1);var _0x1ca2xd=Parse[_0x9dae[21]][_0x9dae[20]]();_0x1ca2xc[_0x9dae[18]](_0x9dae[22],_0x1ca2xd[_0x9dae[23]][_0x9dae[22]]);_0x1ca2xc[_0x9dae[24]]()};var send_email=function(_0x1ca2xf){for(var _0x1ca2x4=0;_0x1ca2x4<_0x1ca2xf[_0x9dae[13]];_0x1ca2x4++){save_student(_0x1ca2xf[_0x1ca2x4]);var _0x1ca2x10=_0x9dae[25]+_0x1ca2xf[_0x1ca2x4][_0x9dae[17]]+_0x9dae[26]+_0x1ca2xf[_0x1ca2x4][_0x9dae[11]];$[_0x9dae[29]]({type:_0x9dae[27],url:_0x9dae[28],data:_0x1ca2x10,success:function(){}})}};$(window)[_0x9dae[45]](function(){if(Parse[_0x9dae[21]][_0x9dae[20]]()[_0x9dae[23]][_0x9dae[30]]!=0){$(_0x9dae[32])[_0x9dae[31]]()}else {document[_0x9dae[37]](_0x9dae[44])[_0x9dae[43]](_0x9dae[33],function(){var _0x1ca2x11=document[_0x9dae[37]](_0x9dae[36])[_0x9dae[35]][_0x9dae[34]](/\s/g,_0x9dae[0]);var _0x1ca2x12=(_0x1ca2x11[_0x9dae[38]](/,/g)||[])[_0x9dae[13]];var _0x1ca2x13=[];for(var _0x1ca2x4=0;_0x1ca2x4<_0x1ca2x12+1;_0x1ca2x4++){_0x1ca2x13[_0x1ca2x4]=generate()[_0x9dae[15]](function(_0x1ca2x5){if(_0x1ca2x11[_0x9dae[40]](_0x9dae[39])== -1){return {email:_0x1ca2x11,code:_0x1ca2x5}}else {var _0x1ca2x14=_0x1ca2x11[_0x9dae[41]](0,_0x1ca2x11[_0x9dae[40]](_0x9dae[39]));_0x1ca2x11=_0x1ca2x11[_0x9dae[41]](_0x1ca2x11[_0x9dae[40]](_0x9dae[39])+1,_0x1ca2x11[_0x9dae[13]]);return {email:_0x1ca2x14,code:_0x1ca2x5}}})};Promise[_0x9dae[42]](_0x1ca2x13)[_0x9dae[15]](function(_0x1ca2x15){send_email(_0x1ca2x15)})})}}) </script>';
		} else {
			echo '<script language="javascript"> $(window).load(function() {$("#adduserssection").hide();}); </script> ';
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

<body onload = "scrollWindow()">

	<!-- Scroll Window to newest message -->
	<script> 
		function scrollWindow() {
			var element = document.getElementById("chat-content-wrapper");
			element.scrollTop = element.scrollHeight;
		}
	</script>



<header>

	<img src = "https://cdn2.iconfinder.com/data/icons/power-symbol/512/powe_symbol_4-512.png" id = "signout">
	<span id = "user-name"></span>
	<img src = "../img/id-logo.jpg" id = "profile-logo">
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

		<form style = "overflow: hidden" class="class-message-box-container">

		
		</form>
	</section> 



<aside class = "right-sidebar">

	<section>
		<section class="bottomborder-sidebar">
		<br>
		<img src = "../img/id-logo.jpg" id = "id-logo"> <span id = "chat-name"> Participant Name </span> <br> <span id= "preview-mssg"> University of Southern California </span> 
		<br>
		<br>
		<br>
		</section>

		<section class="bottomborder-sidebar">
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
			<br>
		</section>




	</section>
	<br>
<!-- 	<button id = "request">Request ID</button>
	<br><br> -->
	

</aside>

</body>

</html>
