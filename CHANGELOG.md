#Changelog

###[unreleased]
####TODO
* Implement HTML minify-zation
* Create a better glp workflow to separate development and build.

###2016/05/30 [3.0.0-Alpha]
####Added
* Enabled Gzip in the .htaccess to compress file sizes. [Gift of Speed: enable Gzip](https://www.giftofspeed.com/enable-gzip-compression/)

####Changed
* Created a new changelog file and migrated the original from the README.
* Changed the file structure to better separate the source files from the distribution files.
* Changed the formatting of the changelog to better reflect best practices.
* Lowered the required characters for password creation.
* Updated the MVC routing system for security and better error handling.
* Updated the readme to reflect all installation changes, and added better descriptions.
* Added a popup error message to notify the user when creating an account and adding an event.
* Changed the event type to a datalist from a basic input. 
* Updated the database to store different event types for a user to select from or add their own.

####Fixed
* When the user closes a form before submission, it will reset the visual validation indicators.
* When the user leaves the email field blank, it will alert the user visually.
* If the user does not put in a valid email address, it will not pass validation.
* Fix the email validation message staying green when field is erased.

####Security
* Began implementing basic security measures to stop users from accessing controller methods that are meant for ajax/work.
* Began implementing page settings defined by the administrator for users and their access levels.

###2016/05/15 2.0.1-Alpha
* Fixed issue with modals not scrolling if the height of the page was smaller than the modal itself if width media queries were not triggered.
* Updated live site to handle the inclusion or omission of "www."

###2016/05/12 2.0.0-Alpha
* Began changes in moving JavaScript files out of the view and into the development area
* Added [gulp-uglify.js](https://www.npmjs.com/package/gulp-uglify) to minify JavaScript files.
* Changed the Gulp file to minify all Sass on export to css.
* Converted all relevent files to the proper spacing and indentation
* Changed the way events are added. The page is now refreshed instead of added dynamically.

###2016/05/09 1.0.2-Alpha
* Added installation instructions.
* Changed url config setup.

###2016/05/08 1.0.1-Alpha
* Fixed issues with .htaccess file when deploying on a server.
* FIxed an error associated with strict validation and PHP during login