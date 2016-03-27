$(function(){
	
	
	var form = $('#register');
	
	if (window.File && window.FileReader && window.FileList && window.Blob){
			document.getElementById('files').addEventListener('change', handleFileSelect, false);
	}
	
	form.on('submit', function(e){
			
		var name = form.find('#name').val();
		var password = form.find('#password').val();
		var confirmpassword = form.find('#confirmpassword').val();
		var email = form.find('#email').val();
		var secret = form.find('#secret').val();
		messageHolder = form.find('span');
				
		e.preventDefault();
		
		// Validation form elements
		if(!isNaN(name)){
			messageHolder.text("Login must contain letters and numbers");
			return false;
		}
		else messageHolder.text("");
		
		if((password != confirmpassword) || (password.length < 1)){
			messageHolder.text("Passwords do not match");
			return false;
		}
		else messageHolder.text("");
			
		if(!isValidEmailAddress(email)){
			messageHolder.text("invalid email");
			return false;
		}
		else messageHolder.text("");
		
		$.post("includes/Captcha/registerCaptcha.php", {secret: secret}, function(data){
			if(data != 'true'){
				messageHolder.text("Error data entry of captcha");
				secret = null;
				setTimeout(function(){
						location.reload();
				}, 3000); 
				return false;
			}
			else {
				messageHolder.text("");
				//Send Form
				var formData = new FormData();
				formData.append('name', name);
				formData.append('password', password);
				formData.append('email', email);
				if(typeof $('#files')[0].files[0] != "undefined")
					formData.append('files', $('#files')[0].files[0],$('#files')[0].files[0].name);
				
				$.ajax({
					url: 'includes/Auth/register.php',
					type: 'POST',
					contentType: false,
					processData: false,
					dataType: 'json',
					data: formData,
					success: function(msg){
						if(msg){
							$('#register').trigger( 'reset' );
							messageHolder.html("Sent to your email message with a link to activate your account. Link to " + "<a href=\"index.php\">Login page<\/a>");
							setTimeout(function(){
								location.replace('../../index.php');
							}, 3000);
						}
						else{
							$('#register').trigger( 'reset' );
							messageHolder.text("Incorrectly filled form");
						}
					}
				});
			}
		},"text");
	});
	
	$(document).ajaxStart(function(){
		form.addClass('loading');
	});

	$(document).ajaxComplete(function(){
		form.removeClass('loading');
	});
});

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i);
    return pattern.test(emailAddress);
}

function handleFileSelect(evt) {
  	if( evt.target.files[0].size > 5000000){
		$('#register').find('span').text("Photo file is too large");
		$('#register')[0].reset();
	}
	else $('#register').find('span').text("");
}