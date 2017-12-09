<?php
//this is the controller for the home page

session_start();

//this brings the connections.php file into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/connections.php';

//this brings the models into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/acme-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/accounts-model.php';

//this brings in all the functions into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/functions.php';

//============================================================================

//this runs the getCategories function from acme-model.php
$categories = getCategories();

//this is for the dynamic navigation
$navList = dynamicNavigation();

//============================================================================

//this gets the data being passed either through the POST or GET objects
//the filter stuff is to prevent hacking attempts
//any name-value or key-value (same thing) pairs where the key is the word 'action' the value is stored in the $action variable
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

//============================================================================

//this looks for a cookie and if found says hello to the visitor by name
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

//this evaluates what is stored in the $action variable and then does something different based on what is found in the variable
switch ($action){
 case 'something':
 break;
 default:
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/home.php';
}

 ?>
