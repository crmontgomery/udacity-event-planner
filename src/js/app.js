$(document).ready(function() {
    //Empty
});

// Standard POST operation
var ajaxPost = function(url, data, funct) {
    $.post(url, data, funct)
    .done(function(e){
    }).fail(function(error) {
        // TODO: Create an alert popup
    });
}

// Toggle the disabled property of a button
var toggleDisabledButton = function(button)
{
    if($(button).is(':disabled')) {
        enableButton(button);
    } else {
        disableButton(button);
    }
} 

// Enable a button
var enableButton = function(button)
{
	$(button).prop('disabled', false);
}

// Disable a button
var disableButton = function(button)
{
	$(button).prop('disabled', true);
}

// Triggers an alert
var alertPop = function()
{
	$('.alert').addClass('pop');
}

// Used to reset a specific form
var resetForm = function(formName)
{
	$(formName)[0].reset();
}

// Gets the value of an input
var getInputVal= function(name)
{
	return $("input[name='" + name + "']").val();
}

// Set the value of an input
var setInputVal = function(name, val)
{
	$("input[name='" + name + "']").val(val);
}

// Gets the row count of a container
var getRowCount = function(container)
{
  var count = $(container).children().length;
  return count;
}

// Gets the item count of a row
var getItemCount = function(row)
{
  var count = $(row).children().length;
  return count;
}

// General Modal Settings
var toggleModal = function(modal) {
    var firstInput = '#' + $('#' + modal + ' form input').first().attr('id'),
        form       = '#' + $('#' + modal + ' form').attr('id')
        
    // Will be used when a better color scheme is worked out
    // if(modal == 'modal-event'  && !$('#modal-overlay').hasClass('event-overlay')){
    //     $('#modal-overlay').addClass('event-overlay');
    // }else if($('#modal-overlay').hasClass('event-overlay')) {
    //     $('#modal-overlay').addClass('event-overlay');
    // }

    if($('#' + modal).is(':visible')) {
        $('#' + modal).fadeOut('fast'); // Close the modal
        // Verify keep open exists
        if(!keepModalOpen()){
            toggleKeepModalOpen('#keep-open-box');
        }
        // Reset the form on close
        resetForm(form);
        $('#body').css('overflow', 'initial'); // Resets the body
        $('#modal-overlay').fadeOut('slow'); 
        $('#' + modal).find('#error-message span').fadeOut();
    } else {
        $('#modal-overlay').fadeIn('fast'); 
        $('#' + modal).fadeIn('slow'); // Open the modal
        // http://stackoverflow.com/questions/15859113/focus-not-working
        $(firstInput).get(0).focus(); // Always put the autofocus on the first input of the form
        $('#body').css('overflow', 'hidden'); // Stops the body height from affecting modal scrollbar
    }
    $('#modal-overlay').attr('data-modal', modal);
}

// Modal close options
$('#btn-modal-close, #btn-modal-cancel, #modal-overlay').on('click', function(){
    var modal = $(this).attr('data-modal');
    $('#' + modal + ' #label-validation span').each(function(){
        if($(this).hasClass('pass')){
            $(this).removeClass('pass');
            $(this).addClass('fail');
        }
    });
    toggleModal(modal);
});

// Button that lets the user keep the form open
var toggleKeepModalOpen = function(btn)
{
    toggleOpenIcon(btn);
    function toggleOpenIcon(btn)
    {
        if($('#keep-open-box').text() == 'check_box_outline_blank' ) {
            $(btn).attr('data-keepOpen', 'yes');
            $('#keep-open-box').text('check_box');
        } else {
            $(btn).attr('data-keepOpen', 'no');
            $('#keep-open-box').text('check_box_outline_blank');
        }
    }
}

var keepModalOpen = function(btn)
{
    if($('#keep-open-box').text() == 'check_box_outline_blank' ) {
        return true;
    } else {
        return false;
    }
}

//Edit success
var editSuccess = function(form, modal)
{
    var test = $(form).parents('div').find('.modal-tarp');
    test.fadeIn('fast');
    resetForm($(form));
    
    setTimeout(function(){
    toggleModal(modal);
    }, 1000);
    setTimeout(function(){
    test.fadeOut('slow');
    }, 1000);
}

// Update Password
var updatePassword = function(form)
{
  var url  = $(form).attr('action'),
      data = $(form).serialize();

    $.post(url, data, function(){
        // Empty
    }).success(function(e){
        //Prompt user
        editSuccess(form, 'modal-edit-password');
    }).fail(function(){
        // Create fail doodad
    });
}

// Update User
var editUser = function(form)
{
    var url  = $(form).attr('action'),
        data = $(form).serialize();

    $.post(url, data, function(){
        // Empty
    }).success(function(e){
        //Prompt user
        resetForm($(form));
        toggleModal('modal-edit-user');
    }).fail(function(){
        // Create fail doodad
    });
}

var togglePass = function(item, valid){
    if(!valid) {
        $(item).removeClass('pass');
        $(item).addClass('fail');
    } else {
        $(item).removeClass('fail');
        $(item).addClass('pass');
    }
}





