<?php
//accounts controller

session_start();

//this brings the connections.php file into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/connections.php';

//this brings the models into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/acme-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/accounts-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/reviews-model.php';

//this brings in all the functions into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/functions.php';


//===========================================================================

//this runs the getCategories function from acme-model.php
$categories = getCategories();

//this is for the dynamic navigation
$navList = dynamicNavigation();

//===========================================================================

//this gets the data being passed either through the POST or GET objects
//the filter stuff is to prevent hacking attempts
//any name-value or key-value (same thing) pairs where the key is the word 'action' the value is stored in the $action variable
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


//this evaluates what is stored in the $action variable and then does something different based on what is found in the variable
switch ($action){

  case 'login':
    if ($action = 'login'){
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
    }

    //Delete cookie at login
    setcookie('firstname', '', strtotime('-1 year'), '/');
    break;


  case 'register':
    if ($action = 'login'){
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
    }
    break;

  case 'loggedin':
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
    exit;
    break;

  case 'logout':
    session_destroy();
    header('Location: /acme/');

    setcookie('firstname', '', strtotime('-1 year'), '/');
    exit;
    break;

  case 'update':
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
    exit;
    break;


  case 'register-form':
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for an existing email
    $existingEmail = checkExistingEmail($clientEmail);
    if ($existingEmail) {
      $message = '<p class="notice">It looks like you already have an account. Do you want to login instead?</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
      exit;
    }

    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $registrationOutcome = registerClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if($registrationOutcome === 1){
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $message = "<p class='success-message'>Thanks for registering $clientFirstname. You can now use your email and password to login.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
      exit;
    } else {
      $message = '<p class="form-error">Sorry $clientFirstname, but the registration failed. Please try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
      exit;
    }
    break;



  case 'login-form':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $passwordCheck = checkPassword($clientPassword);

    if (empty($clientEmail) || empty($passwordCheck)) {
      $message = '<p class="form-error">Please provide a valid email address and password.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
      exit;
    }

    //when a valid password exists, proceed with login process
    $clientData = getClient($clientEmail);//query database for client email
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);//query database for client password

    //error handling for password no match
    if (!$hashCheck){
      $message = '<p class="form-error">Please check your password and try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
      exit;
    }

    //login valid user
    $_SESSION['loggedin'] = TRUE;
    array_pop($clientData);
    $_SESSION['clientData'] = $clientData;
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
    exit;
    break;



  //need to add case for account info update form (enhancement accounts controller step 2)

  case 'updateClientInfo':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
//echo $clientId.', '.$clientFirstname.', '.$clientLastname.', '.$clientEmail;
//exit;
    // Check for an existing email in the database
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for match with current session email
    if($clientEmail != $_SESSION['clientData']['clientEmail']){

      if ($existingEmail) {
        $message = '<p class="form-error">Oops, it looks like that email is already in use.</p>';
        include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
        exit;
      }
    }




    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
      exit;
    }

    //send the data to the model
    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

    //check and report the result
    if ($updateResult){
      $message = "<p class='success-message'>Your account has been updated!</p>";
      $_SESSION['message'] = $message;
      $_SESSION['clientData'] = getClient($clientEmail);
      header('location: /acme/accounts/');
      exit;
    } else {
      $message = "<p class='form-error'>Oops, something didn't work quite right. Please try again.</p>";
      header('location: /acme/accounts/');
      exit;
    }
    exit;
    break;

  case 'updateClientPassword':
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $checkPassword = checkPassword($clientPassword);

    if (empty($checkPassword)){
      $passwordMessage = '<p>Oops, it looks like you did not enter valid password.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $newPasswordOutcome = updatePassword($hashedPassword, $clientId);


    // checks the results of the update
    if($newPasswordOutcome === 1){ //should it be if($rowsChanged) === 1 ?
      $passwordMessage = "<p class='success-message'>Password updated!</p>";
      $_SESSION['message'] = $passwordMessage;
      header('location: /acme/accounts/');
      exit;
    } else {
      $passwordMessage = "<p class='form-error'>Oops, something didn't work quite right. Please try again.</p>";
      $_SESSION['message'] = $passwordMessage;
      header('location: /acme/accounts/');
      exit;
    }
    break;



    default:
      $clientId = $_SESSION['clientData']['clientId'];
      $reviews = getClientReviews($clientId);

      if (count($reviews) > 0) {
        $reviewList = '<table id="your-product-reviews-table">';
        $reviewList .= '<thead>';
        $reviewList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
        $reviewList .= '</thead>';
        $reviewList .= '<tbody>';
        foreach ($reviews as $review) {
          $reviewList .= "<tr><td class='table-main-content-column'>$review[reviewText]</td>";
          $reviewList .= "<td class='table-action-button-column'><a href='/acme/reviews/index.php?action=deliver-edit-review&id=$review[reviewId]' title='Edit this review'>Edit</a></td>";
          $reviewList .="<td class='table-action-button-column'><a href='/acme/reviews/index.php?action=deliver-delete-review&id=$review[reviewId]' title='Delete this review.'>Delete</a></td></tr>";
        }
        $reviewList .= '</tbody></table>';
      } else {
        $message = '<p class="error-message">No reviews found.</p>';
      }

      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
      break;
  }

 ?>
