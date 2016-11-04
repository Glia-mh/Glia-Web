<?php session_start();
if(!isset($_SESSION['google_data_teamroots'])):header("Location:index.php");endif;
 
  
  unset($_SESSION['token']);
   $name =  $_SESSION['google_data_teamroots']['name'];
  $picture = $_SESSION['google_data_teamroots']['picture'];
  unset($_SESSION['google_data_teamroots']); //Google session data unset

  if(isset($gClient)){
    $gClient->revokeToken();
  }
  session_destroy();
?>




	<link rel="stylesheet" type="text/css" href="../style/style.css"/>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 
<?php 

echo '
<header>

  <img src = "https://cdn2.iconfinder.com/data/icons/power-symbol/512/powe_symbol_4-512.png" id = "signout">
  <span id = "user-name">'.$name.'</span>

  <img id = "profile-logo" src="'.$picture.'">
  

 
  <img src = "../img/team-roots-logo.png" id = "header-logo">
  <script type="text/javascript">
  console.log("Team Roots, Debug Aditya Nov 3, 2016")
  console.log("'.$_SESSION['google_data_teamroots'].'")
  $( "#signout" ).click(function() {
  
          window.location="logout.php?logout"
        });
</script>
</header>';
?>




  <body style="display:table; height:100%;">
	<form style="display:table-cell; vertical-align:middle;">
		<textarea class="add-admins-textarea" id="email-list" placeholder = "Enter emails..."></textarea> <br> <br>
		<input type="text" name="school" id="schoolinput" class="form-field" placeholder="School Name" required>
		<input type="button" value="Finish" class="button" id="submit-button">
	</form>
  



</body>



<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="close">x</span>
    <br>
    <p id="modal-text">Some text in the Modal..</p>
     <br>
  <div class="modal-options">
    <input type="submit" class="button" id="OKModal" value="Ok">
    <input type="submit" class="button-subtheme" id="cancelModal" value="Cancel">
  </div>
  </div>
</div>

<script src="http://www.parsecdn.com/js/parse-1.5.0.min.js"></script>

	


	<?php 
	echo ' <script> 
var _0xf597=["\x70\x79\x61\x33\x6B\x36\x63\x34\x4C\x58\x7A\x5A\x4D\x79\x36\x50\x77\x4D\x48\x38\x30\x6B\x4A\x78\x34\x48\x44\x32\x78\x46\x36\x64\x75\x4C\x53\x53\x64\x59\x55\x6C","\x6E\x73\x41\x6F\x67\x47\x52\x64\x33\x4C\x6D\x4F\x62\x42\x45\x35\x6A\x6B\x31\x45\x33\x70\x69\x6C\x56\x54\x44\x62\x50\x47\x41\x45\x48\x70\x54\x5A\x77\x76\x6F\x62","\x69\x6E\x69\x74\x69\x61\x6C\x69\x7A\x65","\x53\x63\x68\x6F\x6F\x6C\x49\x44\x73","\x53\x63\x68\x6F\x6F\x6C\x4E\x61\x6D\x65","\x67\x65\x74","\x70\x75\x73\x68","\x66\x6F\x72\x45\x61\x63\x68","\x66\x69\x6E\x64","\x61\x75\x74\x6F\x63\x6F\x6D\x70\x6C\x65\x74\x65","\x23\x73\x63\x68\x6F\x6F\x6C\x69\x6E\x70\x75\x74","","\x73\x70\x6C\x69\x74","\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x74\x6F\x55\x70\x70\x65\x72\x43\x61\x73\x65","\x6A\x6F\x69\x6E","\x75\x73\x65\x72\x6E\x61\x6D\x65","\x65\x6D\x61\x69\x6C","\x73\x65\x74","\x70\x61\x73\x73\x77\x6F\x72\x64","\x63\x6F\x64\x65","\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x54\x79\x70\x65","\x30","\x73\x63\x68\x6F\x6F\x6C\x49\x44","\x76\x61\x6C\x75\x65","\x73\x63\x68\x6F\x6F\x6C\x69\x6E\x70\x75\x74","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x69\x73\x41\x76\x61\x69\x6C\x61\x62\x6C\x65","\x72\x6F\x6F\x74\x73\x41\x75\x74\x68\x44\x61\x74\x61","\x6E\x6F\x74\x76\x65\x72\x69\x66\x69\x65\x64","\x65\x6D\x61\x69\x6C\x3D","\x26\x63\x6F\x64\x65\x3D","\x50\x4F\x53\x54","\x2E\x2E\x2F\x65\x6D\x61\x69\x6C\x2E\x70\x68\x70","\x6C\x6F\x67\x4F\x75\x74","\x55\x73\x65\x72","\x53\x55\x43\x43\x45\x53\x53","\x6C\x6F\x67","\x61\x6A\x61\x78","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x4F\x4B\x4D\x6F\x64\x61\x6C","\x6E\x6F\x6E\x65","\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C","\x6D\x6F\x64\x61\x6C\x2D\x74\x65\x78\x74","\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A","\x22\x3E","\x3C\x2F\x61\x3E\x20\x20\x68\x61\x73\x20\x61\x6C\x72\x65\x61\x64\x79\x20\x62\x65\x65\x6E\x20\x61\x64\x64\x65\x64\x20\x61\x73\x20\x61\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x2E","\x6D\x79\x4D\x6F\x64\x61\x6C","\x62\x6C\x6F\x63\x6B","\x54\x68\x65\x72\x65\x20\x73\x65\x65\x6D\x73\x20\x74\x6F\x20\x62\x65\x20\x61\x20\x70\x72\x6F\x62\x6C\x65\x6D\x20\x77\x69\x74\x68\x20\x6F\x75\x72\x20\x77\x65\x62\x73\x69\x74\x65\x2E\x20\x45\x6D\x61\x69\x6C\x20\x75\x73\x20\x61\x74\x20\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x22\x3E\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x3C\x2F\x61\x3E\x2E\x20\x57\x69\x74\x68\x20\x74\x68\x65\x20\x66\x6F\x6C\x6C\x6F\x77\x69\x6E\x67\x20\x69\x6E\x66\x6F\x72\x6D\x61\x74\x69\x6F\x6E\x3A\x20\x3C\x62\x72\x3E\x20\x20\x45\x72\x72\x6F\x72\x20","\x20","\x6D\x65\x73\x73\x61\x67\x65","\x2E","\x73\x69\x67\x6E\x55\x70","\x6C\x65\x6E\x67\x74\x68","\x69\x6E\x6C\x69\x6E\x65","\x63\x6C\x69\x63\x6B","\x23\x63\x6C\x6F\x73\x65","\x23\x63\x61\x6E\x63\x65\x6C\x4D\x6F\x64\x61\x6C","\x41\x72\x65\x20\x79\x6F\x75\x20\x73\x75\x72\x65\x20\x79\x6F\x75\x20\x77\x61\x6E\x74\x20\x74\x6F\x20\x61\x64\x64\x20\x74\x68\x65\x73\x65\x20\x65\x6D\x61\x69\x6C\x73\x20\x61\x73\x20\x61\x64\x6D\x69\x6E\x73\x3F","\x41\x64\x64\x20\x41\x64\x6D\x69\x6E","\x62\x6F\x72\x64\x65\x72","\x73\x6F\x6C\x69\x64\x20\x31\x70\x78\x20\x23\x35\x31\x43\x37\x38\x31","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x43\x6F\x6C\x6F\x72","\x23\x36\x34\x63\x38\x37\x61","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x35\x43\x41\x37\x35\x39","\x63\x73\x73","\x68\x6F\x76\x65\x72","\x23\x4F\x4B\x4D\x6F\x64\x61\x6C","\x75\x6E\x62\x69\x6E\x64","\x72\x65\x70\x6C\x61\x63\x65","\x65\x6D\x61\x69\x6C\x2D\x6C\x69\x73\x74","\x6D\x61\x74\x63\x68","\x2C","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x74\x68\x65\x6E","\x61\x6C\x6C","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x73\x75\x62\x6D\x69\x74\x2D\x62\x75\x74\x74\x6F\x6E","\x6C\x6F\x61\x64"];Parse[_0xf597[2]](_0xf597[0],_0xf597[1]);$(function(){var _0x462bx1= new Parse.Query(_0xf597[3]);var _0x462bx2=[];var _0x462bx3=[];_0x462bx1[_0xf597[8]]({success:function(_0x462bx4){_0x462bx4[_0xf597[7]](function(_0x462bx5){_0x462bx2[_0xf597[6]](_0x462bx5[_0xf597[5]](_0xf597[4]));_0x462bx3[_0x462bx5[_0xf597[5]](_0xf597[4])]= _0x462bx5})},error:function(_0x462bx6){}});$(_0xf597[10])[_0xf597[9]]({source:_0x462bx2});var _0x462bx7=function(){var _0x462bx8=_0xf597[13][_0xf597[12]](_0xf597[11]);var _0x462bx9=[];for(var _0x462bxa=0;_0x462bxa< 15;_0x462bxa++){_0x462bx9[_0x462bxa]= _0x462bx8[Math[_0xf597[15]](Math[_0xf597[14]]()* 10)];if(Math[_0xf597[15]]((Math[_0xf597[14]]()* 2)+ 1)% 2== 0){_0x462bx9[_0x462bxa]= _0x462bx9[_0x462bxa][_0xf597[16]]()}};var _0x462bxb=_0x462bx9[_0xf597[17]](_0xf597[11]);return _0x462bxb};var _0x462bxc=function(_0x462bxd){var _0x462bxe= new Parse.User();_0x462bxe[_0xf597[20]](_0xf597[18],_0x462bxd[_0xf597[19]]);_0x462bxe[_0xf597[20]](_0xf597[21],_0x462bxd[_0xf597[22]]);_0x462bxe[_0xf597[20]](_0xf597[19],_0x462bxd[_0xf597[19]]);_0x462bxe[_0xf597[20]](_0xf597[23],_0xf597[24]);_0x462bxe[_0xf597[20]](_0xf597[25],_0x462bx3[document[_0xf597[28]](_0xf597[27])[_0xf597[26]]]);_0x462bxe[_0xf597[20]](_0xf597[29],true);_0x462bxe[_0xf597[20]](_0xf597[30],_0xf597[31]);_0x462bxe[_0xf597[56]](null,{success:function(_0x462bxe){var _0x462bxf=_0xf597[32]+ _0x462bxd[_0xf597[19]]+ _0xf597[33]+ _0x462bxd[_0xf597[22]];$[_0xf597[40]]({type:_0xf597[34],url:_0xf597[35],data:_0x462bxf,success:function(){Parse[_0xf597[37]][_0xf597[36]]();console[_0xf597[39]](_0xf597[38])}})},error:function(_0x462bxe,_0x462bx6){if(_0x462bx6[_0xf597[22]]= 202){document[_0xf597[28]](_0xf597[43])[_0xf597[42]][_0xf597[41]]= _0xf597[44];document[_0xf597[28]](_0xf597[46])[_0xf597[45]]= _0xf597[47]+ _0x462bxd[_0xf597[19]]+ _0xf597[48]+ _0x462bxd[_0xf597[19]]+ _0xf597[49];var _0x462bx10=document[_0xf597[28]](_0xf597[50]);_0x462bx10[_0xf597[42]][_0xf597[41]]= _0xf597[51]}else {document[_0xf597[28]](_0xf597[43])[_0xf597[42]][_0xf597[41]]= _0xf597[44];document[_0xf597[28]](_0xf597[46])[_0xf597[45]]= _0xf597[52]+ _0x462bx6[_0xf597[22]]+ _0xf597[53]+ _0x462bx6[_0xf597[54]]+ _0xf597[55];var _0x462bx10=document[_0xf597[28]](_0xf597[50]);_0x462bx10[_0xf597[42]][_0xf597[41]]= _0xf597[51]}}})};var _0x462bx11=function(_0x462bx12){for(var _0x462bxa=0;_0x462bxa< _0x462bx12[_0xf597[57]];_0x462bxa++){_0x462bxc(_0x462bx12[_0x462bxa])}};$(window)[_0xf597[84]](function(){$(_0xf597[60])[_0xf597[59]](function(){var _0x462bx10=document[_0xf597[28]](_0xf597[50]);_0x462bx10[_0xf597[42]][_0xf597[41]]= _0xf597[44];document[_0xf597[28]](_0xf597[43])[_0xf597[42]][_0xf597[41]]= _0xf597[58]});$(_0xf597[61])[_0xf597[59]](function(){var _0x462bx10=document[_0xf597[28]](_0xf597[50]);_0x462bx10[_0xf597[42]][_0xf597[41]]= _0xf597[44];document[_0xf597[28]](_0xf597[43])[_0xf597[42]][_0xf597[41]]= _0xf597[58]});document[_0xf597[28]](_0xf597[83])[_0xf597[82]](_0xf597[59],function(){var _0x462bx10=document[_0xf597[28]](_0xf597[50]);document[_0xf597[28]](_0xf597[46])[_0xf597[45]]= _0xf597[62];document[_0xf597[28]](_0xf597[43])[_0xf597[26]]= _0xf597[63];document[_0xf597[28]](_0xf597[43])[_0xf597[42]][_0xf597[64]]= _0xf597[65];document[_0xf597[28]](_0xf597[43])[_0xf597[42]][_0xf597[66]]= _0xf597[67];$(_0xf597[72])[_0xf597[71]](function(){$(this)[_0xf597[70]](_0xf597[68],_0xf597[69])},function(){$(this)[_0xf597[70]](_0xf597[68],_0xf597[67])});$(_0xf597[72])[_0xf597[73]](_0xf597[59]);$(_0xf597[72])[_0xf597[59]](function(){var _0x462bx13=document[_0xf597[28]](_0xf597[75])[_0xf597[26]][_0xf597[74]](/\s/g,_0xf597[11]);var _0x462bx14=(_0x462bx13[_0xf597[76]](/,/g)|| [])[_0xf597[57]];var _0x462bx15=[];for(var _0x462bxa=0;_0x462bxa< _0x462bx14+ 1;_0x462bxa++){var _0x462bxb=_0x462bx7();if(_0x462bx13[_0xf597[78]](_0xf597[77])==  -1){_0x462bx15[_0x462bxa]= {email:_0x462bx13,code:_0x462bxb}}else {var _0x462bx16=_0x462bx13[_0xf597[79]](0,_0x462bx13[_0xf597[78]](_0xf597[77]));_0x462bx13= _0x462bx13[_0xf597[79]](_0x462bx13[_0xf597[78]](_0xf597[77])+ 1,_0x462bx13[_0xf597[57]]);_0x462bx15[_0x462bxa]= {email:_0x462bx16,code:_0x462bxb}}};_0x462bx10[_0xf597[42]][_0xf597[41]]= _0xf597[44];Promise[_0xf597[81]](_0x462bx15)[_0xf597[80]](function(_0x462bx17){_0x462bx11(_0x462bx17);document[_0xf597[28]](_0xf597[75])[_0xf597[26]]= _0xf597[11];document[_0xf597[28]](_0xf597[27])[_0xf597[26]]= _0xf597[11]})});_0x462bx10[_0xf597[42]][_0xf597[41]]= _0xf597[51]})})})
    </script>';
		?>
