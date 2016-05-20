
	<?php 


	echo '
		\'use strict\';
		
		var generate = function () {
			var alphabet = "abcdefghijklmnopqrstuvwxyz".split('');
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
				alert("Something bad has happened!");
			});
		}

		var save_student = function(studentObj) {
			var Student_Code = Parse.Object.extend("Confirmation_Codes");
				var student_code = new Student_Code();
				student_code.set("email", studentObj.email);
				student_code.set("code", studentObj.code);
				student_code.set("counselorType", 1);
				var currentUser = Parse.User.current();
				student_code.set("schoolID",  currentUser.attributes.schoolID)

				student_code.save();
		}

		var send_email = function (em_arr) {
			for (var i = 0; i < em_arr.length; i++) {
				save_student(em_arr[i]);
				
				var php_data = "email=" + em_arr[i].email + "&code=" + em_arr[i].code;
				console.log(php_data);
				$.ajax({
					type: "POST",
					url: \'../email.php\',
					data: php_data,
					success: function() {}
				});
			}
		}';
		?>
