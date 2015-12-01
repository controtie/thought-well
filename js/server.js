//Used in 'Cover' page to accept e-mails.
function serverPush() {
	var email = document.getElementById('email').value;
	if (email.indexOf('@') != -1) {
		$.ajax({
			method: 'post',
			url: "../cover/toEmail.php",
			data: {email: email},
			success: function (data) {
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

function edit_about_me() {
	var about_me = $('#about_me').text();
	var update = window.prompt('Update your about me', about_me);
	$.ajax({
		method: 'post',
		url: "../dashboard/about_me_update.php",
		data: {about_me: update},
		success: function (data) {
			console.log(data);
		}
	});
}

