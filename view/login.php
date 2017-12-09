<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'accounts';
$pageTitle = 'Login to ACME';
$pageDescription = "Login to your ACME account.";
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

  <p>Enter your email and password below to login.</p>


  <!--the next line is used to display any errors-->
  <?php if (isset($message)) {echo $message;}?>
  <form method="post" action="/acme/accounts/"  class="stacked-form">

    <label for="clientEmail">Email</label>
    <input <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?>
           id="clientEmail"
           name="clientEmail"
           placeholder="Enter your email address"
           required
           type="email">
    <label for="clientPassword">Password</label>
    <input id="clientPassword"
           name="clientPassword"
           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
           placeholder="Enter your password"
           required
           type="password">
    <span class="input-help-text">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>

    <button class="button" type="submit" value="Login">Login</button>
    <input type="hidden" name="action" value="login-form">
  </form>
  <p>Need to create an account? <a href="/acme/accounts/index.php?action=register">Sign up now</a></p>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
