//Used in 'Cover' page to accept e-mails.
function serverPush() {
	var email = document.getElementById('email').value;
	if (email.indexOf('@') != -1) {
		$.ajax({
			method: 'post',
			url: "../cover/toEmail.php",
			data: {email: email},
			success: function (data) {
				console.log(data);
				$("#email").attr("placeholder", "Email received, thanks!");
			}
		});
		document.getElementById('email').value = '';
		$("#email").attr("placeholder", "Posting...");
	}
	else {
		document.getElementById('email').value = '';
		$("#email").attr("placeholder", "Please try again.");
	}

}

function createNewUser () {
        var name = document.getElementById('userName').value;
        var email = document.getElementById('inputEmail').value;
        var pass1 = document.getElementById('inputPassword').value;
        var pass2 = document.getElementById('confirmPassword').value;
        if (pass1 != pass2) {
         alert('passwords don\'t match!');
         return;
        }
        $.ajax({
            method: 'post',
            url: 'mysql/testadd.php',
            data: {
            	name: name,
            	email: email,
            	pass: pass1
            },
            success: function() {
            	console.log('success!');
            }
        });
}
function login() {
	var email = document.getElementById('inputEmail');
	var pass = document.getElementById('inputPassword');
		$.ajax({
			method: 'post',
			url: '../php/login.php',
			data: {
				email: email,
				password: pass
			},
		success: function(data) {
			console.log(data);
		}
	    });
}


