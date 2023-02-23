<?php
$basepath = dirname($_SERVER['SCRIPT_FILENAME']);
//$initialpath = 'C:/xampp/htdocs/personal_dbw_page';
//$clustalHome = 'C:\xampp\htdocs\personal_dbw_page\assets\clustal-omega-1.2.2-win64/';
//$clustalcmdline = 'clustalo.exe';
//$initialpath = dirname($_SERVER['SCRIPT_FILENAME']);
$initialpath = '/home/marc/public_html/personal_dbw_page';
$clustalcmdline = 'clustalo';
$clustalHome = '/usr/bin/';

$tmpDir = "$initialpath/tmp";



include_once "php/head_func.php";


session_start();