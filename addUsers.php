
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
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

<script src="http://www.parsecdn.com/js/parse-1.5.0.min.js"></script>
  <script>
    Parse.initialize("pya3k6c4LXzZMy6PwMH80kJx4HD2xF6duLSSdYUl", "nsAogGRd3LmObBE5jk1E3pilVTDbPGAEHpTZwvob");
  $(function() {
	var query = new Parse.Query("SchoolIDs");
	var  schoolNames = [];
	var schools=[];
	query.find({
	  success: function(results) {
	    results.forEach(function(result) {
	    	schoolNames.push(result.get("SchoolName"));
	    	schools[result.get("SchoolName")] = result;
	    });
	  },

	  error: function(error) {
	    // error is an instance of Parse.Error.
	  }
	});

    $( "#schoolinput" ).autocomplete({
      source: schoolNames
    });

var generate = function () {
      var alphabet = "abcdefghijklmnopqrstuvwxyz".split('');
      var code_array = [];
      for (var i = 0; i < 15; i++) {
        code_array[i] = alphabet[Math.floor(Math.random() * 10)];
        if (Math.floor((Math.random() * 2) + 1) % 2 == 0)
          code_array[i] = code_array[i].toUpperCase();
      }
      var code = code_array.join("");
      return code;
    }



    var save_student = function(studentObj) {
      var sessionToken = Parse.User.current().getSessionToken();
      var user = new Parse.User();
      user.set("username", studentObj.email);
      user.set("password", studentObj.code);
      user.set("email", studentObj.email);
      user.set("counselorType", "0");
      user.set("schoolID" , schools[this.elements["school"].value]);
      user.set("isAvailable", true);
      user.set("rootsAuthData", "notverified");

      user.signUp(null, {
        success: function(user) {
          Parse.User.become(sessionToken);
          var php_data = "email=" + studentObj.email + "&code=" + studentObj.code;
          $.ajax({
            type: "POST",
            url: '../email.php',
            data: php_data,
            success: function() {}
        });
        },
        error: function(user, error) {
          // Show the error message somewhere and let the user try again.
          if(error.code=202){
            document.getElementById("OKModal").style.display="none";
            document.getElementById("modal-text").innerHTML= '<a href="mailto:' +studentObj.email + '">' + studentObj.email + '</a>  has already been added as a counselor.';
            var modal = document.getElementById('myModal');
            modal.style.display="block";
          } else {
            document.getElementById("OKModal").style.display="none";
            document.getElementById("modal-text").innerHTML= 'There seems to be a problem with our website. Email us at <a href="mailto:teamroots@teamroots.org">teamroots@teamroots.org</a>. With the following information: <br>  Error ' +error.code + ' ' + error.message + '.';
            var modal = document.getElementById('myModal');
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
        document.getElementById("submit-button").addEventListener("click", function () {
        //  var modal = document.getElementById('myModal');
          

          



         // document.getElementById("modal-text").innerHTML= "Are you sure you want to add these emails as counselors?";
          // document.getElementById("OKModal").value="Add Users";
         // document.getElementById("OKModal").style.border="solid 1px #51C781";
         // document.getElementById("OKModal").style.backgroundColor="#64c87a";
          /* $("#OKModal").hover(function(){
              $(this).css("background-color", "#5CA759");
              }, function(){
              $(this).css("background-color", "#64c87a");
          }); */
        
          //$( "#OKModal").unbind("click");

          //OK Button
          //$("#OKModal").click(function() {
            var email_text = document.getElementById("emails").value.replace(/\s/g, '');
            var num_commas = (email_text.match(/,/g) || []).length;
            var promise_array = [];
            for (var i = 0; i < num_commas + 1; i++) {
              promise_array[i] = generate().then(function (code) {
                if (email_text.indexOf(',') == -1) {
                  return {email: email_text, code: code};
                } else {
                  var email = email_text.substring(0, email_text.indexOf(','));
                  email_text = email_text.substring(email_text.indexOf(',') + 1, email_text.length);
                  return {email: email, code: code};
                }
              }, function(reason) {
              });
            }
            modal.style.display = "none";
            Promise.all(promise_array).then(function (email_array) {
              send_email(email_array);
              document.getElementById("emails").value="";
            });
         // });

          //show modal
         // modal.style.display = "block";

            

            

          
          
          
        });
    });





  }); //end of lambda function




</script>
	


	<?php 
	echo '';
		?>
