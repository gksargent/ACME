<?php
//reviews controller

session_start();

//this brings the connections.php file into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/connections.php';

//this brings the models into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/acme-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/products-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/uploads-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/reviews-model.php';

//this brings in all the functions into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/functions.php';


//=============================================================================

//this runs the getCategories function from acme-model.php
$categories = getCategories();

//this is for the dynamic navigation
$navList = dynamicNavigation();

//=============================================================================

//this gets the data being passed either through the POST or GET objects
//the filter stuff is to prevent hacking attempts
//any name-value or key-value (same thing) pairs where the key is the word 'action' the value is stored in the $action variable
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


//this evaluates what is stored in the $action variable and then does something different based on what is found in the variable
switch ($action) {


  //============================================================================
  case 'new-review':
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($reviewText) || empty($invId) || empty($clientId)) {
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-details.php';
      exit;
    }

    //Send data to the model
    $newReviewOutcome = newReview($reviewText, $invId, $clientId);

    //Check and report the result
    if ($newReviewOutcome === 1){
      header('location: /acme/reviews/index.php');
      exit;
    } else {
      $message = '<p class="form-error">Oops, new review not created. Please try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-details.php';
      exit;
    }
    break;



  //============================================================================
  case 'deliver-edit-review':
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/edit-review.php';
    break;



  //============================================================================
  case 'process-edit-review':
    # code...
    break;



  //============================================================================
  case 'deliver-delete-review':
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/delete-review.php';
    break;



  //============================================================================
  case 'process-delete-review':
    # code...
    break;



  //============================================================================
  default:
    if(!$_SESSION['loggedin']){
      header('Location: /acme/');
    } elseif {
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php/';
    }
    break;
}
}
 ?>
