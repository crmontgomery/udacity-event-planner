<?php date_default_timezone_set('America/Los_Angeles');?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Duellogic" />
        <meta content="no-cache" />
        <!-- http://stackoverflow.com/questions/26888751/chrome-device-mode-emulation-media-queries-not-working -->
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title><?php echo (isset($this->title)) ? $this->title : 'EP9k'; ?></title>
        <link href="<?php echo PUBLIC_URL  . 'css/stylesheet.css?' . date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
