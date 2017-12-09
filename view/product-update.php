<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'product';
$pageTitle = "$productInfo[invName] | Acme, Inc";
$pageDescription = "Update ACME products here.";
$clientLevel = $_SESSION['clientData']['clientLevel'];

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

//this builds the dynamic drop down menu and makes it sticky
$categoryList = "<select id='categoryId' name='categoryId'>";
$categoryList .= "<option selected disabled>Select a category</option>";
foreach ($categories as $category) {
  $categoryList .= "<option id='$category[categoryId]' value='$category[categoryId]'";
  if(isset($categoryId)){
    if($category['categoryId'] === $categoryId){
      $categoryList .= ' selected ';
    }
  } elseif(isset($productInfo['categoryId'])){
    if($category['categoryId'] === $productInfo['categoryId']){
      $categoryList .= ' selected ';
    }
  }
  $categoryList .= ">$category[categoryName]</option>";
}
$categoryList .='</select>';
?>

<!DOCTYPE html>
<html lang="en-US">
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/author-statement.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/head.php"; ?>
<body>
<div id="container">

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/header.php"; ?>

<main>

  <h1>
    <?php
      if(isset($productInfo['invName'])){
        echo "Modify $productInfo[invName]";
      } elseif(isset($invName)){
        echo $invName;
      }
    ?>
  </h1>

  <p><a href="/acme/products/">&#8592; Back to products</a></p>
  <p>Make your edits <?php if(isset($productInfo['invName'])){echo "to $productInfo[invName]";} ?> and click "Update product" when done.</p>

  <!-- message handling -->
  <?php if (isset($message)) {echo $message;} ?>
  <form method="post" action="/acme/products/index.php/" class="stacked-form">
    <label>Category</label>
    <?php echo $categoryList; ?>
    <label for="invName">Product name</label>
    <input <?php if(isset($invName)){echo "value='$invName'";}
                  elseif(isset($productInfo['invName'])){echo "value='$productInfo[invName]'";} ?>
           id="invName"
           maxlength="50"
           name="invName"
           placeholder="Enter product name"
           required
           type="text" >
    <label for="invDescription">Description</label>
    <textarea cols="50"
              id="invDescription"
              name="invDescription"
              placeholder="Enter description"
              required
              rows="5"><?php if(isset($invDescription)){echo $invDescription;}
                              elseif(isset($productInfo['invDescription'])){echo $productInfo[invDescription];} ?></textarea>
    <label for="invImage">Product Image (url)</label>
    <input <?php if(isset($invImage)){echo "value='$invImage'";}
                  elseif(isset($productInfo['invImage'])){echo "value='$productInfo[invImage]'";} ?>
           id="invImage"
           maxlength="50"
           name="invImage"
           placeholder="/path..."
           required
           type="text"
           value="/acme/images/site/no-image.png">
    <label for="invThumbnail">Product Thumbnail (url)</label>
    <input <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}
                  elseif(isset($productInfo['invThumbnail'])){echo "value='$productInfo[invThumbnail]'";} ?>
           id="invThumbnail"
           maxlength="50"
           name="invThumbnail"
           placeholder="/path..."
           required
           type="text"
           value="/acme/images/site/no-image.png">
    <label for="invPrice">Price</label>
    <input <?php if(isset($invPrice)){echo "value='$invPrice'";}
                  elseif(isset($productInfo['invPrice'])){echo "value='$productInfo[invPrice]'";} ?>
           id="invPrice"
           min="0.01"
           name="invPrice"
           placeholder="Enter amount"
           required
           step="0.01"
           type="number">
    <label for="invStock">Starting stock amount</label>
    <input <?php if(isset($invStock)){echo "value='$invStock'";}
                  elseif(isset($productInfo['invStock'])){echo "value='$productInfo[invStock]'";} ?>
           id="invStock"
           name="invStock"
           placeholder="Enter stock amount"
           required
           step="1"
           type="number" >
    <label for="invSize">Product size</label>
    <input <?php if(isset($invSize)){echo "value='$invSize'";}
                  elseif(isset($productInfo['invSize'])){echo "value='$productInfo[invSize]'";} ?>
           id="invSize"
           name="invSize"
           placeholder="Enter product size"
           required
           step="1"
           type="number" >
    <label for="invWeight">Product weight (in oz.)</label>
    <input <?php if(isset($invWeight)){echo "value='$invWeight'";}
                  elseif(isset($productInfo['invWeight'])){echo "value='$productInfo[invWeight]'";} ?>
           id="invWeight"
           name="invWeight"
           placeholder="Enter product weight"
           required
           step="1"
           type="number" >
    <label for="invLocation">Product location</label>
    <input <?php if(isset($invLocation)){echo "value='$invLocation'";}
                  elseif(isset($productInfo['invLocation'])){echo "value='$productInfo[invLocation]'";} ?>
           id="invLocation"
           maxlength="35"
           name="invLocation"
           placeholder="Enter product location"
           required
           type="text" >
    <label for="invVendor">Product vendor</label>
    <input <?php if(isset($invVendor)){echo "value='$invVendor'";}
                  elseif(isset($productInfo['invVendor'])){echo "value='$productInfo[invVendor]'";} ?>
           id="invVendor"
           maxlength="20"
           name="invVendor"
           placeholder="Enter product vendor"
           required
           type="text" >
    <label for="invStyle">Product style</label>
    <input <?php if(isset($invStyle)){echo "value='$invStyle'";}
                  elseif(isset($productInfo['invStyle'])){echo "value='$productInfo[invStyle]'";} ?>
           id="invStyle"
           maxlength="20"
           name="invStyle"
           placeholder="Enter product style"
           required
           type="text" >

    <input class="button"
           id="productButton"
           name="submit"
           type="submit"
           value="Update product" >
    <input name="action"
           type="hidden"
           value="updateProduct" >
    <input name="invId"
           type="hidden"
           value="<?php if(isset($productInfo['invId'])){ echo $productInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
  </form>


</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
