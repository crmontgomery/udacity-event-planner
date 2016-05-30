
$(document).ready(function(){    
    // Launch modals
    $('#btn-create-event, #btn-sign-up, #btn-login').on('click', function(){
        var modal = $(this).attr('data-target');
        toggleModal(modal);
    });

    // Keep form open (disabled for this app)
    $('#btn-keep-open').on('click', function(){
        toggleKeepModalOpen(this);
    });
    
    //TODO: Condense and use classes
    
    /* **************
       NEW EVENT FORM
       ************** */
    // Validation
    var eventValid = {name:     false, 
                      location: false,
                      type:     false,
                      host:     false,
                      start:    false,
                      end:      false,
                      guests:   false
                     };
                     
    // Check all inputs to ensure they are not empty
    var eventInputList = {name:     'ip-name',
                          location: 'ip-location', 
                          type:     'ip-type',
                          host:     'ip-host',
                          start:    'ip-start',
                          end:      'ip-end',
                          guests:   'ip-guest'
                         };
    
    //TODO: combine with allTrue
    var notEmpty = function(obj){
        for(var o in obj) {
            if($('#' + obj[o]).val() && obj[o] != 'ip-end'){
                eventValid[o] = true;
                toggleRequired('#' + obj[o], true);
            } else if(obj[o] != 'ip-end'){
                eventValid[o] = false;
                toggleRequired('#' + obj[o], false);
            }
        }
    }
    
    $('#form-new-event').on('keyup', function(e){
        notEmpty(eventInputList);
    });
    
    // Ensure the end date is not before the start date
    $('#' + eventInputList['end']).on('blur', function(){
        if($('#' + eventInputList['end']).val() <= $('#' + eventInputList['start']).val()){
            toggleRequired('#' + eventInputList['end'], false);
            eventValid['end'] = false;
            //$('#modal-event').find('#error-message span').text('The end date is the same or earlier than the start date.').fadeIn();
            toggleAlert('The end date is the same of earlier than the start date.');
            console.log('other wtf');
        } else {
            toggleRequired('#' + eventInputList['end'], true);
            eventValid['end'] = true;
            //$('#modal-event').find('#error-message span').fadeOut();
        }
    });
    
    // Submit new event form
    $('#form-new-event').on('submit', function(e){
        e.preventDefault();
        var url  = $(this).attr('action'),
            data = $(this).serialize();
        
        if(allTrue(eventValid)) {
            $('#modal-event').find('#error-message span').fadeOut();
            var sample     = '#sample-event-wrapper',
            newId      = 1,
            appendTo   = '#event-row-1',
            dataParsed = $(this).serializeArray();
            
            $.post(url, data, function(){
                // Empty default
            }).success(function(id){
                // Append to container
                // TODO: Add this functionality back in when a better solution is made
                // copyAndAppend(sample, id, '#event-row-1', dataParsed);
                // toggleModal('modal-event'); //Close Modal
                location.reload();
            }).fail(function(fail){
                // TODO: Create fail doodad
            });
        } else {
            toggleAlert('Please ensure that all fields are correctly filled out.');
        }
        
    });
    
    /* *************
       NEW USER FORM
       ************* */
    // Validation
    
    // TODO: find better way
    var signUpValid = {email:          false, 
                       password:       false,
                       passwordLength: false,
                       passwordSymbol: false,
                       passwordNumber: false,
                       passwordLower:  false,
                       passwordUpper:  false,
                       passwordMatch:  false
                      };
    
    // Checks to see if the username is left blank
    $('#ip-user-name').on('keyup', function(){
       if($(this).val() == '') {
           toggleRequired(this,false);
       } else {
           toggleRequired(this,true);
       }
    });
    
    // Validate the email address being used
    $('#ip-user-email').on('blur', function(){
        if($(this).val() == ''){
            // Make sure it is not blank
            toggleRequired('#ip-user-email', false);
        } else if(!isValidEmailAddress($(this).val()) ){
            // Make sure it is in a valid format
            toggleRequired('#ip-user-email', false);
        } else {
            // Checks to see if the email is already being used
            $.post('index/userExists', { email: $(this).val()}, function(e){
                // put loading icon
            }).success(function(url){
                // Refreshes the page
                signUpValid['email'] = true;
                toggleRequired('#ip-user-email', true);
                
            }).fail(function(fail) {
                // failure will notify the user
                signUpValid['email'] = false;
                toggleAlert('That email already exists.');
                toggleRequired('#ip-user-email', false);
            });
        }
    });
    
    // Credit: aSeptik http://stackoverflow.com/questions/2855865/jquery-regex-validation-of-e-mail-address
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };
    
    // Make sure password conforms to the standards below
    // TODO: Clean this up, put in function maybe
    // TODO: Convert to jquery for consistent code
    var firstPasswordInput  = document.querySelector('#ip-user-pass');
    var secondPasswordInput = document.querySelector('#ip-user-pass-verify');

    var symbolVal = /[\!\@\#\$\%\^\&\*]/,
        numberVal = /[0-9]/,
        lowerVal  = /[a-z]/,
        upperVal  = /[A-Z]/,
        matchVal  = /[^A-z0-9\!\@\#\$\%\^\&\*]/;

    $('#ip-user-pass').on('keyup', function() {
        
        //TODO: Condense!
        if(firstPasswordInput.value.length < 6) {
            togglePass('#label-validation #length', false);
            signUpValid['passwordLength'] = false;
        } else {
            togglePass('#label-validation #length', true);
            signUpValid['passwordLength'] = true;
        }
    
        if (symbolVal.test(firstPasswordInput.value)) {
            togglePass('#label-validation #symbol', true);
            signUpValid['passwordSymbol'] = true;
        } else {
            togglePass('#label-validation #symbol', false);
            signUpValid['passwordSymbol'] = false;
        }
        
        if (numberVal.test(firstPasswordInput.value)) {
            togglePass('#label-validation #num', true);
            signUpValid['passwordNumber'] = true;
        } else {
            togglePass('#label-validation #num', false);
            signUpValid['passwordNumber'] = false;
        }
        
        if (lowerVal.test(firstPasswordInput.value)) {
            togglePass('#label-validation #lower', true);
            signUpValid['passwordLower'] = true;
        } else {
            togglePass('#label-validation #lower', false);
            signUpValid['passwordLower'] = false;
        }
        
        if (upperVal.test(firstPasswordInput.value)) {
            togglePass('#label-validation #cap', true);
            signUpValid['passwordUpper'] = true;
        } else {
            togglePass('#label-validation #cap', false);
            signUpValid['passwordUpper'] = false;
        }
        
        if (firstPasswordInput.value != '') {
            signUpValid['password'] = true;
        } else {
            signUpValid['password'] = false;
        }
    });
    
    // Check if passwords match
    $('#ip-user-pass-verify').on('keyup', function(){
        var first  = $(firstPasswordInput).val(),
            second = $(this).val(); 
            
        if(first == second){
            signUpValid['passwordMatch'] = true;
            toggleRequired('#ip-user-pass-verify', true);
        } else {
            signUpValid['passwordMatch'] = false;
            toggleRequired('#ip-user-pass-verify', false);
        }
    });
    
    // Checks if the passwords match when user changes focus (TODO: merge with keyup...maybe remove keyup)
    $('#ip-user-pass-verify').on('blur', function(){
        if(requiredVerify('#ip-user-pass-verify')){
            
        } else {
            toggleAlert('The passwords do not match.'); 
        }
    });
    
    // The last check to make sure everything passes validation
    // http://stackoverflow.com/questions/17117712/how-know-if-all-javascript-object-values-is-true
    var allTrue = function(obj){
        for(var o in obj) {
            if(!obj[o]) return false;
        }
        
        return true;
    }
    
    $('#form-new-user').on('keyup', function(e){
          
    });
    
    // Submit new user form
    $('#form-new-user').on('submit', function(e){
        e.preventDefault();
        var url  = $(this).attr('action'),
            data = $(this).serialize();
            
        if(allTrue(signUpValid)){
            $('#modal-sign-up').find('#error-message span').fadeOut();
            $.post(url, data, function(){
            // Empty default
            }).success(function(id){
                if(id == 0){
                    console.log('Sorry that email is already in use.');
                } else {
                    
                }
                // If successful, log the user in
                // TODO: Clean this up!
                $.post('index/login', data, function(e){
                    // put loading icon
                }).success(function(url){
                    // Refreshes the page
                    window.location = url;
                }).fail(function(fail) {
                    // failure will notify the user
                });
                
            }).fail(function(fail){
                // TODO: Create fail doodad
            });
        } else {
            toggleAlert('Please ensure all fields are correctly filled out.');
        }

    });
    
    /* **********
       LOGIN FORM
       ********** */
    // Validation
    $('#ip-login-email').on('keyup', function(){
       if($(this).val() == '') {
           toggleRequired(this, false);
       } else {
           toggleRequired(this, true);
       }
    });
    
    $('#ip-login-password').on('keyup', function(){
       if($(this).val() == '') {
           toggleRequired(this, false);
       } else {
           toggleRequired(this, true);
       }
    });
    
    // Submit login form
    $('#form-login').on('submit', function(e) {
        e.preventDefault();
        var url  = $(this).attr('action'),
            data = $(this).serialize();

        $.post(url, data, function(e){
            // put loading icon
        }).success(function(url){
            // Refreshes the page
            window.location = url;
        }).fail(function(fail) {
            // failure will notify the user
           toggleAlert();
            
        });
    });
    
    // Not being used yet
    $('#form-edit-password').on('submit', function(e){
        e.preventDefault();
        updatePassword($(this));
    });

    $('#form-edit-user').on('submit', function(e){
        e.preventDefault();
        updateUser($(this));
    });

    // TODO: remove when not needed
    $('#btn-test').on('click', function(){
        var test = $(this).parents('div').find('.modal-tarp');
        test.fadeIn('fast');
        setTimeout(function(){
            test.fadeOut("fast");
        }, 1000);
    });
    
});

// Used to copy the sample event, modify it, and add to the index
var copyAndAppend = function(sample, newId, appendTo, dataParsed)
{
    var newEvent = $(sample).clone().prop('id', 'event-wrapper-' + newId),
        name     = dataParsed[0]['value'],
        location = dataParsed[1]['value'],
        type     = dataParsed[2]['value'],
        host     = dataParsed[3]['value'],
        start    = dataParsed[4]['value'],
        end      = dataParsed[5]['value'],
        guests   = dataParsed[6]['value'],
        details  = dataParsed[7]['value'];

    newEvent.find('#sample-name').text(name);
    newEvent.find('#sample-link').text(location);
    newEvent.find('#sample-type').text(type);
    newEvent.find('#sample-host').text(host);
    newEvent.find('#sample-start').text(start);
    newEvent.find('#sample-end').text(end);
    newEvent.find('#sample-details').text(details);
    newEvent.find('#sample-guests').text(guests);
    
    var userLink       = newEvent.find('#sample-link'),
        userLinkHref   = userLink.attr('href'),
        userLinkUpdate = userLink.attr('href', userLinkHref + location);

    // If this is the first event it will hide the blank state message.
    $('#empty-events').hide();
    $(newEvent).appendTo(appendTo);
}

// TODO: FIX!
var toggleRequired = function(item, pass) 
{
    var itemValid = $(item).siblings('#label-validation').children();

    if($(itemValid).hasClass('fail') && pass) {
        itemValid.removeClass('fail');
        itemValid.addClass('pass');
    } else if($(itemValid).hasClass('pass') && !pass) {
        itemValid.removeClass('pass');
        itemValid.addClass('fail');
    }
}

var requiredVerify = function(item) 
{
    var itemValid = $(item).siblings('#label-validation').children();

    if($(itemValid).hasClass('fail') ) {
        return false;
    } else if($(itemValid).hasClass('pass')) {
        return true;
    }
}

// var toggleAlert = function(message){
//     var msg = (message != '') ? message : '',
//         alert = $('#alert-container'),
//         msgContainer = $('#alert-container .message');
        
//     if(alert.data('alert-status') == 'closed'){
//         msgContainer.text(msg);
//         alert.css({top: '0px', 'position': 'fixed'});
//         alert.data('alert-status', 'open');
//     } else {
//         alert.animate({
//             top: "-200",
//             position: 'absolute'
//         }, 500, function() {
//             // empty
//         });
//         alert.data('alert-status', 'closed'); 
//     } 
// }

var toggleAlert = function(message){
    var msg = (message != '') ? message : '',
        alert = $('#alert-container'),
        msgContainer = $('#alert-container .message');
        
    if(alert.data('alert-status') == 'closed'){
        console.log('WTF?');
        msgContainer.text(msg);
        alert.css({top: '0px', 'position': 'fixed'});
        alert.data('alert-status', 'open');
        
        alert.delay(3000).animate({
            top: "-200",
            position: 'absolute'
        }, 1000);
        alert.data('alert-status', 'closed'); 
    }
}

// TODO REVISIT AND SHAME!
// var alertArray = ['Error message 1.', 'Error message 2. At length and long.', 'Another message'];
// console.log(alertArray);

// var toggleAlert = function(message, state){
//     var msg = (message != '') ? message : '',
//         alert = $('#alert-container'),
//         msgContainer = $('#alert-container .message');
        
//     if(alert.data('alert-status') == 'closed' && state == 'open'){
//         // Append the message to the array
//         alertArray.push(msg);   
//         msgContainer.text(msg);
//         // Open the alert
//         alert.css({top: '0px', 'position': 'fixed'});
//         alert.data('alert-status', 'open');
//     } else if(alert.data('alert-status') == 'open' && state == 'open'){
//         // Append the message to the array
//         alertArray.push(msg);
//         console.log(alertArray);
        
//         var alertLen = alertArray.length,
//             currentNum = $('#alert-current'),
//             totalNum = $('#alert-total');
            
//         currentNum.text(alertLen);
//         totalNum.text(alertLen);
//         // Show newest error in the alert
//         msgContainer.text(msg);
        
//         alert.css({top: '0px', 'position': 'fixed'});
//         alert.data('alert-status', 'open');
        
//     } else if(alert.data('alert-status') == 'open' && state == 'close'){
//         // Remove the message from the array
//         // If the message is the last one
//             // Close the alert
//         // Else 
//             // Keep the alert open with the ramining message   
//     } else {
//         alert.animate({
//             top: "-200",
//             position: 'absolute'
//         }, 500, function() {
//             // empty
//         });
//         alert.data('alert-status', 'closed'); 
//     } 
// }

// $(document).ready(function(){
//     if(parseInt($('#alert-current').text()) == alertArray.length) {
//             $('#btn-alert-next').prop('disabled', true);
//             console.log('last');    
//         } else if(parseInt($('#alert-current').text()) == 1) {
//             console.log('first')
//             $('#btn-alert-prev').prop('disabled', true);
//         } else {
//             $('#btn-alert-prev').prop('disabled', false);
//             $('#btn-alert-next').prop('disabled', false);
//         }
    
//     $('#btn-alert-prev, #btn-alert-next').on('click', function(){
        
//         if(parseInt($('#alert-current').text()) == alertArray.length) {
//             $('#btn-alert-next').prop('disabled', true);
//             console.log('last');    
//         } else if(parseInt($('#alert-current').text()) == 1) {
//             console.log('first')
//             $('#btn-alert-prev').prop('disabled', true);
//         } else {
//             $('#btn-alert-prev').prop('disabled', false);
//             $('#btn-alert-next').prop('disabled', false);
//         }
        
//         var current = parseInt($('#alert-current').text()),
//             msgContainer = $('#alert-container .message'),
//             arrow = $(this).attr('data-alert-arrow');
        
//         if(arrow == 'next'){
            
//         } else if(arrow == 'prev' && current != 1){
//             $('#alert-current').text(current - 1);
//             msgContainer.text(alertArray[alertArray.length - 2]);
//         }
//     });
// })

// var changeMsg = function(){
    
// }



