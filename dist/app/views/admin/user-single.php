<div class="row" id="breadcrumbs-row">
  <div class="container">
    <ul class="ul-inline" id="breadcrumbs">
      <li><a href="<?=URL;?>admin">Admin</a></li>
      <li><i class="material-icons">keyboard_arrow_right</i></li>
      <li>Users</li>
      <li><i class="material-icons">keyboard_arrow_right</i></li>
      <li>Single</li>
    </ul>
  </div>
</div>
<div class="container" id="users-submenu">
  <div class="row" id="page-title-container">
    <div class="col-6-12">
      <h2><span id="first-name"><?=$this->user[0]['firstName'];?></span> <span id="last-name"><?=$this->user[0]['lastName'];?></span></h2>
    </div>
    <div class="col-6-12">
      <button type="button" class="float-right" id="btn-edit-user" data-target="modal-user">Edit User</button>
      <button type="button" class="float-right" id="btn-edit-password" data-target="modal-edit-password">Change Password</button>
    </div>
  </div>
</div>
<div class="container" id="users-container">
  <div class="row" id="user-details">
    <div class="col-3-12" id="username-wrapper">
      <div class="">Username</div>
      <div class=""><?=$this->user[0]['username'];?></div>
    </div>
    <div class="col-3-12" id="email-wrapper">
      <div class="">Email</div>
      <div class=""><?=$this->user[0]['email'];?></div>
    </div>
    <div class="col-3-12" id="phone-wrapper">
      <div class="">Phone</div>
      <div class=""><?=$this->user[0]['phone'];?></div>
    </div>
    <div class="col-3-12" id="role-wrapper">
      <div class="">Role</div>
      <div class=""><?=$this->user[0]['role'];?></div>
    </div>
  </div>
</div>
<?php
  $modal = 'modal-user';
?>
<!-- Modal used to add a new user -->
<div class="" id="<?=$modal;?>">
  <form action="<?=URL;?>admin/editUser" method="post" id="form-edit-user">
    <div class="" id="modal-header">
      <span id="modal-title">Edit User Information</span>
      <span id="modal-close"><button type="button" id="btn-modal-close" data-modal="<?=$modal;?>"><i class="material-icons">close</i></button></span>
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
      <span id="modal-cancel"><button type="button" id="btn-modal-cancel" data-modal="<?=$modal;?>">Cancel</buttton></span>
    </div>
  </form>
  <div class="modal-tarp">Content</div>
</div>

<!-- Modal used to add a new user -->
<?php
  $modal = 'modal-edit-password';
?>
<div class="" id="<?=$modal;?>">
  <form action="<?=URL;?>admin/updatePassword" method="post" id="form-edit-password">
    <div class="" id="modal-header">
      <span id="modal-title">Change Users Password</span>
      <span id="modal-close"><button type="button" id="btn-modal-close" data-modal="<?=$modal;?>"><i class="material-icons">close</i></button></span>
    </div>
    <div class="row" id="modal-content">
      <div class="row">
        <div class="col-6-12">
          <label> Original Password
          <input type="password" name="oldPassword" value="" placeholder="password" />
          </label>
        </div>
        <div class="col-6-12">
          <label> New Password
            <input type="password" name="password" value="" placeholder="password" />
          </label>
        </div>
      </div>
    </div>
    <div class="" id="modal-footer">

      <span id="modal-save"><button type="submit" id="btn-modal-save">Save</button></span>
      <span id="modal-cancel"><button type="button" id="btn-modal-cancel" data-modal="<?=$modal;?>">Cancel</buttton></span>
    </div>
  </form>
  <div class="modal-tarp">Password Update Sucessful</div>
</div>


<div class="" id="modal-overlay" data-modal="default"></div>
