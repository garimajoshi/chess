$(document).ready(function() {

/*
 * ------------------------------ HEADER BEGIN ----------------------------------------------------
 */

  function setupLoginDialog() {
  	$('#login-button').click( function() {
  		var dialogdiv = $('#login-dialog');
  		if (dialogdiv.css('display') == 'none') {
  			dialogdiv.show();
  			$('#loginwrapper').show();
  			setTimeout(function() {
  				dialogdiv.css('top', '70px');
  			}, 20);
  		}
  	});
  	$('#register-button').click( function() {
  		var dialogdiv = $('#register-dialog');
  		if (dialogdiv.css('display') == 'none') {
  			dialogdiv.show();
  			$('#loginwrapper').show();
  			setTimeout(function() {
  				dialogdiv.css('top', '70px');
  			}, 20);
  		}
  	});
  	$('#loginwrapper').click( function() {
  		var dialogdiv = $('#login-dialog');
  		if (dialogdiv.css('display') == 'block') {
  			dialogdiv.css('top', '-300px');
  			setTimeout(function() {
  				dialogdiv.hide();
  				$('#loginwrapper').hide();
  			}, 300);
  		}
  		var dialogdiv1 = $('#register-dialog');
  		if (dialogdiv1.css('display') == 'block') {
  			dialogdiv1.css('top', '-600px');
  			setTimeout(function() {
  				dialogdiv1.hide();
  				$('#loginwrapper').hide();
  			}, 300);
  		}
  	});	
  }

  function setupRegistrationValidate() {

    $('#username').keyup( function() {
    $(this).removeClass('validationerror'); 
    });
    $('#email').keyup( function() {
    	$(this).removeClass('validationerror'); 
    });
    $('#password').keyup( function() {
    	$(this).removeClass('validationerror'); 
    });
    $('#confirmpassword').keyup( function() {
    	$(this).removeClass('validationerror'); 
    });

  	$('#registerForm').submit( function () {
  		var toReturn = true;
  		if ($('#password').val() != $('#confirmpassword').val()) {
  			toReturn = false;
  			$('#confirmpassword').addClass('validationerror');
  		}
  		var email = $('#email').val();
  		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) == false) {
  			toReturn = false;
  			$('#email').addClass('validationerror');
  		}
  		if ($('#username').val() == '') {
  			toReturn = false;
  			$('#username').addClass('validationerror');
  		}
  		if ($('#password').val() == '') {
  			toReturn = false;
  			$('#password').addClass('validationerror');
  		}
  		return toReturn;
  	});
  }
  
  function setupLoginValidate() {

    $('#lemail').keyup( function() {
     $(this).removeClass('validationerror');
    });
    $('#lpassword').keyup( function() {
     $(this).removeClass('validationerror');
    });

   $('#loginForm').submit( function () {
   var toReturn = true;
   var email = $('#lemail').val();
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) == false) {
   toReturn = false;
   $('#lemail').addClass('validationerror');
   }
   if ($('#lpassword').val() == '') {
   toReturn = false;
   $('#lpassword').addClass('validationerror');
   }
   return toReturn;
   });
  }
  
  setupLoginDialog();
  setupRegistrationValidate();
  setupLoginValidate();

/*
 * ------------------------------ HEADER ENDS ----------------------------------------------------
 */

/* 
 * ------------------------------ WRAPPER BEGIN ---------------------------------------------------
 * Contains scripts for the 'wrapper' section
 */

	var fetchedContentData;

	$.getJSON('scripts/content.json', function(data) {
		fetchedContentData = data;
	});

/* ------------------------------ WRAPPER END --------------------------------------------------- */

/* 
 * ------------------------------ FOOTER BEGIN ---------------------------------------------------
 * Contains scripts for the 'footer' section
 */	

	/* Responsible for removing default content from form field on focus
	 * and restoring default content in case focus is lifted and no data
	 * has been entered
	 */
	$('input.clear').each(function(index) {
		$(this)
		.data('default', $(this).val())
		.addClass('inactive')
		.focus(function(){
			$(this).removeClass('inactive');
			if( $(this).val() === $(this).data('default') || $(this).val() === "" ) {
				$(this).val("");
			}
		})
		.blur(function() {
			if( $(this).val() === "" ) {
				$(this).addClass('inactive').val( $(this).data('default') );
			}	
		});
	});
});
