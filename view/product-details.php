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
  <?php
    if (isset($_SESSION['loggedin'])) {
      $first = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
      $screenName = $first . '' . $_SESSION['clientData']['clientLastname'];
      $sessionClientDataClientId = $_SESSION['clientData']['clientId'];

      if (isset($reviewFormMessage)) {
        echo $reviewFormMessage;
      }

      echo '<form action="/acme/reviews/index.php" method="post" id="review-form">'."\n";
      echo "<label for='reviewText'>Review this product as $screenName</label>"."\n";
      echo '<br>'."\n";
      echo '<textarea cols="50" id="reviewText" name="reviewText" placeholder="Leave a product review here" required rows="5"></textarea>'."\n";
      echo '<br>'."\n";
      echo "<input type='hidden' name='clientId' value='$sessionClientDataClientId'>"."\n";
      echo "<input type='hidden' name='invId' value='$invId'>"."\n";
      echo '<input type="hidden" name="action" value="new-review">'."\n";
      echo '<input class="button" name="submit" type="submit" value="Submit Review">'."\n";
      echo '</form>'."\n";
    } else {
      echo "<p><a href='/acme/accounts/index.php?action=login'>Login</a> to review this product."."\n";
    }

    echo '<br>';
    echo '<h2>Customer Reviews</h2>';

    if (count($itemReviews) > 0) {
      echo $reviewsDisplay;
    } else {
      echo '<p>This product has not been reviewed yet.</p>'."\n";
    }
?>




</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
