$(document).ready(function(){

	// **********************Search Form Validation**********************
	$('#search-form').submit(function () {

		if ($("input[type='search']").val() == '') {
			$("input[type='search']").addClass('form-error');
			alert('Please enter name of movie');
			return false;
		} else {
			return true;
		}

	});

});



