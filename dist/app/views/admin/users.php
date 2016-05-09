<div class="row" id="breadcrumbs-row">
  <div class="container">
    <ul class="ul-inline" id="breadcrumbs">
      <li><a href="<?=URL;?>admin">Admin</a></li>
      <li><i class="material-icons">keyboard_arrow_right</i></li>
      <li>Users</li>
    </ul>
  </div>
</div>
<div class="container" id="users-submenu">
  <div class="row" id="page-title-container">
    <div class="col-6-12">
      <h2>Manage Users</h2>
    </div>
    <div class="col-6-12">
      <button type="button" class="float-right" id="btn-add-user" data-target="modal-user">Add User</button>
    </div>
  </div>
</div>
<div class="container" id="users-container">
<?php
  $count = 0;
  $groupId = 1;
  foreach($this->usersList as $user){
    $startRow = ($count == 0 ? true : false);
    $endRow = ($count == 2 ? true : false);
    if ($startRow) {
      print '
  <div class="row user-row" id="group-' . $groupId . '">';
    }
    print '
    <div class="col-4-12 user-box" id="user-id-' . $user['id'] . '">
      <a href="' . URL . 'admin/users/' . $user['id'] . '">
        <div class="row user-real-name">
          <span>' . $user['firstName'] . ' ' . $user['lastName'] . '</span>
        </div>
        <div class="row user-details">
          ' . $user['username']  . '
        </div>
      </a>
    </div>
    ';
    $count++;
    if ($endRow) {
      print '
  </div>
      ';
      $count = 0;
      $groupId++;
    }

  }
?>

  </div>
</div>

<!-- Sample user card -->
<div class="col-4-12 user-box" id="user-sample">
  <a href="users/" id="sample-link">
    <div class="row user-real-name">
      <span id="sample-firstName">Gerard</span> <span id="sample-lastName">Butler</span>
    </div>
    <div class="row user-details" id="sample-username">
      gdiddy
    </div>
  </a>
</div>

<!-- Modal used to add a new user -->
<div class="" id="modal-user">
  <form action="<?=URL;?>admin/addUser" method="post" id="form-new-user">
    <div class="" id="modal-header">
      <span id="modal-title">Add a new user</span>
      <span id="modal-close"><button type="button" id="btn-modal-close" data-modal="modal-user"><i class="material-icons">close</i></button></span>
    </div>
    <div class="row" id="modal-content">
      <div class="row">
        <div class="col-6-12">
          <label> First Name
          <input type="text" name="firstName" value="" placeholder="Bruce" />
          </label>
        </div>
        <div class="col-6-12">
          <label> Last Name
            <input type="text" name="lastName" value="" placeholder="Willis" />
          </label>
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="col-6-12">
            <label> Email
            <input type="email" name="email" value="" placeholder="email@email.com" />
            </label>
          </div>
          <div class="col-6-12">
            <label> Phone Number
              <input type="phone" name="phone" value="" placeholder="###-###-####" />
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col-6-12">
            <label> User Role
              <select name="role">
              <?php
              foreach($this->roleList as $role){
                print '<option value="' . $role['id'] . '">' . $role['name'] . '</option>
                ';
              }

              ?>
              </select>
            </label>
          </div>
          <div class="col-6-12">
            <label> Username
              <input type="text" name="username" value="" placeholder="bwillis" required />
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col-6-12">
            <label> Password
              <input type="password" name="password" value="" placeholder="bwillis" required />
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="" id="modal-footer">
      <span id="modal-keep-open"><button type="button" id="btn-keep-open" data-keepOpen="no"><i class="material-icons" id="keep-open-box">check_box_outline_blank</i> <span>Keep Open</span></button></span>
      <span id="modal-save"><button type="submit" id="btn-modal-save">Save</button></span>
      <span id="modal-cancel"><button type="button" id="btn-modal-cancel" data-modal="modal-user">Cancel</buttton></span>
    </div>
  </form>
</div>

<div class="modal-overlay" id="modal-overlay" data-modal="modal-user"></div>
