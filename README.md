# Version/Demo
2.0.0-Alpha: Live Demo: [www.coreymontgomery.com](www.coreymontgomery.com).

# Udacity: Event Planner
A basic event planner to showcase user experience.

# Objective
This is the first project for Udacity's Senior Web Developer Nanodegree. The primary objective is to evaluate user experience in relation to forms. 

# Requirements
[Nodes JS](https://nodejs.org/en/)

[Gulp JS](http://gulpjs.com/)

PHP 5 >= 5.5 (Password Hash, used to have fallback, may add back in. TODO?)

Local server or Live server: I currentlty use [AMPPS](http://www.ampps.com/). It is a little bloated, but very easy to use and setup mock domains.

# Installation
##Conifiguration Setup (Database/URL's)
1. Download or clone the git repository
2. To setup the database run the sql code from _install/install.sql file. This file will create the database and all necessary tables within it.
3. You will need to change the database login credentials in the dist/app/config.php file.
4. You will also need to change the URL constant in the dist/app/config.php file.  All url's for project resources are based off of this.

##Development
1. In windows (not sure on Mac) open the folder where the repository is found (all the files are displayed). 
    1. Select the file path at the top of the window, and erase its contents. 
    2. Type 'cmd' without quotes and hit enter.
    3. This will open a command line to the current directory. 
3. Type 'npm install' without quotes to install all dependencies (Must have NodeJs installed).
4. After the dependencies are installed, type 'gulp' without quotes (Must have GilpJs installed).
5. Gulp will now be watching the Sass files and the primary JavaScript (app.js) file. Gulp takes care of converting the Sass and combining any extra JavaScript files. For this there is only one.

##Deployment
1. Copy the 'dist' folder to the server. Localhost or online.
2. 'dist' acts as the root folder and domains should point to it.
3. If the database has already been setup and is in working order, everything is good to go.

# Some known issues

Color scheme is all over the place.

Validation messages are ugly.

Better solution to the media query/javascript hacks

Email validation shows green when empty.

If use tries to submit the form before changing focus, it will not prompt the user the email is being used.

# References/Credits
The back-end of this application is built on a modified version of Jesse Boyer's (aka JREAM), PHP-MVC. 

Several of Udacity's courses, more specifically, High Conversion Web Forms and Web Tooling and Automation.

Stack Overflow.

Google Material Guidelines (some of them)

Materializecss for the colors

#Changelog
###5/15/16 2.0.1-Alpha
* Fixed issue with modals not scrolling if the height of the page was smaller than the modal itself if width media queries were not triggered.
* Updated live site to handle the inclusion or omission of "www."

###5/12/16 2.0.0-Alpha
* Began changes in moving JavaScript files out of the view and into the development area
* Added [gulp-uglify.js](https://www.npmjs.com/package/gulp-uglify) to minify JavaScript files.
* Changed the Gulp file to minify all Sass on export to css.
* Converted all relevent files to the proper spacing and indentation
* Changed the way events are added. The page is now refreshed instead of added dynamically.

###5/9/16 1.0.2-Alpha
* Added installation instructions.
* Changed url config setup.

###5/8/16 1.0.1-Alpha
* Fixed issues with .htaccess file when deploying on a server.
* FIxed an error associated with strict validation and PHP during login
