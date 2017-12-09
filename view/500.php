<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'error';
$pageTitle = 'Oopsies. Something wonky happened.';
$pageDescription = "Something wonky happened, sorry about that.";

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

  <p>Sorry about that. Hit the back arrow to try again, or check out another part of the site for a few minutes.</p>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
