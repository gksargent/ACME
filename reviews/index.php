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


//==============================================================================

//this runs the getCategories function from acme-model.php
$categories = getCategories();

//this is for the dynamic navigation
$navList = dynamicNavigation();

//==============================================================================

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
    if ($newReviewOutcome === 1) {
      $message = "<p class='success-message'>Review added!</p>";
      $productInfo = getProductInfo($invId);
      $productThumbnails = getAllProductThumbnails($invId);
      $itemReviews = getItemReviews($invId);
      $productDisplay = buildProductInfoDisplay($productInfo);
      $thumbnailDisplay = buildThumbnailDisplay($productThumbnails);
      $reviewsDisplay = buildReviewDisplay($itemReviews);

      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-details.php';
      //header('location: /acme/reviews/index.php');
    } else {
      $reviewFormMessage = '<p class="form-error">Oops, something wonky happened. Please try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-details.php';
    }
    break;



  //============================================================================
  case 'deliver-edit-review':
    $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $reviewDetails = getReview($reviewId);

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/edit-review.php';
    break;



  //============================================================================
  case 'process-edit-review':
    $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
    $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($reviewText) || empty($clientId) || empty($invId) || empty($reviewId)) {
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/edit-review.php';
      exit;
    }

    $editedReviewResult = updateReview($reviewText, $clientId, $invId, $reviewId);

    if ($editedReviewResult) {
      $editMessage = "<p class='success-message'>Review upated!</p>";
      $_SESSION['message'] = $editMessage;
      header('location: /acme/reviews/');
      exit;
    } else {
      $message = "<p class='form-error'>Oops, couldn't update review. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/edit-review.php';
      exit;
    }
    break;



  //============================================================================
  case 'deliver-delete-review':
    $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $reviewInfo = getReview($reviewId);
    $reviewText = $itemReviews['reviewText'];


    if (count($reviewInfo) < 1) {
      $message = "<p class='form-error'>No review found</p>";
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/delete-review.php';
    exit;
    break;



  //============================================================================
  case 'process-delete-review':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteReview($reviewId);

    if($deleteResult) {
      $message = "<p class='success-message'>Review deleted!</p>";
      $_SESSION['message'] = $message;
      header ('location: /acme/reviews/');
      exit;
    } else {
      $message = "<p class='form-error'>Oops, review was not deleted. Try again.</p>";
      $_SESSION['message'] = $message;
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/delete-review.php';
      exit;
    }
    break;



  //============================================================================
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
        $reviewList .= "<td class='table-action-button-column'><a href='/acme/reviews?action=deliver-edit-review&id=$review[reviewId]' title='Edit this review'>Edit</a></td>";
        $reviewList .="<td class='table-action-button-column'><a href='/acme/reviews?action=deliver-delete-review&id=$review[reviewId]' title='Delete this review.'>Delete</a></td></tr>";
      }
      $reviewList .= '</tbody></table>';
    } else {
      $message = '<p class="error-message">No reviews found.</p>';
    }

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
    break;
}
 ?>
