<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'product';
$pageTitle = 'Add Category';
$pageDescription = "Add new categories";
$clientLevel = $_SESSION['clientData']['clientLevel'];

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

  <p>Add a new category of products below.</p>

  <!-- message handling -->
  <?php if (isset($message)) {echo $message;} ?>
  <form method="post" action="/acme/products/index.php" class="stacked-form">
    <label for="categoryName">New category name</label>
    <input <?php if(isset($categoryName)){echo "value='$categoryName'";} ?>
           id="categoryName"
           name="categoryName"
           placeholder="Enter a name for the new category"
           required
           type="text" >
    <input class="button"
           id="categoryButton"
           name="submit"
           type="submit"
           value="Add category" >
    <input name="action"
           type="hidden"
           value="newCategory" >
  </form>



</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
