<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'product';
$pageTitle = 'Product Management';
$pageDescription = "A spot to manage all the products.";
$clientLevel = $_SESSION['clientData']['clientLevel'];

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

if(isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?>

<!DOCTYPE html>
<html lang="en-US">
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/author-statement.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/head.php"; ?>
<body>
<div id="container">

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/header.php"; ?>

<main>

  <h1><?php echo $pageTitle; ?></h1>
  <p><a href="/acme/accounts/">&#8592; Back to account</a></p>
  <p>Welcome to the product management page. Please choose an option below:</p>
  <ul>
    <li><a href="/acme/products/index.php?action=new-category-form" title="Click here to add a new category">New Category</a></li>
    <li><a href="/acme/products/index.php?action=new-product-form" title="Click here to add a new product">New Product</a></li>
    <li><a href="/acme/uploads/" title="Click here to manage product photos">Manage Images</a></li>
  </ul>

  <!-- Display table of products built from controller -->
  <?php
    if (isset($message)) {
      echo $message;
    } if (isset($prodList)) {
      echo $prodList;
    }
   ?>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
<?php unset($_SESSION['message']); ?>
