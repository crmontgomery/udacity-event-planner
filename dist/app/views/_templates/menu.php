<?php Session::init(); ?>

    <div class="row" id="header">
        <div class="container">
            <ul class="ul-inline" id="main-menu">
                <li><a href="<?=URL;?>">EP9k</a></li>
            </ul>
            <ul class="ul-inline float-right text-right" id="user-menu">
            <?php
            if (Session::get('loggedIn') == true) {
            print '
                <li>' . Session::get('username') . '</li>
                <li class="dotted"><a href="' . URL . 'dashboard/logout">logout</a></li>
            ';
            } else {
            print '
                <li><button type="button" id="btn-sign-up" data-target="modal-sign-up">Sign Up</button></li>
                <li><button type="button" id="btn-login" data-target="modal-login">Login</button></li>
            ';
            }?>
            
            </ul>
        </div>
    </div><!-- /header -->
