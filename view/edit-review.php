<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'admin';
$pageTitle = "Admin Tools | Acme, Inc";
$pageDescription = "Update ACME products here.";
$clientLevel = $_SESSION['clientData']['clientLevel'];
$reviewText = $reviewDetails['reviewText'];

if ($_SESSION['clientData']['clientLevel'] < 1) {
 header('location: /acme/');
 exit;
}

$reviewDetails = getReview($reviewId);

?>

<!DOCTYPE html>
<html lang="en-US">
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/author-statement.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/head.php"; ?>
<body>
<div id="container">

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/header.php"; ?>

<main>


  <h1>Update Review</h1>

  <p><a href="/acme/accounts/">&#8592; Back</a></p>
  <form method="post" action="/acme/reviews/index.php" class="stacked-form">
    <label for="reviewText">Review Content</label>
    <textarea cols="50"
              id="reviewText"
              name="reviewText"
              required
              rows="5"><?php if(isset($reviewText)){echo $reviewText;} ?></textarea>
  <br>
  <input class="button"
         id="formButton"
         name="submit"
         type="submit"
         value="Save Edits">
  <input name="action"
         type="hidden"
         value="process-edit-review">
  <input name="reviewId"
         type="hidden"
         value="<?php if (isset($reviewId)) { echo $reviewId;} ?>">
  <input name="clientId"
         type="hidden"
         value="<?php if (isset($clientId)) { echo $clientId;} ?>">
  <input name="invId"
         type="hidden"
         value=<?php echo "$reviewDetails[invId]" ?>>
</form>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
