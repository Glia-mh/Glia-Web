
	
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
				student_code.set("codeCounselorType", 1);
				var currentUser = Parse.User.current();
				student_code.set("schoolID", currentUser.attributes.schoolID);

				student_code.save();
		}

		var send_email = function (em_arr) {
			for (var i = 0; i < em_arr.length; i++) {
				save_student(em_arr[i]);
				
				var php_data = "email=" + em_arr[i].email + "&code=" + em_arr[i].code;
				$.ajax({
					type: "POST",
					url: '../email.php',
					data: php_data,
					success: function() {}
				});
			}
		}

		$(window).load(function() {
			if(Parse.User.current().attributes.counselorType != 0){
				$("#adduserssection").hide();
			} else {
					document.getElementById("adduser").addEventListener("click", function () {
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
						});
					}

					Promise.all(promise_array).then(function (email_array) {
						send_email(email_array);
					});
				});
			}
		});