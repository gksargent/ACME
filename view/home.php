<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'home';
$pageTitle = 'Welcome to Acme';
$pageDescription = "One stop shop for all things roadrunner cuisine.";

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

  <div id="banner">
    <div class="banner-text-right">
      <h2>Acme Rocket</h2>
      <ul>
        <li>Quick lighting fuse</li>
        <li>NHTSA approved seat belts</li>
        <li>Mobile launch stand included</li>
      </ul>
      <a href="#" class="button">I Want It Now!</a>
    </div><!-- end banner-text-right -->
  </div><!-- end banner -->

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
