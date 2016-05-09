$(document).ready(function(){
  // Add new user, edit user, edit user password
  $('#btn-add-user, #btn-edit-user, #btn-edit-password').on('click', function(){
    var modal = $(this).attr('data-target');
    toggleModal(modal);
  });

  // Keep form open
  $('#btn-keep-open').on('click', function(){
    toggleKeepModalOpen(this);
  });

  // Submit new user form
  $('#form-new-user').on('submit', function(e){
    e.preventDefault();
    var url = $(this).attr('action'),
        data = $(this).serialize(),
        dataParsed = $(this).serializeArray();

    $.post(url, data, function(){
      // Empty
    }).success(function(e){
      // Count the rows.
      var rowCount = getRowCount('#users-container'),
      // Count the items in the last row
          itemCount = getItemCount('#group-' + rowCount);
      if(itemCount == 3){
        // Create new row
        rowCount += 1;
        addUserRow('#users-container', 'group-' + rowCount);
      }
      // Append to last row
      copyAndAppend('#user-sample', e, '#group-' + rowCount, dataParsed);
      if(keepModalOpen('#btn-keep-open')){
        toggleModal('modal-user'); //Close Modal
      }
      // Clear form
      resetForm($('#form-new-user'));
    }).fail(function(){
      // Create fail doodad
    });
  });

  // Update Password
  // Submit new user form
  $('#form-edit-password').on('submit', function(e){
    e.preventDefault();
    updatePassword($(this));
  });

  $('#form-edit-user').on('submit', function(e){
    e.preventDefault();
    updateUser($(this));
  });

  $('#btn-test').on('click', function(){
    var test = $(this).parents('div').find('.modal-tarp');
    test.fadeIn('fast');
    setTimeout(function(){
      test.fadeOut("fast");
    }, 1000);
  });

  //TODO Sort users based on various criterium
});

var copyAndAppend = function(sample, newId, appendTo, dataParsed)
{
  var newUser = $(sample).clone().prop('id', 'user-id-' + newId),
      firstName = dataParsed[0]['value'],
      lastName = dataParsed[1]['value'],
      username = dataParsed[5]['value'];

  newUser.find('#sample-firstName').text(firstName);
  newUser.find('#sample-lastName').text(lastName);
  newUser.find('#sample-username').text(username);
  var userLink = newUser.find('#sample-link');
      userLinkHref = userLink.attr('href');
      userLinkUpdate = userLink.attr('href', userLinkHref + newId);

  $(newUser).appendTo(appendTo);
}

var addUserRow = function(container, groupId){
  $(container).append('<div class="row user-row" id="' + groupId + '"></div>');
}
