$(function(){
	$('#registerButton').click(function(e){
		e.preventDefault();
		location.href='registerForm.php';
	});
	
	var form = $('#login');
	var messageHolder = form.find('span');
	
	form.on('submit', function(e){

		if(form.is('.loading, .loggedIn')){
			return false;
		}

		var name = form.find('#name').val();
		var password = form.find('#password').val();
	
		e.preventDefault();
		if(name){
			$.post("includes/Auth/auth.php", {'name': name, 'password': password, 'sendToken': $("#sendToken").prop('checked')}, function(data){
			
				if(!data){
					form.addClass('error');
					messageHolder.text("Login and password input error");
				}
				else{
					form.removeClass('error').addClass('loggedIn');
					location.href='protected.php';
				}
			});
		}	
	});

	$(document).ajaxStart(function(){
		form.addClass('loading');
	});

	$(document).ajaxComplete(function(){
		form.removeClass('loading');
	});
});