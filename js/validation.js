function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

// *************Contact Form Validation*******************
$('#contact').submit(function () {

	var errorMsg = '';
	$('input').removeClass('form-error');
	$('textarea').removeClass('form-error');

	if ($('#name').val() == '') {
		errorMsg += '<small>Please fill in your name</small><br>';
		$('#name').addClass('form-error');
	}

	if ($('#email').val() == '') {
		errorMsg += '<small>Please fill in your email address</small><br>';
		$('#email').addClass('form-error');
	}
	else if(!isEmail($('#email').val())) {
		errorMsg += '<small>Your email is not valid</small><br>';
		$('#email').addClass('form-error');
	}

	if ($('#subject').val() == '') {
		errorMsg += '<small>The subject field is required</small><br>';
		$('#subject').addClass('form-error');
	}

	if ($('#content').val() == '') {
		errorMsg += '<small>The content field is required</small>';
		$('#content').addClass('form-error');
	}


	if (errorMsg != '') {
		$('#status').html(errorMsg).addClass('alert alert-danger text-muted');
		return false;
	}
	else {
		return true;
	}

}, //$('#status').text("Message sent! We'll get back to you shortly").addClass('alert alert-success')
);


// *************Registration Form Validation*******************
$('#registration').submit(function () {

	var errorMsg = '';
	$('input').removeClass('form-error');
	$('textarea').removeClass('form-error');

	if ($('#firstname').val() == '') {
		errorMsg += '<small>Please fill in your first name</small><br>';
		$('#firstname').addClass('form-error');
	}

	if ($('#lastname').val() == '') {
		errorMsg += '<small>Please fill in your last name</small><br>';
		$('#lastname').addClass('form-error');
	}

	if ($('#phone').val() == '') {
		errorMsg += '<small>Please fill in your phone number</small><br>';
		$('#phone').addClass('form-error');
	}
	else if (!$.isNumeric($('#phone').val())) {
		errorMsg += '<small>Your phone number is not numeric</small><br>';
		$('#phone').addClass('form-error');
	}

	if ($('#email').val() == '') {
		errorMsg += '<small>Please fill in your email address</small><br>';
		$('#email').addClass('form-error');
	}
	else if(!isEmail($('#email').val())) {
		errorMsg += '<small>Your email is not valid</small><br>';
		$('#email').addClass('form-error');
	}

	if ($('#password').val() == '') {
		errorMsg += '<small>Please input a password</small><br>';
		$('#password').addClass('form-error');
	}

	if ($('#confirmpassword').val() == '') {
		errorMsg += '<small>Please confirm your password</small><br>';
		$('#confirmpassword').addClass('form-error');
	}

	if ($('#password').val() !== $('#confirmpassword').val()) {
		errorMsg += '<small>Your passwords don\'t match</small><br>';
		$('#password').addClass('form-error');
		$('#confirmpassword').addClass('form-error');
	}


	if (errorMsg != '') {
		$('#status').html(errorMsg).addClass('alert alert-danger text-muted');
		return false;
	}
	else {
		return true;
	}

});
