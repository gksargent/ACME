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

  <?php if(isset($message)){ echo $message; } ?>
  <?php if(isset($productDisplay)){ echo $productDisplay; } ?>
  <hr />
  <?php if(isset($thumbnailDisplay)){ echo $thumbnailDisplay; } ?>
  <hr />
  <h2>Reviews</h2>
  <?php echo $reviewList ?>









</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
