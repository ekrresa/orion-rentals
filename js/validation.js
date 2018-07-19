function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}


$('#contact').submit(function () {

	var errorMsg = '';

	if ($('#name').val() == '') {
		errorMsg += '<small>Please fill in your name</small><br>';
	}

	if ($('#email').val() == '') {
		errorMsg += '<small>Please fill in your email address</small><br>';
	}
	else if(!isEmail($('#email').val())) {
		errorMsg += '<small>Your email is not valid</small><br>';
	}

	if ($('#subject').val() == '') {
		errorMsg += '<small>The subject field is required</small><br>';
	}

	if ($('#content').val() == '') {
		errorMsg += '<small>The content field is required</small>';
	}



	// if (!$.isNumeric($('#phone').val())) {
	// 	errorMsg += '<p>Your phone number is not numeric</p>'
	// }
	if (errorMsg != '') {
		$('#status').html(errorMsg).addClass('alert alert-danger text-muted');
		return false;
	}
	else {
		return true;
	}


})
