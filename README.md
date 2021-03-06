# Udacity: Event Planner
A basic event planner to showcase user experience.

## Version/Demo
3.0.0-Alpha: Live Demo: [www.coreymontgomery.com](http://www.coreymontgomery.com).

---
## Objective
This is the first project for Udacity's Senior Web Developer Nanodegree. The primary objective is to evaluate user experience in relation to forms. 

---
## Requirements
[Nodes JS](https://nodejs.org/en/)

[Gulp JS](http://gulpjs.com/)

PHP 5 >= 5.5 (Password Hash, used to have fallback, may add back in. TODO?)

Local server or Live server: I currentlty use [AMPPS](http://www.ampps.com/). It is a little bloated, but very easy to use and setup mock domains.

---
## Installation
###Conifiguration Setup (Database/URL's)
1. Download or clone the git repository
2. To setup the database run the sql code from **_install/install.sql** file. This file will create the database and all necessary tables within it.

3. You will also need to change the URL constant in the **dist/app/config.php** file.  All url's for project resources are based off of this.
``` PHP
define('URL', 'http://YOUR_PATH_HERE/'); 
```
4. You will need to change the database login credentials in the dist/app/config.php file.
```PHP
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'event-planner'); 
define('DB_USER', 'root'); 
define('DB_PASS', 'mysql');
```

---
###Development
1. In windows open the folder where the repository is found. 
    1. Select the file path at the top of the window, and erase its contents. 
    2. Type 'cmd' without quotes and hit enter.
    3. This will open a command line to the current directory. 
3. Type `npm install` to install all dependencies (Must have NodeJs installed).
4. After the dependencies are installed, type `gulp` (Must have GilpJs installed).
5. Gulp will now be watching the Sass files and the JavaScript files. Gulp takes care of converting the Sass into CSS as well as combing JavaScript files and minifying both.

---
###Deployment
1. Copy the **dist** folder to the server. Localhost or online.
2. **dist** acts as the root folder and domains should point to it.
3. If the database has already been setup and is in working order, everything is good to go.

---
## Some Known Issues

Better solution to the media query/javascript hacks

If user tries to submit the form before changing focus, it will not prompt the user the email is being used.

---
## References/Credits
The back-end of this application is built on an overhauled version of Jesse Boyer's (JREAM), PHP-MVC tutorial. 

Several of Udacity's courses, more specifically, High Conversion Web Forms and Web Tooling and Automation.

Stack Overflow. Credits are within the code itself, commented with links to the source.

Materializecss for the colors.
