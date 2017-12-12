<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Product variables pulled from database
$invName = $productInfo[invName];
$invDescription = $productInfo[invDescription];
$invImage = $productInfo[invImage];
$invThumbnail = $productInfo[invThumbnail];
$invPrice = $productInfo[invPrice];
$invStock = $productInfo[invStock];
$invSize = $productInfo[invSize];
$invWeight = $productInfo[invWeight];
$invLocation = $productInfo[invLocation];
$categoryId = $productInfo[categoryId];
$invVendor = $productInfo[invVendor];
$invStyle = $productInfo[invStyle];
$invId = $productInfo[invId];


//Other variables and statements
$directoryName = $type;
$pageTitle = $invName . ' | Acme, Inc.';
$pageDescription = $invDescription;
?>

<!DOCTYPE html>
<html lang="en-US">
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/author-statement.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/head.php"; ?>
<body>
<div id="container">

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/header.php"; ?>

<main>
  <div id="review-banner">
    <p>Take a look at the reviews at the bottom!</p>
  </div>
  <?php if(isset($message)){ echo $message; } ?>
  <?php if(isset($productDisplay)){ echo $productDisplay; } ?>
  <hr />
  <?php if(isset($thumbnailDisplay)){ echo $thumbnailDisplay; } ?>
  <hr />
  <h2>Customer Reviews</h2>
  <?php
    if (isset($_SESSION['loggedin'])) {
      $first = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
      $screenName = $first . '' . $_SESSION['clientData']['clientLastname'];

      echo '<h3>Review this product</h3>';

      if (isset($message)) {
        echo $message;
      }

      echo '<form action="/acme/reviews/" method="post" id="review-form">';
      echo "<label for='reviewText'>Logged in as $screenName</label>";
      echo '<br>';
      echo '<textarea cols="50" id="reviewText" name="reviewText" placeholder="Leave a product review here" required rows="5"></textarea>';
      echo '<br>';
      echo "<input type='hidden' name='clientId' value='$_SESSION'";
      echo "['clientData']['clientId']";
      echo '>';
      echo '<input type="hidden" name="action" value="new-review">';
      echo '<input class="button" type="submit" value="Submit Review">';
      echo '</form>';
    } else {
      echo "<p><a href='/acme/accounts/index.php?action=login'>Login</a> to review this product.";
    }

    if (isset($reviewsDisplay)) {
      echo $reviewsDisplay;
    }
?>







</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
