#Changelog

###[unreleased]
####TODO
* Fix the email validation message
* Fix all validation messages to show up on mobile

####Added
* Enabled Gzip in the .htaccess to compress file sizes. [Gift of Speed: enable Gzip](https://www.giftofspeed.com/enable-gzip-compression/)

####Changed
* Created a new changelog file and migrated original from the README.
* Changed the file structure to better separate the source files from the distribution files.
* Changed the formatting of the changelog to better reflect best practices.
* Lowered the required characters for password creation

####Deprecated
####Removed
####Fixed
* When the user closes a form before submission, it will reset the visual validation indicators.
* When the user leaves the email field blank, it will alert the user visually.
* If the user does not put in a valid email address, it will alert the user visually.

####Security

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