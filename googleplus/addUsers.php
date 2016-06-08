<?php session_start();
if(!isset($_SESSION['google_data_teamroots'])):header("Location:index.php");endif;

  unset($_SESSION['token']);
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

<script src="http://www.parsecdn.com/js/parse-1.5.0.min.js"></script>

	


	<?php 
	echo ' <script> 
    var _0x38f2=["\x70\x79\x61\x33\x6B\x36\x63\x34\x4C\x58\x7A\x5A\x4D\x79\x36\x50\x77\x4D\x48\x38\x30\x6B\x4A\x78\x34\x48\x44\x32\x78\x46\x36\x64\x75\x4C\x53\x53\x64\x59\x55\x6C","\x6E\x73\x41\x6F\x67\x47\x52\x64\x33\x4C\x6D\x4F\x62\x42\x45\x35\x6A\x6B\x31\x45\x33\x70\x69\x6C\x56\x54\x44\x62\x50\x47\x41\x45\x48\x70\x54\x5A\x77\x76\x6F\x62","\x69\x6E\x69\x74\x69\x61\x6C\x69\x7A\x65","\x53\x63\x68\x6F\x6F\x6C\x49\x44\x73","\x53\x63\x68\x6F\x6F\x6C\x4E\x61\x6D\x65","\x67\x65\x74","\x70\x75\x73\x68","\x66\x6F\x72\x45\x61\x63\x68","\x66\x69\x6E\x64","\x61\x75\x74\x6F\x63\x6F\x6D\x70\x6C\x65\x74\x65","\x23\x73\x63\x68\x6F\x6F\x6C\x69\x6E\x70\x75\x74","","\x73\x70\x6C\x69\x74","\x61\x62\x63\x64\x65\x66\x67\x68\x69\x6A\x6B\x6C\x6D\x6E\x6F\x70\x71\x72\x73\x74\x75\x76\x77\x78\x79\x7A","\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","\x74\x6F\x55\x70\x70\x65\x72\x43\x61\x73\x65","\x6A\x6F\x69\x6E","\x75\x73\x65\x72\x6E\x61\x6D\x65","\x65\x6D\x61\x69\x6C","\x73\x65\x74","\x70\x61\x73\x73\x77\x6F\x72\x64","\x63\x6F\x64\x65","\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x54\x79\x70\x65","\x30","\x73\x63\x68\x6F\x6F\x6C\x49\x44","\x76\x61\x6C\x75\x65","\x73\x63\x68\x6F\x6F\x6C\x69\x6E\x70\x75\x74","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x69\x73\x41\x76\x61\x69\x6C\x61\x62\x6C\x65","\x72\x6F\x6F\x74\x73\x41\x75\x74\x68\x44\x61\x74\x61","\x6E\x6F\x74\x76\x65\x72\x69\x66\x69\x65\x64","\x65\x6D\x61\x69\x6C\x3D","\x26\x63\x6F\x64\x65\x3D","\x50\x4F\x53\x54","\x65\x6D\x61\x69\x6C\x2E\x70\x68\x70","\x6C\x6F\x67\x4F\x75\x74","\x55\x73\x65\x72","\x61\x6A\x61\x78","\x64\x69\x73\x70\x6C\x61\x79","\x73\x74\x79\x6C\x65","\x4F\x4B\x4D\x6F\x64\x61\x6C","\x6E\x6F\x6E\x65","\x69\x6E\x6E\x65\x72\x48\x54\x4D\x4C","\x6D\x6F\x64\x61\x6C\x2D\x74\x65\x78\x74","\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A","\x22\x3E","\x3C\x2F\x61\x3E\x20\x20\x68\x61\x73\x20\x61\x6C\x72\x65\x61\x64\x79\x20\x62\x65\x65\x6E\x20\x61\x64\x64\x65\x64\x20\x61\x73\x20\x61\x20\x63\x6F\x75\x6E\x73\x65\x6C\x6F\x72\x2E","\x6D\x79\x4D\x6F\x64\x61\x6C","\x62\x6C\x6F\x63\x6B","\x54\x68\x65\x72\x65\x20\x73\x65\x65\x6D\x73\x20\x74\x6F\x20\x62\x65\x20\x61\x20\x70\x72\x6F\x62\x6C\x65\x6D\x20\x77\x69\x74\x68\x20\x6F\x75\x72\x20\x77\x65\x62\x73\x69\x74\x65\x2E\x20\x45\x6D\x61\x69\x6C\x20\x75\x73\x20\x61\x74\x20\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x6D\x61\x69\x6C\x74\x6F\x3A\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x22\x3E\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x40\x74\x65\x61\x6D\x72\x6F\x6F\x74\x73\x2E\x6F\x72\x67\x3C\x2F\x61\x3E\x2E\x20\x57\x69\x74\x68\x20\x74\x68\x65\x20\x66\x6F\x6C\x6C\x6F\x77\x69\x6E\x67\x20\x69\x6E\x66\x6F\x72\x6D\x61\x74\x69\x6F\x6E\x3A\x20\x3C\x62\x72\x3E\x20\x20\x45\x72\x72\x6F\x72\x20","\x20","\x6D\x65\x73\x73\x61\x67\x65","\x2E","\x73\x69\x67\x6E\x55\x70","\x6C\x65\x6E\x67\x74\x68","\x69\x6E\x6C\x69\x6E\x65","\x63\x6C\x69\x63\x6B","\x23\x63\x6C\x6F\x73\x65","\x23\x63\x61\x6E\x63\x65\x6C\x4D\x6F\x64\x61\x6C","\x41\x72\x65\x20\x79\x6F\x75\x20\x73\x75\x72\x65\x20\x79\x6F\x75\x20\x77\x61\x6E\x74\x20\x74\x6F\x20\x61\x64\x64\x20\x74\x68\x65\x73\x65\x20\x65\x6D\x61\x69\x6C\x73\x20\x61\x73\x20\x61\x64\x6D\x69\x6E\x73\x3F","\x41\x64\x64\x20\x41\x64\x6D\x69\x6E","\x62\x6F\x72\x64\x65\x72","\x73\x6F\x6C\x69\x64\x20\x31\x70\x78\x20\x23\x35\x31\x43\x37\x38\x31","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x43\x6F\x6C\x6F\x72","\x23\x36\x34\x63\x38\x37\x61","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x35\x43\x41\x37\x35\x39","\x63\x73\x73","\x68\x6F\x76\x65\x72","\x23\x4F\x4B\x4D\x6F\x64\x61\x6C","\x75\x6E\x62\x69\x6E\x64","\x72\x65\x70\x6C\x61\x63\x65","\x65\x6D\x61\x69\x6C\x2D\x6C\x69\x73\x74","\x6D\x61\x74\x63\x68","\x2C","\x69\x6E\x64\x65\x78\x4F\x66","\x73\x75\x62\x73\x74\x72\x69\x6E\x67","\x74\x68\x65\x6E","\x61\x6C\x6C","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x73\x75\x62\x6D\x69\x74\x2D\x62\x75\x74\x74\x6F\x6E","\x6C\x6F\x61\x64"];Parse[_0x38f2[2]](_0x38f2[0],_0x38f2[1]);$(function(){var _0xdd17x1= new Parse.Query(_0x38f2[3]);var _0xdd17x2=[];var _0xdd17x3=[];_0xdd17x1[_0x38f2[8]]({success:function(_0xdd17x4){_0xdd17x4[_0x38f2[7]](function(_0xdd17x5){_0xdd17x2[_0x38f2[6]](_0xdd17x5[_0x38f2[5]](_0x38f2[4]));_0xdd17x3[_0xdd17x5[_0x38f2[5]](_0x38f2[4])]=_0xdd17x5})},error:function(_0xdd17x6){}});$(_0x38f2[10])[_0x38f2[9]]({source:_0xdd17x2});var _0xdd17x7=function(){var _0xdd17x8=_0x38f2[13][_0x38f2[12]](_0x38f2[11]);var _0xdd17x9=[];for(var _0xdd17xa=0;_0xdd17xa<15;_0xdd17xa++){_0xdd17x9[_0xdd17xa]=_0xdd17x8[Math[_0x38f2[15]](Math[_0x38f2[14]]()*10)];if(Math[_0x38f2[15]]((Math[_0x38f2[14]]()*2)+1)%2==0){_0xdd17x9[_0xdd17xa]=_0xdd17x9[_0xdd17xa][_0x38f2[16]]()}};var _0xdd17xb=_0xdd17x9[_0x38f2[17]](_0x38f2[11]);return _0xdd17xb};var _0xdd17xc=function(_0xdd17xd){var _0xdd17xe= new Parse.User();_0xdd17xe[_0x38f2[20]](_0x38f2[18],_0xdd17xd[_0x38f2[19]]);_0xdd17xe[_0x38f2[20]](_0x38f2[21],_0xdd17xd[_0x38f2[22]]);_0xdd17xe[_0x38f2[20]](_0x38f2[19],_0xdd17xd[_0x38f2[19]]);_0xdd17xe[_0x38f2[20]](_0x38f2[23],_0x38f2[24]);_0xdd17xe[_0x38f2[20]](_0x38f2[25],_0xdd17x3[document[_0x38f2[28]](_0x38f2[27])[_0x38f2[26]]]);_0xdd17xe[_0x38f2[20]](_0x38f2[29],true);_0xdd17xe[_0x38f2[20]](_0x38f2[30],_0x38f2[31]);_0xdd17xe[_0x38f2[54]](null,{success:function(_0xdd17xe){var _0xdd17xf=_0x38f2[32]+_0xdd17xd[_0x38f2[19]]+_0x38f2[33]+_0xdd17xd[_0x38f2[22]];$[_0x38f2[38]]({type:_0x38f2[34],url:_0x38f2[35],data:_0xdd17xf,success:function(){Parse[_0x38f2[37]][_0x38f2[36]]()}})},error:function(_0xdd17xe,_0xdd17x6){if(_0xdd17x6[_0x38f2[22]]=202){document[_0x38f2[28]](_0x38f2[41])[_0x38f2[40]][_0x38f2[39]]=_0x38f2[42];document[_0x38f2[28]](_0x38f2[44])[_0x38f2[43]]=_0x38f2[45]+_0xdd17xd[_0x38f2[19]]+_0x38f2[46]+_0xdd17xd[_0x38f2[19]]+_0x38f2[47];var _0xdd17x10=document[_0x38f2[28]](_0x38f2[48]);_0xdd17x10[_0x38f2[40]][_0x38f2[39]]=_0x38f2[49]}else {document[_0x38f2[28]](_0x38f2[41])[_0x38f2[40]][_0x38f2[39]]=_0x38f2[42];document[_0x38f2[28]](_0x38f2[44])[_0x38f2[43]]=_0x38f2[50]+_0xdd17x6[_0x38f2[22]]+_0x38f2[51]+_0xdd17x6[_0x38f2[52]]+_0x38f2[53];var _0xdd17x10=document[_0x38f2[28]](_0x38f2[48]);_0xdd17x10[_0x38f2[40]][_0x38f2[39]]=_0x38f2[49]}}})};var _0xdd17x11=function(_0xdd17x12){for(var _0xdd17xa=0;_0xdd17xa<_0xdd17x12[_0x38f2[55]];_0xdd17xa++){_0xdd17xc(_0xdd17x12[_0xdd17xa])}};$(window)[_0x38f2[82]](function(){$(_0x38f2[58])[_0x38f2[57]](function(){var _0xdd17x10=document[_0x38f2[28]](_0x38f2[48]);_0xdd17x10[_0x38f2[40]][_0x38f2[39]]=_0x38f2[42];document[_0x38f2[28]](_0x38f2[41])[_0x38f2[40]][_0x38f2[39]]=_0x38f2[56]});$(_0x38f2[59])[_0x38f2[57]](function(){var _0xdd17x10=document[_0x38f2[28]](_0x38f2[48]);_0xdd17x10[_0x38f2[40]][_0x38f2[39]]=_0x38f2[42];document[_0x38f2[28]](_0x38f2[41])[_0x38f2[40]][_0x38f2[39]]=_0x38f2[56]});document[_0x38f2[28]](_0x38f2[81])[_0x38f2[80]](_0x38f2[57],function(){var _0xdd17x10=document[_0x38f2[28]](_0x38f2[48]);document[_0x38f2[28]](_0x38f2[44])[_0x38f2[43]]=_0x38f2[60];document[_0x38f2[28]](_0x38f2[41])[_0x38f2[26]]=_0x38f2[61];document[_0x38f2[28]](_0x38f2[41])[_0x38f2[40]][_0x38f2[62]]=_0x38f2[63];document[_0x38f2[28]](_0x38f2[41])[_0x38f2[40]][_0x38f2[64]]=_0x38f2[65];$(_0x38f2[70])[_0x38f2[69]](function(){$(this)[_0x38f2[68]](_0x38f2[66],_0x38f2[67])},function(){$(this)[_0x38f2[68]](_0x38f2[66],_0x38f2[65])});$(_0x38f2[70])[_0x38f2[71]](_0x38f2[57]);$(_0x38f2[70])[_0x38f2[57]](function(){var _0xdd17x13=document[_0x38f2[28]](_0x38f2[73])[_0x38f2[26]][_0x38f2[72]](/\s/g,_0x38f2[11]);var _0xdd17x14=(_0xdd17x13[_0x38f2[74]](/,/g)||[])[_0x38f2[55]];var _0xdd17x15=[];for(var _0xdd17xa=0;_0xdd17xa<_0xdd17x14+1;_0xdd17xa++){var _0xdd17xb=_0xdd17x7();if(_0xdd17x13[_0x38f2[76]](_0x38f2[75])== -1){_0xdd17x15[_0xdd17xa]={email:_0xdd17x13,code:_0xdd17xb}}else {var _0xdd17x16=_0xdd17x13[_0x38f2[77]](0,_0xdd17x13[_0x38f2[76]](_0x38f2[75]));_0xdd17x13=_0xdd17x13[_0x38f2[77]](_0xdd17x13[_0x38f2[76]](_0x38f2[75])+1,_0xdd17x13[_0x38f2[55]]);_0xdd17x15[_0xdd17xa]={email:_0xdd17x16,code:_0xdd17xb}}};_0xdd17x10[_0x38f2[40]][_0x38f2[39]]=_0x38f2[42];Promise[_0x38f2[79]](_0xdd17x15)[_0x38f2[78]](function(_0xdd17x17){_0xdd17x11(_0xdd17x17);document[_0x38f2[28]](_0x38f2[73])[_0x38f2[26]]=_0x38f2[11];document[_0x38f2[28]](_0x38f2[27])[_0x38f2[26]]=_0x38f2[11]})});_0xdd17x10[_0x38f2[40]][_0x38f2[39]]=_0x38f2[49]})})}) 
    </script>';
		?>
