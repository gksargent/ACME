<?php
//============================================================================
//================== server side validation for email inputs =================
//============================================================================

function checkEmail($clientEmail){
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
} //============================================================================




//============================================================================
//=============== server side validation for password inputs =================
//============================================================================

// Check the password for a minimum of 8 characters, at least one 1 capital letter, at least 1 number and at least 1 special character
function checkPassword($clientPassword){
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
  return preg_match($pattern, $clientPassword);
} //============================================================================




//============================================================================
//====== dynamically build a dropdown with categories from the database ======
//============================================================================

function categoryDropdown(){
  //this runs the getCategories function from acme-model.php
  $categories = getCategories();

  //this builds the dynamic drop down menu found on /view/new-product.php
  $categoryList = "<select id='categoryId' name='categoryId'>";
  $categoryList .= "<option selected disabled>Select a category</option>";
  foreach ($categories as $category) {
    $categoryList .= "<option id='$category[categoryId]' value='$category[categoryId]'>$category[categoryName]</option>";
  }
  $categoryList .='</select>';
  return $categoryList;
} //============================================================================




//============================================================================
//========================= dynamic main navigation ==========================
//============================================================================

function dynamicNavigation(){
  $categories = getCategories();
  //this builds the dynamic navigation using the $categories array
  $navList = '<ul>'."\n";
  $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>"."\n";
  foreach ($categories as $category) {
    $navList .="<li><a href='/acme/products/?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>"."\n";
  }
  $navList .='</ul>';
  return $navList;
} //============================================================================





//============================================================================
//========================= display products in unordered list ===============
//============================================================================

function buildProductsDisplay($products){
  $pd = '<ul id="product-display">'."\n";
  foreach ($products as $product) {
    $pd .= '<li>'."\n";
    $pd .= "<a class='product-link-container' href='/acme/products?action=product-details&id=$product[invId]' title='Click to view this product'>"."\n";
    $pd .= '<div class="product-image-container">'."\n";
    $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>"."\n";
    $pd .= '</div><!-- end product-image-container -->'."\n";
    $pd .= '<hr>'."\n";
    $pd .= "<h2>$product[invName]</h2>"."\n";
    $pd .= "<span>$$product[invPrice]</span>"."\n";
    $pd .= '</a>'."\n";
    $pd .= '</li>'."\n";
  }
  $pd .= '</ul>';
  return $pd;
}





//============================================================================
//========================= display product details ==========================
//============================================================================

function buildProductInfoDisplay($productInfo){
  $pd = '<div id="product-details-container">'."\n";
  $pd .= '<div id="product-details-content-left">'."\n";
  $pd .= "<h1>$productInfo[invName]</h1>"."\n";
  $pd .= "<p class='product-details-price'>$$productInfo[invPrice]</p>"."\n";
  $pd .= "<p class='product-details-stock'>"."\n";
    if ($productInfo[invStock] < 10){
      $pd .= "<span class='product-stock-low-tag'>Only $productInfo[invStock] left. Order soon!</span></p>"."\n";
    } else {
      $pd .= "<span class='product-in-stock-tag'>In stock!</span></p>"."\n";
    }
  $pd .= "<p class='product-details-description'>$productInfo[invDescription]</p>"."\n";
  $pd .= '<hr />'."\n";
  $pd .= '<h2>Product details</h2>'."\n";
  $pd .= '<ul>';
  $pd .= "<li>Size: $productInfo[invSize]</li>"."\n";
  $pd .= "<li>Weight: $productInfo[invWeight]</li>"."\n";
  $pd .= "<li>Style: $productInfo[invStyle]</li>"."\n";
  $pd .= '</ul>'."\n";
  $pd .= '</div>'."\n";
  $pd .= "<div id='product-details-content-right'>"."\n";
  $pd .= "<img class='product-details-image' src='$productInfo[invImage]' alt='An image showing the ACME $productInfo[invName]'>"."\n";
  $pd .= '</div>'."\n";
  $pd .= '</div>'."\n";

  return $pd;
}





//============================================================================
//========================= get images from db ===============================
//============================================================================

function getImages() {
  $db = acmeConnect();
  $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invName FROM images JOIN inventory ON images.invId = inventory.invId';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $imageArray;
}





//============================================================================
//========================= delete images from db ============================
//============================================================================

function deleteImage($id) {
  $db = acmeConnect();
  $sql = 'DELETE FROM images WHERE imgId = :imgId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':imgId', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->rowCount();
  $stmt->closeCursor();
  return $result;
}





//============================================================================
//====================== check for existing image ============================
//============================================================================

function checkExistingImage($imgName){
 $db = acmeConnect();
 $sql = "SELECT imgName FROM images WHERE imgName = :name";
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
 $stmt->execute();
 $imageMatch = $stmt->fetch();
 $stmt->closeCursor();
 return $imageMatch;
}





//============================================================================
//=========== helper functions for working with product images ===============
//============================================================================

// Adds "-tn" to file name
function makeThumbnailName($image) {
  $i = strrpos($image, '.');
  $image_name = substr($image, 0, $i);
  $ext = substr($image, $i);
  $image = $image_name . '-tn' . $ext;
  return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
  $id = '<ul id="image-display">'."\n";
  foreach ($imageArray as $image) {
  $id .= '<li>';
  $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
  $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
  $id .= '</li>'."\n";
  }
  $id .= '</ul>'."\n";
  return $id;
}

// Build the products select list
function buildProductsSelect($products) {
  $prodList = '<select name="invId" id="invId">';
  $prodList .= "<option>Choose a Product</option>";
  foreach ($products as $product) {
  $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
  }
  $prodList .= '</select>';
  return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
  global $image_dir, $image_dir_path; // Gets the paths, full and local directory
  if (isset($_FILES[$name])) {
    $filename = $_FILES[$name]['name']; // Gets the actual file name
    if (empty($filename)) {
     return;
    }
    $source = $_FILES[$name]['tmp_name']; // Get the file from the temp folder on the server
    $target = $image_dir_path . '/' . $filename; // Sets the new path - images folder in this directory
    move_uploaded_file($source, $target); // Moves the file to the target folder
    processImage($image_dir_path, $filename); // Send file for further processing
    $filepath = $image_dir . '/' . $filename;// Sets the path for the image for Database storage
    return $filepath;
    }
  }

// Processes images by getting paths and
// creating smaller versions of the image
function processImage($dir, $filename) {
  $dir = $dir . '/'; // Set up the variables
  $image_path = $dir . $filename; // Set up the image path
  $image_path_tn = $dir.makeThumbnailName($filename); // Set up the thumbnail image path
  resizeImage($image_path, $image_path_tn, 200, 200); // Create a thumbnail image that's a maximum of 200 pixels square
  resizeImage($image_path, $image_path, 500, 500); // Resize original to a maximum of 500 pixels square
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

  // Get image type
  $image_info = getimagesize($old_image_path);
  $image_type = $image_info[2];

  // Set up the function names
  switch ($image_type) {
    case IMAGETYPE_JPEG:
      $image_from_file = 'imagecreatefromjpeg';
      $image_to_file = 'imagejpeg';
      break;
    case IMAGETYPE_GIF:
      $image_from_file = 'imagecreatefromgif';
      $image_to_file = 'imagegif';
      break;
    case IMAGETYPE_PNG:
      $image_from_file = 'imagecreatefrompng';
      $image_to_file = 'imagepng';
      break;
    default:
    return;
  }

  // Get the old image and its height and width
  $old_image = $image_from_file($old_image_path);
  $old_width = imagesx($old_image);
  $old_height = imagesy($old_image);

  // Calculate height and width ratios
  $width_ratio = $old_width / $max_width;
  $height_ratio = $old_height / $max_height;

  // If image is larger than specified ratio, create the new image
  if ($width_ratio > 1 || $height_ratio > 1) {

  // Calculate height and width for the new image
  $ratio = max($width_ratio, $height_ratio);
  $new_height = round($old_height / $ratio);
  $new_width = round($old_width / $ratio);

  // Create the new image
  $new_image = imagecreatetruecolor($new_width, $new_height);

  // Set transparency according to image type
  if ($image_type == IMAGETYPE_GIF) {
    $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
    imagecolortransparent($new_image, $alpha);
  }

  if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
  }

  // Copy old image to new image - this resizes the image
  $new_x = 0;
  $new_y = 0;
  $old_x = 0;
  $old_y = 0;
  imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

  // Write the new image to a new file
  $image_to_file($new_image, $new_image_path);

  // Free any memory associated with the new image
  imagedestroy($new_image);
  } else {
  // Write the old image to a new file
  $image_to_file($old_image, $new_image_path);
  }

  // Free any memory associated with the old image
  imagedestroy($old_image);
}





//==================== place a comment here later =============================

function buildThumbnailDisplay($productThumbnails) {
  $id = '<ul id="image-display">';
  foreach ($productThumbnails as $image) {
  $id .= '<li>';
  $id .= "<img src='$image[imgPath]' title='$image[imgName] image on Acme.com' alt='$image[imgName] image on Acme.com'>";
  $id .= '</li>';
  }
  $id .= '</ul>';
  return $id;
}





//============================================================================
//======================== wrap reviews in html ==============================
//============================================================================

function buildReviewDisplay($reviews) {
  $rd = '<ul id="product-reviews-table">';
  foreach ($reviews as $review) {
    $date = date("F jS, Y", strtotime($review['reviewDate']));
    $firstName = substr($review['clientFirstname'], 0, 1);
    $lastName = $review['clientLastname'];
    $screenName = $firstName . $lastName;
    $rd .= '<li><span>';
    $rd .= "$screenName said: ";
    $rd .= "$review[reviewText] on $date";
    $rd .= '</span></li>';
  }
  $rd .= "</ul>";
  return $rd;
}
 ?>
