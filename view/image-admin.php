<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'admin';
$pageTitle = 'Image Management';
$pageDescription = "Update your ACME account information here.";

if(!$_SESSION['loggedin']){
  header('Location: /acme/accounts/');
}

if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
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
  <p><a href="/acme/products/">&#8592; Back to products</a></p>
  <p>Add or delete product images below.</p>
  <h2>Add New Product Image</h2>

  <?php if (isset($message)) {echo $message;} ?>

  <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
    <label for="invItem">Product</label><br>
    <?php echo $prodSelect; ?><br><br>
    <label>Upload Image:</label><br>
    <input type="file" name="file1"><br><br>
    <input type="submit" class="button" value="Upload">
    <input type="hidden" name="action" value="upload">
  </form>
  <hr />

  <h2>Existing Images</h2>
  <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
  <?php if (isset($imageDisplay)) {echo $imageDisplay;} ?>


</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>

<?php unset($_SESSION['message']); ?>
