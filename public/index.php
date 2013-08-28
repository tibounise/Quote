<?php

define('__APPROOT__',__DIR__.'/..');

require __APPROOT__.'/vendor/meringue/Meringue.php';
require __APPROOT__.'/app/config/MeringueConf.php';
require __APPROOT__.'/app/config/QuoteConf.php';

Meringue::start();

?>