$(document).ready(function(){
    // Create an event, create a new user, and login
    $('#btn-create-event, #btn-sign-up, #btn-login').on('click', function(){
        var modal = $(this).attr('data-target');
        toggleModal(modal);
    });

    // Keep form open
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
            $('#modal-event').find('#error-message span').text('The end date is the same or earlier than the start date.').fadeIn();
        } else {
            toggleRequired('#' + eventInputList['end'], true);
            eventValid['end'] = true;
            $('#modal-event').find('#error-message span').fadeOut();
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
            
            //toggleModal('modal-event');

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
            $('#modal-event').find('#error-message span').text('Please ensure that all fields are correctly filled out.').fadeIn();
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
    
    // Checks to see if the email is already being used
    $('#ip-user-email').on('blur', function(){
        $.post('index/userExists', { email: $(this).val()}, function(e){
            // put loading icon
        }).success(function(url){
            // Refreshes the page
            signUpValid['email'] = true;
            toggleRequired('#ip-user-email', true);
            $('#modal-sign-up').find('#error-message span').fadeOut();
        }).fail(function(fail) {
            // failure will notify the user
            signUpValid['email'] = false;
            $('#modal-sign-up').find('#error-message span').text('That email already exists.').fadeIn();
            toggleRequired('#ip-user-email', false);
        });
    });
    
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
        if(firstPasswordInput.value.length < 16) {
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
            $('#modal-sign-up').find('#error-message span').fadeOut();
        } else {
            $('#modal-sign-up').find('#error-message span').text('The passwords do not match.').fadeIn();
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
            $('#modal-sign-up').find('#error-message span').text('Please ensure all fields are correctly filled out.').fadeIn();
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
            $('#modal-login').find('#error-message span').fadeIn();
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
