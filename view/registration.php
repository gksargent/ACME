<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'accounts';
$pageTitle = 'Create an ACME account';
$pageDescription = "Create an ACME account to begin being awesome.";

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

  <p>Enter your information below to create a new ACME account.</p>
  <p>Already have an account? <a href="/acme/accounts/index.php?action=login">Login</a></p>

  <!--the next line is used to display any errors-->
  <?php if (isset($message)) {echo $message;}?>
  <form method="post" action="/acme/accounts/index.php" class="stacked-form">
    <label for="clientFirstname">First Name</label>
    <input <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>
           id="clientFirstname"
           maxlength="15"
           name="clientFirstname"
           placeholder="Enter your first name"
           required
           type="text">

    <label for="clientLastname">Last Name</label>
    <input <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>
           id="clientLastname"
           maxlength="25"
           name="clientLastname"
           placeholder="Enter your last name"
           required
           type="text">

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

    <input type="submit" name="submit" id="registerButton" value="Register" class="button">
    <input type="hidden" name="action" value="register-form">
  </form>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
