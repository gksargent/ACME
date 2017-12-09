<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";

//Other variables and statements
$directoryName = 'accounts';
$pageTitle = 'Update Account';
$pageDescription = "Update your ACME account information here.";

if(!$_SESSION['loggedin']){
  header('Location: /acme/accounts/');
}


$clientFirstname = $_SESSION['clientData']['clientFirstname'];
$clientLastname = $_SESSION['clientData']['clientLastname'];
$clientEmail = $_SESSION['clientData']['clientEmail'];
$clientPassword = $_SESSION['clientData']['clientPassword'];
$clientId = $_SESSION['clientData']['clientId'];
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
    <p><a href="/acme/accounts/">&#8592; Back to account</a></p>
    <section>
      <h2>Update name &amp; email</h2>
      <?php if (isset($message)) {echo $message;} ?>
      <form method="post" action="/acme/accounts/" class="stacked-form">
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

        <input class="button"
               id="updateClientInfoButton"
               name="submit"
               type="submit"
               value="Update my info" >

        <input name="clientId"
               type="hidden"
                value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">

        <input name="action"
               type="hidden"
               value="updateClientInfo" >
      </form>
    </section>
    <hr />
    <section>
      <h2>Change password</h2>
      <?php if (isset($passwordMessage)) {echo $passwordMessage;} ?>
      <form method="post" action="/acme/accounts/" class="stacked-form">
        <label for="clientPassword">New Password</label>
        <input id="clientPassword"
               name="clientPassword"
               pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
               placeholder="Enter a new password"
               required
               type="password">
        <span class="input-help-text">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>

        <input class="button"
               id="updateClientPasswordButton"
               name="submit"
               type="submit"
               value="Update my password" >
        <span class="input-help-text"><strong>Note: </strong>Submitting this form will change your password!</span>

        <input name="clientId"
               type="hidden"
                value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">

        <input name="action"
               type="hidden"
               value="updateClientPassword" >
      </form>
    </section>

</main>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/footer.php"; ?>

</div><!-- end container -->
</body>
</html>
