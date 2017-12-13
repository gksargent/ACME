<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

if(!$_SESSION['loggedin']){
  header('Location: /acme/');
}

if(isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}

$clientFirstname = $_SESSION['clientData']['clientFirstname'];
$clientLastname = $_SESSION['clientData']['clientLastname'];
$clientEmail = $_SESSION['clientData']['clientEmail'];
$clientPassword = $_SESSION['clientData']['clientPassword'];
$clientLevel = $_SESSION['clientData']['clientLevel'];

//Other variables and statements
$directoryName = 'accounts';
$pageTitle = 'My ACME Account';
$pageDescription = "Manage your account with ACME.";
$message = $_SESSION['message'];
?>

<!DOCTYPE html>
<html lang="en-US">
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/author-statement.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/head.php"; ?>
<body>
<div id="container">

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/header.php"; ?>

<main>

  <h1><?php echo "$clientFirstname $clientLastname";?></h1>
  <?php if (isset($message)) {echo $message;} ?>
  <?php if (isset($passwordMessage)) {echo $passwordMessage;} ?>
  <p>You are logged in! Here are your account details:</p>
  <ul class="no-bullets">
    <li>First name: <strong><?php echo $clientFirstname; ?></strong></li>
    <li>Last name: <strong><?php echo $clientLastname; ?></strong></li>
    <li>Email: <strong><?php echo $clientEmail; ?></strong></li>


  </ul>
  <a class="inline-link-group" href="/acme/accounts/index.php?action=update">Update Account Information</a>
  <hr>
  <h2>Your product reviews</h2>
  <?php
    if (isset($reviewList)) {
      echo $reviewList;
    } else {echo "You haven't reviewed any products yet. When you do, they'll show up right here.";}
  ?>


   <?php
     if($clientLevel > 1){
       echo '<hr />
             <h2>Admin Tools</h2>
             <p>To add, edit and delete products, use the link below.</p>
             <p><a class="inline-link-group" href="/acme/products/">Manage Products</a></p>';
     }
    ?>
</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
<?php unset($_SESSION['message']); ?>
