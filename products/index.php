<?php
//products controller

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
switch ($action){
  //need a case to deliver new category form
  case 'new-category-form':
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-category.php';
    break;

    //need a case to deliver new product form
  case 'new-product-form':
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-product.php';
    break;

  case 'newCategory':
    $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

    if (empty($categoryName)) {
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-category.php';
      exit;
    }

    //Send data to the model
    $newCategoryOutcome = newCategory($categoryName);

    //Check and report the result
    if ($newCategoryOutcome === 1){
      //need to create a header function
      //learn more about header function ***** search youtube for cit336 "php header"
      header('location: /acme/products/index.php');
      exit;
    } else {
      $message = '<p class="form-error">Oops, new category not created. Please try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-category.php';
      exit;
    }
    break;

  case 'newProduct':
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);//int(10)
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);//varchar(50)
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);//text
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);//varchar(50)
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);//varchar(50)
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);//decimal(10,2)
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);//smallint(6)
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);//smallint(6)
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);//smallint(6)
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);//varchar(35)
    $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);//varchar(20)
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);//varchar(20)

    if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)){
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-product.php';
      exit;
    }

    //send the data to the model
    $newProductOutcome = newProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);

    //check and report the result
    if ($newProductOutcome === 1){
      $message = "<p class='success-message'>$invName has been created!</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-product.php';
      exit;
    } else {
      $message = '<p class="form-error">Oops, new product not created. Please try again.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/new-product.php';
      exit;
    }
    break;

  case 'mod':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $productInfo = getProductInfo($invId);
    if(count($productInfo)<1){
      $message = 'Sorry, no product information could be found.';
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-update.php';
    exit;

    break;

  case 'updateProduct':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);//int(10)
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);//varchar(50)
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);//text
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);//varchar(50)
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);//varchar(50)
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);//decimal(10,2)
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);//smallint(6)
    $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);//smallint(6)
    $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);//smallint(6)
    $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);//varchar(35)
    $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);//varchar(20)
    $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);//varchar(20)

    if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)){
      $message = '<p class="form-error">All fields are required.</p>';
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-update.php';
      exit;
    }

    //send the data to the model
    $updateResult = updateProduct($invId, $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);

    //check and report the result
    if ($updateResult){
      $message = "<p class='success-message'>$invName has been updated!</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/products/');
      exit;
    } else {
      $message = "<p class='form-error'>Oops, product was not updated. Please try again.</p>";
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-update.php';
      exit;
    }
    break;

  case 'del':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $productInfo = getProductInfo($invId);
    if(count($productInfo)<1){
      $message = 'Sorry, no product information could be found.';
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-delete.php';
    exit;

    break;

  case 'deleteProduct':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);

    //send the data to the model
    $deleteResult = deleteProduct($invId);

    //check and report the result
    if ($deleteResult){
      $message = "<p class='success-message'>$invName has been deleted!</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/products/');
      exit;
    } else {
      $message = "<p class='form-error'>Oops, something didn't work quite right. Product was not deleted. Try again.</p>";
      $_SESSION['message'] = $message;
      header('location: /acme/products/');
      exit;
    }
    break;

  case 'category':
    $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
    $products = getProductsByCategory($type);
    if(!count($products)){
      $message = "<p class='form-error'>No $type products could be found.</p>";
    } else {
      $productDisplay = buildProductsDisplay($products);

      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/category.php';
    }
    break;


  case 'product-details':
    $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $productInfo = getProductInfo($invId);
    $productThumbnails = getAllProductThumbnails($invId);
    $itemReviews = getItemReviews($invId);
    if(count($productInfo)<1){
      $message = "<p class='form-error'>Oops, something wonky happened.<br />Product info could not be found.</p>";
    } else {
      $productDisplay = buildProductInfoDisplay($productInfo);
      $thumbnailDisplay = buildThumbnailDisplay($productThumbnails);
      $reviewsDisplay = buildReviewDisplay($itemReviews);

      include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-details.php';
    }
    break;


  default:
    $products = getProductBasics();
    if(count($products) > 0){
      $prodList = '<table>';
      $prodList .= '<thead>';
      $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
      $prodList .= '</thead>';
      $prodList .= '<tbody>';
      foreach ($products as $product) {
        $prodList .= "<tr><td>$product[invName]</td>";
        $prodList .="<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
        $prodList .="<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
      }
    $prodList .= '</tbody></table>';
  } else {
    $message = '<p class="form-error">Sorry, no products were returned.</p>';
  }

  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-mgmt.php';
  break;
}
 ?>
