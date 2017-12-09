<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'product';
$pageTitle = "Delete $productInfo[invName] | Acme, Inc";
$pageDescription = "Delete $invName?";
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
        echo "Delete $productInfo[invName]";
      } elseif(isset($invName)){
        echo $invName;
      }
    ?>
  </h1>

  <p><a href="/acme/products/">&#8592; Back to products</a></p>
  <p>Are you sure you want to delete the product?</p>

  <!-- message handling -->
  <?php if (isset($message)) {echo $message;} ?>
  <form method="post" action="/acme/products/index.php/" class="stacked-form">
    <label for="invName">Product name</label>
    <input <?php if(isset($invName)){echo "value='$invName'";}
                  elseif(isset($productInfo['invName'])){echo "value='$productInfo[invName]'";} ?>
           id="invName"
           name="invName"
           readonly
           type="text" >
    <label for="invDescription">Description</label>
    <textarea cols="50"
            id="invDescription"
            name="invDescription"
            readonly
            rows="5"><?php if(isset($invDescription)){echo $invDescription;}
                            elseif(isset($productInfo['invDescription'])){echo $productInfo[invDescription];} ?></textarea>
    <input class="button"
           id="productButton"
           name="submit"
           type="submit"
           value="Delete product" >
    <input name="action"
           type="hidden"
           value="deleteProduct" >
    <input name="invId"
           type="hidden"
           value="<?php if(isset($productInfo['invId'])){ echo $productInfo['invId'];} ?>">
  </form>


</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
