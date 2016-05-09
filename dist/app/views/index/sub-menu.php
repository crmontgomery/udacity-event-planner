    <div class="row" id="sub-menu-wrapper">
        <div class="container" id="sub-menu">
            <?php print '<span id="page-title">' . (empty($this->eventsList) ? '' : 'Upcoming Events') . '</span>';?>
            
            <?php
            if(Session::get('loggedIn')){
                print '
            <button type="button" id="btn-create-event" data-target="modal-event">
                <i class="material-icons">add</i> <span>Create an Event</span>
            </button> 
                ';
                }?>
                
        </div>
    </div>