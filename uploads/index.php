<?php
//image uploads controller

session_start();

//this brings the connections.php file into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/connections.php';

//this brings the models into scope
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/acme-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/products-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/model/uploads-model.php';

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
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

//===========================================================================

//variables for use with the image upload functionality

$image_dir = '/acme/images/products'; // directory name where uploaded images are stored
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir; // The path is the full path from the server root

//===========================================================================

//switch cases for name value pairs handling

switch ($action) {
  case 'upload':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
    $imgName = $_FILES['file1']['name'];
    $imageCheck = checkExistingImage($imgName);

    if($imageCheck){
      $message = '<p class "form-error">An image by that name already exists.</p>';
    } elseif (empty($invId) || empty($imgName)) {
      $message = '<p class="form-error">You must select a product and image file for the product.</p>';
    } else {
      $imgPath = uploadFile('file1');
      $result = storeImages($imgPath, $invId, $imgName);
      if ($result) {
        $message = '<p class="success-message">Upload completed!</p>';
      } else {
        $message = '<p class="form-error">Sorry, the upload failed.</p>';
      }
    }

    $_SESSION['message'] = $message;
    header('location: .');
    break;

  case 'delete':
    $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING); // Get the image name
    $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);// Get the image id
    $target = $image_dir_path . '/' . $filename; // Build the full path to the image to be deleted

    if (file_exists($target)) {
     $result = unlink($target);
    } // Deletes the file in the folder

    if ($result) {
     $remove = deleteImage($imgId);
    } // Remove from database only if physical file deleted

    if ($remove) {
     $message = "<p class='success-message'>$filename was successfully deleted.</p>";
    } else {
     $message = "<p class='form-error'>$filename was NOT deleted.</p>";
    } // Set a message based on the delete result

    $_SESSION['message'] = $message;
    header('location: .');
    break;

  default:
    $imageArray = getImages(); // Call function to return image info from database

    if (count($imageArray)) {
       $imageDisplay = buildImageDisplay($imageArray);
      } else {
       $imageDisplay = '<p class="form-error">Sorry, no images could be found.</p>';
      } // Build the image information into HTML for display

    $products = getProductBasics(); // Get inventory information from database
    $prodSelect = buildProductsSelect($products); // Build a select list of product information for the view

    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/image-admin.php';
    break;
}
 ?>
