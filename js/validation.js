$(document).ready(function(){

	// show search button on focus
	$("input[type='search']").focus(function(){
	    $("#search-btn").show(1000);
	});
	// hide search button on focus
	$("input[type='search']").focusout(function(){
	    $("#search-btn").hide(1000);
	    $("input[type='search']").removeClass('form-error');
	});


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



