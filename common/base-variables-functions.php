<?php
//Statements pulling in common functions
include_once $_SERVER['DOCUMENT_ROOT']."/acme/functions/email.php";

//Variables for common-variables.php
$authorFname = 'Greg';
$authorLname = 'Sargent';
$siteTagline = '';
$siteDescription = "A place for all your roadrunner needs.";
$today = date('l');
$currentYear = date("Y");
$myTimeZone = date_default_timezone_set('America/Chicago');
$lastModified = "Last updated: " . date("j F, Y", getlastmod());

//Variables for client data 
$clientFirstname = $_SESSION['clientData']['clientFirstname'];
$clientLastname = $_SESSION['clientData']['clientLastname'];
$clientEmail = $_SESSION['clientData']['clientEmail'];
$clientPassword = $_SESSION['clientData']['clientPassword'];
$clientId = $_SESSION['clientData']['clientId'];

//Sets the locale to US for all currency display
setlocale(LC_MONETARY, 'en_US');
?>
