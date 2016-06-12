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
	  	Parse.User.current().fetch();
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
		if(!isset($currentUser)){
			echo '<script> window.location="../counselor_login.php" </script>';
		}
		if (strcmp($currentUser->get("counselorType"), "0")==0){
			if(isset($_GET['conversationid'])) {
				echo ' <script> console.log(' . $_GET['conversationid'] . '); 


				</script>';
			} else {
				//echo ' <script> </script> ';
			}


			echo '<script language="javascript"> 
					var _0xe5b7=["","\x73\x70\x6C\x69\x74","\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x74\x6F\x55\x70\x70\x65\x72\x43\x61\x73\x65","\x6A\x6F\x69\x6E","\x43\x6F\x6E\x66\x69\x72\x6D\x61\x74\x69\x6F\x6E\x5F\x43\x6F\x64\x65\x73","\x65\x78\x74\x65\x6E\x64","\x4F\x62\x6A\x65\x63\x74","\x6C\x69\x6D\x69\x74","\x63\x6F\x64\x65","\x65\x71\x75\x61\x6C\x54\x6F","\x6C\x65\x6E\x67\x74\x68","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x4F\x4B\x4D\x6F\x64\x61\x6C","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x6E\x6F\x6E\x65","\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C","\x6D\x6F\x64\x61\x6C\x2D\x74\x65\x78\x74","\x54\x68\x65\x72\x65\x20\x73\x65\x65\x6D\x73\x20\x74\x6F\x20\x62\x65\x20\x61\x20\x70\x72\x6F\x62\x6C\x65\x6D\x20\x77\x69\x74\x68\x20\x6F\x75\x72\x20\x77\x65\x62\x73\x69\x74\x65\x2E\x20\x45\x6D\x61\x69\x6C\x20\x75\x73\x20\x61\x74\x20\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x22\x3E\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x3C\x2F\x61\x3E\x2E\x20\x57\x69\x74\x68\x20\x74\x68\x65\x20\x66\x6F\x6C\x6C\x6F\x77\x69\x6E\x67\x20\x69\x6E\x66\x6F\x72\x6D\x61\x74\x69\x6F\x6E\x3A\x20\x3C\x62\x72\x3E\x20\x20\x45\x72\x72\x6F\x72\x20","\x20","\x6D\x65\x73\x73\x61\x67\x65","\x2E","\x6D\x79\x4D\x6F\x64\x61\x6C","\x62\x6C\x6F\x63\x6B","\x74\x68\x65\x6E","\x66\x69\x6E\x64","\x67\x65\x74\x53\x65\x73\x73\x69\x6F\x6E\x54\x6F\x6B\x65\x6E","\x63\x75\x72\x72\x65\x6E\x74","\x55\x73\x65\x72","\x75\x73\x65\x72\x6E\x61\x6D\x65","\x65\x6D\x61\x69\x6C","\x73\x65\x74","\x70\x61\x73\x73\x77\x6F\x72\x64","\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x54\x79\x70\x65","\x31","\x73\x63\x68\x6F\x6F\x6C\x49\x44","\x61\x74\x74\x72\x69\x62\x75\x74\x65\x73","\x69\x73\x41\x76\x61\x69\x6C\x61\x62\x6C\x65","\x72\x6F\x6F\x74\x73\x41\x75\x74\x68\x44\x61\x74\x61","\x6E\x6F\x74\x76\x65\x72\x69\x66\x69\x65\x64","\x62\x65\x63\x6F\x6D\x65","\x65\x6D\x61\x69\x6C\x3D","\x26\x63\x6F\x64\x65\x3D","\x50\x4F\x53\x54","\x2E\x2E\x2F\x65\x6D\x61\x69\x6C\x2E\x70\x68\x70","\x61\x6A\x61\x78","\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A","\x22\x3E","\x3C\x2F\x61\x3E\x20\x20\x68\x61\x73\x20\x61\x6C\x72\x65\x61\x64\x79\x20\x62\x65\x65\x6E\x20\x61\x64\x64\x65\x64\x20\x61\x73\x20\x61\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x2E","\x73\x69\x67\x6E\x55\x70","\x68\x69\x64\x65","\x23\x61\x64\x64\x75\x73\x65\x72\x73\x73\x65\x63\x74\x69\x6F\x6E","\x23\x72\x65\x70\x6F\x72\x74\x75\x72\x67\x65\x6E\x74\x73\x65\x63\x74\x69\x6F\x6E","\x23\x63\x6C\x61\x73\x73\x2D\x6D\x65\x73\x73\x61\x67\x65\x2D\x62\x6F\x78\x2D\x63\x6F\x6E\x74\x61\x69\x6E\x65\x72\x2D\x6D\x61\x69\x6E\x63\x68\x61\x74","\x63\x6C\x69\x63\x6B","\x41\x72\x65\x20\x79\x6F\x75\x20\x73\x75\x72\x65\x20\x79\x6F\x75\x20\x77\x61\x6E\x74\x20\x74\x6F\x20\x61\x64\x64\x20\x74\x68\x65\x73\x65\x20\x65\x6D\x61\x69\x6C\x73\x20\x61\x73\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x73\x3F","\x76\x61\x6C\x75\x65","\x41\x64\x64\x20\x55\x73\x65\x72\x73","\x62\x6F\x72\x64\x65\x72","\x73\x6F\x6C\x69\x64\x20\x31\x70\x78\x20\x23\x35\x31\x43\x37\x38\x31","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x43\x6F\x6C\x6F\x72","\x23\x36\x34\x63\x38\x37\x61","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x35\x43\x41\x37\x35\x39","\x63\x73\x73","\x68\x6F\x76\x65\x72","\x23\x4F\x4B\x4D\x6F\x64\x61\x6C","\x75\x6E\x62\x69\x6E\x64","\x72\x65\x70\x6C\x61\x63\x65","\x65\x6D\x61\x69\x6C\x73","\x6D\x61\x74\x63\x68","\x2C","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x61\x6C\x6C","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x61\x64\x64\x75\x73\x65\x72","\x6C\x6F\x61\x64"];var generate=function(){var _0xe925x2=_0xe5b7[2][_0xe5b7[1]](_0xe5b7[0]);var _0xe925x3=[];for(var _0xe925x4=0;_0xe925x4<15;_0xe925x4++){_0xe925x3[_0xe925x4]=_0xe925x2[Math[_0xe5b7[4]](Math[_0xe5b7[3]]()*10)];if(Math[_0xe5b7[4]]((Math[_0xe5b7[3]]()*2)+1)%2==0){_0xe925x3[_0xe925x4]=_0xe925x3[_0xe925x4][_0xe5b7[5]]()}};var _0xe925x5=_0xe925x3[_0xe5b7[6]](_0xe5b7[0]);var _0xe925x6=Parse[_0xe5b7[9]][_0xe5b7[8]](_0xe5b7[7]);var _0xe925x7= new Parse.Query(_0xe925x6);_0xe925x7[_0xe5b7[10]](1000);_0xe925x7[_0xe5b7[12]](_0xe5b7[11],_0xe925x5);return _0xe925x7[_0xe5b7[28]]()[_0xe5b7[27]](function(_0xe925x8){if(_0xe925x8[_0xe5b7[13]]!=0){return generate()}else {return _0xe925x5}},function(_0xe925x9){document[_0xe5b7[17]](_0xe5b7[16])[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[18];document[_0xe5b7[17]](_0xe5b7[20])[_0xe5b7[19]]=_0xe5b7[21]+_0xe925x9[_0xe5b7[11]]+_0xe5b7[22]+_0xe925x9[_0xe5b7[23]]+_0xe5b7[24];var _0xe925xa=document[_0xe5b7[17]](_0xe5b7[25]);_0xe925xa[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[26]})};var save_student=function(_0xe925xc){var _0xe925xd=Parse[_0xe5b7[31]][_0xe5b7[30]]()[_0xe5b7[29]]();var _0xe925xe= new Parse.User();_0xe925xe[_0xe5b7[34]](_0xe5b7[32],_0xe925xc[_0xe5b7[33]]);_0xe925xe[_0xe5b7[34]](_0xe5b7[35],_0xe925xc[_0xe5b7[11]]);_0xe925xe[_0xe5b7[34]](_0xe5b7[33],_0xe925xc[_0xe5b7[33]]);_0xe925xe[_0xe5b7[34]](_0xe5b7[36],_0xe5b7[37]);_0xe925xe[_0xe5b7[34]](_0xe5b7[38],currentUser[_0xe5b7[39]][_0xe5b7[38]]);_0xe925xe[_0xe5b7[34]](_0xe5b7[40],true);_0xe925xe[_0xe5b7[34]](_0xe5b7[41],_0xe5b7[42]);_0xe925xe[_0xe5b7[52]](null,{success:function(_0xe925xe){Parse[_0xe5b7[31]][_0xe5b7[43]](_0xe925xd);var _0xe925xf=_0xe5b7[44]+_0xe925xc[_0xe5b7[33]]+_0xe5b7[45]+_0xe925xc[_0xe5b7[11]];$[_0xe5b7[48]]({type:_0xe5b7[46],url:_0xe5b7[47],data:_0xe925xf,success:function(){}})},error:function(_0xe925xe,_0xe925x10){if(_0xe925x10[_0xe5b7[11]]=202){document[_0xe5b7[17]](_0xe5b7[16])[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[18];document[_0xe5b7[17]](_0xe5b7[20])[_0xe5b7[19]]=_0xe5b7[49]+_0xe925xc[_0xe5b7[33]]+_0xe5b7[50]+_0xe925xc[_0xe5b7[33]]+_0xe5b7[51];var _0xe925xa=document[_0xe5b7[17]](_0xe5b7[25]);_0xe925xa[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[26]}else {document[_0xe5b7[17]](_0xe5b7[16])[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[18];document[_0xe5b7[17]](_0xe5b7[20])[_0xe5b7[19]]=_0xe5b7[21]+_0xe925x10[_0xe5b7[11]]+_0xe5b7[22]+_0xe925x10[_0xe5b7[23]]+_0xe5b7[24];var _0xe925xa=document[_0xe5b7[17]](_0xe5b7[25]);_0xe925xa[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[26]}}})};var send_email=function(_0xe925x12){for(var _0xe925x4=0;_0xe925x4<_0xe925x12[_0xe5b7[13]];_0xe925x4++){save_student(_0xe925x12[_0xe925x4])}};$(window)[_0xe5b7[80]](function(){if(Parse[_0xe5b7[31]][_0xe5b7[30]]()[_0xe5b7[39]][_0xe5b7[36]]!=0){$(_0xe5b7[54])[_0xe5b7[53]]()}else {$(_0xe5b7[55])[_0xe5b7[53]]();$(_0xe5b7[56])[_0xe5b7[53]]();document[_0xe5b7[17]](_0xe5b7[79])[_0xe5b7[78]](_0xe5b7[57],function(){var _0xe925xa=document[_0xe5b7[17]](_0xe5b7[25]);document[_0xe5b7[17]](_0xe5b7[20])[_0xe5b7[19]]=_0xe5b7[58];document[_0xe5b7[17]](_0xe5b7[16])[_0xe5b7[59]]=_0xe5b7[60];document[_0xe5b7[17]](_0xe5b7[16])[_0xe5b7[15]][_0xe5b7[61]]=_0xe5b7[62];document[_0xe5b7[17]](_0xe5b7[16])[_0xe5b7[15]][_0xe5b7[63]]=_0xe5b7[64];$(_0xe5b7[69])[_0xe5b7[68]](function(){$(this)[_0xe5b7[67]](_0xe5b7[65],_0xe5b7[66])},function(){$(this)[_0xe5b7[67]](_0xe5b7[65],_0xe5b7[64])});$(_0xe5b7[69])[_0xe5b7[70]](_0xe5b7[57]);$(_0xe5b7[69])[_0xe5b7[57]](function(){var _0xe925x13=document[_0xe5b7[17]](_0xe5b7[72])[_0xe5b7[59]][_0xe5b7[71]](/\s/g,_0xe5b7[0]);var _0xe925x14=(_0xe925x13[_0xe5b7[73]](/,/g)||[])[_0xe5b7[13]];var _0xe925x15=[];for(var _0xe925x4=0;_0xe925x4<_0xe925x14+1;_0xe925x4++){_0xe925x15[_0xe925x4]=generate()[_0xe5b7[27]](function(_0xe925x5){if(_0xe925x13[_0xe5b7[75]](_0xe5b7[74])== -1){return {email:_0xe925x13,code:_0xe925x5}}else {var _0xe925x16=_0xe925x13[_0xe5b7[76]](0,_0xe925x13[_0xe5b7[75]](_0xe5b7[74]));_0xe925x13=_0xe925x13[_0xe5b7[76]](_0xe925x13[_0xe5b7[75]](_0xe5b7[74])+1,_0xe925x13[_0xe5b7[13]]);return {email:_0xe925x16,code:_0xe925x5}}},function(_0xe925x17){})};_0xe925xa[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[18];Promise[_0xe5b7[77]](_0xe925x15)[_0xe5b7[27]](function(_0xe925x18){send_email(_0xe925x18);document[_0xe5b7[17]](_0xe5b7[72])[_0xe5b7[59]]=_0xe5b7[0]})});_0xe925xa[_0xe5b7[15]][_0xe5b7[14]]=_0xe5b7[26]})}})	
				</script>';
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
  <script src="../linkify.min.js"></script>
  <script src="../linkify-jquery.min.js"></script>
  <script src="../jquery.query-object.js"></script>
 <!-- <script src="../addUsers.js"></script> -->

</head>

<body>

	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


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
			<textarea id = "notes" rows = "8" cols = "35" class="sidetextarea" placeholder = "Explain your report..."></textarea>
			<br><br>
			<button id = "report">Report User</button> 

			<br>
		</section>

		<section id="adduserssection" class="bottomborder-sidebar">
			<br>
			<textarea id = "emails" rows = "8" cols = "35" class="sidetextarea" placeholder = "Enter emails..."></textarea>
			<br><br>
			<button id = "adduser">Add Counselor</button> 
			<button id = "banuser">Ban Counselor</button> 
			<br>
		</section>
		<section id="unreportsection" class="bottomborder-sidebar">
			<br>
			<button id = "unreport">Undo Report   </button> 
			<br>
		</section>



	</section>
	<br>
<!-- 	<button id = "request">Request ID</button>
	<br><br> -->
	

</aside>



</body>

</html>
