    
    <div class="container" id="body">
        <!-- displayed if there are currently no events in the database -->
        <?php
        if(empty($this->eventsList)) {
            print '<div class="row" id="empty-events">';
                
                if(Session::get('loggedIn')){
                    print '<h3 class="text-center">Uh oh! Looks like there are not any upcoming events. <br /><br /> Go ahead and be the first to create one!</h3>';
                } else {
                    print '<h3 class="text-center">Uh oh! Looks like there are not any upcoming events. <br /><br /> Sign up to be the first to create one!</h3>';
                }
                
            print '</div>';
        }
        
        ?>
        <div class="row" id="debug">
        </div>
        <div class="row" id="event-row-1">
            <div class="temp-break-big"></div>
            <div class="temp-break-small"></div>
        <?php
        if(!empty($this->eventsList)) {
            $count1 = 0;
            $count2 = 1;
            $countWide = 0;
            $countSmall = 0;
            $drop ='';
            $drop2 = '';
            
            foreach($this->eventsList as $event) {
                if($count1 % 2) {
                    $drop = 'grid-clear-right-sm';
                } else {
                    $drop = '';
                }
                
                if($count2 == 3) {
                    $drop2 = 'grid-clear-right-lg';
                    $count2 = 0;
                } else {
                    $drop2 = '';
                }
                
                print'
                <div class="col-4-12 '. $drop . ' ' . $drop2 .  '" id="event-wrapper-' . $event['id']  . '">
                    <div class="row event-head">
                        <div class="col-12-12 event-name">
                            ' . $event['name'] . '
                        </div>
                        <div class="col-12-12 event-meta">
                            <div class="event-type-host">
                                <span class="event-type">A ' . $event['eventType'] . ',</span> <span>Hosted by</span> <span class="event-host">' . $event['host'] . '</span>
                            </div>
                            <div class="event-location"><span><a href="http://maps.google.com/?q=' . $event['location'] . '" target="_blank">' . $event['location'] . '</a></span></div>
                        </div>
                    </div>
                    <div class="row event-times" id="event-times">
                        <div class="col-6-12 reset">
                            <div class="event-label">Starting</div>
                            <div>' . date_format(date_create($event['startDateTime']), 'm.d.y') . ' ' . date_format(date_create($event['startDateTime']), 'g:i A') .  '</div>
                        </div>
                        <div class="col-6-12 reset">
                            <div class="event-label">Ending</div>
                            <div>' . date_format(date_create($event['endDateTime']), 'm.d.y') . ' ' . date_format(date_create($event['endDateTime']), 'g:i A') .  '</div>
                        </div>
                    </div>
                    <div class="col-12-12 event-details" id="event-details">
                        <div class="event-label">Event Details</div>
                        <div>' . $event['message'] . '</div>
                    </div>
                    <div class="col-12-12 event-guests" id="event-guests">
                        <div class="event-label">Invited Guests</div>
                        <div>' . $event['guests'] . '</div>
                    </div>
                </div>  <!-- /event ' . $event['id'] . '-->';
                
                $countWide++;
                $count1++;
                $count2++;
                
                if($countWide == 3) {
                    print '
                    <div class="temp-break-big"></div><!-- /after 3-->'
                    ;
                    $countWide = 0;
                }
                
                $countSmall++;
                if($countSmall == 2) {
                    print '
                    <div class="temp-break-small"></div> <!-- /after 2 -->
                    ';
                    $countSmall = 0;
                }
            }
        }
        ?>   
        </div> <!-- /event row 1-->
    </div><!-- /container -->

    <!-- Using JavaScript this sample event will be the template for all events on the page 
        The sample is copied over, and the information is replaced by the users.
    //-->
    <div class="col-4-12" id="sample-event-wrapper">
        <div class="row event-head">
            <div class="col-12-12 event-name" id="sample-name">
                Star Wars Celebration
            </div>
            <div class="col-12-12 event-meta">
                <div class="event-type-host">
                    <span class="event-type" id="sample-type">A Convention,</span> <span>Hosted by</span> <span class="event-host" id="sample-host">Paul Rudd</span>
                </div>
                <div class="event-location"><span><a href="http://maps.google.com/?q=" id="sample-link" target="_blank">Orlando, FL, United States</a></span></div>
            </div>
        </div>
        <div class="row event-times" id="event-times">
            <div class="col-6-12 reset">
                <div class="event-label">Starting</div>
                <div id="sample-start">07.15.16 12:00a</div>
            </div>
            <div class="col-6-12 reset">
                <div class="event-label">Ending</div>
                <div id="sample-end">07.17.16 12:00a</div>
            </div>
        </div>
        <div class="col-12-12 event-details" id="event-details">
            <div class="event-label">Event Details</div>
            <div id="sample-details">Celebration - Lucasfilm's love letter to fans - is three fun-filled days of costumes, exhibits, a vibrant, interactive show floor, screenings, exclusive merchandise, celebrity guests, panels, autograph sessions, fan-inspired activities, and other surprises celebrating all things Star Wars! </div>
        </div>
        <div class="col-12-12 event-guests" id="event-guests">
            <div class="event-label">Invited Guests</div>
            <div id="sample-guests">Mark, Carrie, Harrison, Warwick, Alec, Anthony, Peter, David </div>
        </div>
    </div> <!-- /sample-event -->

    <!-- Modal used to add a new event -->
    <!-- TODO: only print this code if the user is loged in -->
    <?php $modalName = 'modal-event';?>
    <div id="<?=$modalName;?>">
        <form action="<?=URL;?>index/createEvent" method="post" id="form-new-event">
            <div class="" id="modal-header">
                <span id="modal-title">Create a new event</span>
                <span id="modal-close"><button type="button" id="btn-modal-close" data-modal="<?=$modalName;?>"><i class="material-icons">close</i></button></span>
            </div>
            <div class="row" id="modal-content">
                <div class="row">
                    <div id="error-message"><span></span>&nbsp;</div>
                </div>
                <div class="col-12-12">
                    <label>
                        <span>Event Name</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail">!</span>
                        </span>
                        <input type="text" name="name" id="ip-name" placeholder="What is the name of the event?" required />
                    </label>

                </div>
                <div class="col-12-12">
                    <label>
                        <span>Location</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail">!</span>
                        </span>
                        <input type="text" name="location" id="ip-location" placeholder="Where will the event take place?" required />
                    </label>
                </div>
                <div class="row">
                    <div class="col-6-12 reset">
                        <label>
                            <span>Event Type</span>
                            <span class="float-right" id="label-validation">
                                <span class="fail">!</span>
                            </span>
                            <input type="text" name="type" id="ip-type" placeholder="What type of event is this?" required />
                        </label>
                    </div>
                    <div class="col-6-12 reset">
                        <label>
                            <span>Event Host</span>
                            <span class="float-right" id="label-validation">
                                <span class="fail">!</span>
                            </span>
                            <input type="text" name="host" id="ip-host" placeholder="Who will be hosting?" requried />
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6-12 reset">
                        <label>
                            <span>Event Start Date and Time</span>
                            <span class="float-right" id="label-validation">
                                <span class="fail">!</span>
                            </span>
                            <input type="datetime-local" name="startDate" id="ip-start" required />
                        </label>

                    </div>
                    <div class="col-6-12 reset">
                        <label>
                            <span>Event End Date and Time</span>
                            <span class="float-right" id="label-validation">
                                <span class="fail">!</span>
                            </span>
                            <input type="datetime-local" name="endDate" id="ip-end"  required />
                        </label>
                    </div>
                </div>
                <div class="col-12-12">
                    <label>
                        <span>Event Guest List</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail">!</span>
                        </span>
                        <input type="text" name="guests" id="ip-guest" placeholder="Who will be attending this event?" required/>
                        <small>Please seperate guest names with a comma.</small>
                    </label>
                </div>
                <div class="col-12-12 border-bottom">
                    <label>
                        <span>Event Message</span>
                        <span class="float-right" id="label-validation">
                            <span></span>
                        </span>
                        <textarea name="message" rows="2" placeholder="Have anything to say to future visitors?"></textarea>
                    </label>
                </div>
            </div>
            <div class="" id="modal-footer">
                <span id="modal-save"><button type="submit" id="btn-modal-save">Save</button></span>
                <span id="modal-cancel"><button type="button" id="btn-modal-cancel" data-modal="<?=$modalName;?>">Cancel</buttton></span>
            </div>
        </form>
    </div>

    <!-- modal used to sign up/create a new user -->
    <!-- TODO: Only print this code if the user is not logged in -->
    <?php $modalName = 'modal-sign-up';?>
    <div id="<?=$modalName;?>">
        <form action="<?=URL;?>index/createUser" method="post" id="form-new-user">
            <div class="" id="modal-header">
                <span id="modal-title">Sign up!</span>
                <span id="modal-close"><button type="button" id="btn-modal-close" data-modal="<?=$modalName;?>"><i class="material-icons">close</i></button></span>
            </div>
            <div class="row" id="modal-content">
                <div class="row">
                    <div id="error-message"><span>Stuff</span>&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-6-12 reset">
                        <label>
                            <span class="hide-label">Name</span>
                            <span class="float-right" id="label-validation">
                                <span class="fail">!</span>
                            </span>
                            <input type="text" name="name" id="ip-user-name" placeholder="Dick Tracy" autofocus required/>
                        </label>
                    </div>
                    <div class="col-6-12 reset">
                        <label>
                            <span class="" id="label-text">Email</span>
                            <span class="float-right" id="label-validation">
                                <span class="fail">!</span>
                            </span>
                            <input type="email" name="email" id="ip-user-email" placeholder="email@email.org" required/>
                        </label>
                    </div>
                </div>
                <div class="col-12-12">
                    <label>
                        <span id="label-text">Password</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail" id="cap">A</span> 
                            <span class="fail" id="lower">a</span>
                            <span class="fail" id="num">0-9</span>
                            <span class="fail" id="symbol">!&?</span> 
                            <span class="fail" id="length">16+</span>
                        </span>
                        <input type="password" name="password" id="ip-user-pass" placeholder="Super Password" required/>
                    </label>
                </div>
                <div class="col-12-12 border-bottom">
                    <label>
                        <span class="hide-label">Verify Password</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail">!</span>
                        </span>
                        <input type="password" name="passwordVerify" id="ip-user-pass-verify" placeholder="Super Password Again" required/>
                    </label>
                </div>
                <div class="row" id="optional-information">
                    <h4>Optional Information</h4>
                    <div class="row">
                        <div class="col-6-12 reset">
                            <label>
                                <span class="hide-label">Employer</span>
                                <input type="text" name="employer" id="ip-user-employer" placeholder="Udacity" />
                            </label>
                        </div>
                        <div class="col-6-12 reset">
                            <label>
                                <span class="hide-label">Job Title</span>
                                <input type="text" name="jobTitle" id="ip-user-job-title" placeholder="Awesomenaut" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" id="modal-footer">
                <span id="modal-save"><button type="submit" id="btn-modal-save">Save</button></span>
                <span id="modal-cancel"><button type="button" id="btn-modal-cancel" data-modal="<?=$modalName;?>">Cancel</buttton></span>
            </div>
        </form>
    </div>

    <!-- modal used to login -->
    <!-- TODO: Only print this code if the user is not logged in -->
    <?php $modalName = 'modal-login';?>
    <div id="<?=$modalName;?>">
        <form action="<?=URL;?>index/login" method="post" id="form-login">
            <div class="" id="modal-header">
                <span id="modal-title">Login</span>
                <span id="modal-close"><button type="button" id="btn-modal-close" data-modal="<?=$modalName;?>"><i class="material-icons">close</i></button></span>
            </div>
            <div class="row" id="modal-content">
                <div class="row">
                    <div id="error-message"><span>Sorry, Your email or password is incorrect.</span>&nbsp;</div>
                </div>
                <div class="col-12-12 reset">
                    <label>
                        <span class="hide-label">Email</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail">!</span>
                        </span>
                        <input type="email" name="email" id="ip-login-email" placeholder="email@email.org" required/>
                    </label>
                </div>
                <div class="col-12-12 border-bottom reset">
                    <label>
                        <span class="" id="label-text">Email</span>
                        <span class="float-right" id="label-validation">
                            <span class="fail">!</span>
                        </span>
                        <input type="password" name="password" id="ip-login-password" placeholder="Password" required/>
                    </label>
                </div>
            </div>
            <div class="" id="modal-footer">
                <span id="modal-save"><button type="submit" id="btn-modal-save">Save</button></span>
                <span id="modal-cancel"><button type="button" id="btn-modal-cancel" data-modal="<?=$modalName;?>">Cancel</buttton></span>
            </div>
        </form>
    </div>

    <div class="modal-overlay-responsive" id="modal-overlay" data-modal="default"></div>