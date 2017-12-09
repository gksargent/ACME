<?php
$clientFirstname = $_SESSION['clientData']['clientFirstname'];

?>

<header>

  <div id="header-top">
    <img src="/acme/images/site/logo.gif" alt="ACME logo" />
    <div class='top-links'>
    <?php
    if ($_SESSION['loggedin'] == FALSE) {
      echo '<a href="/acme/accounts/index.php?action=login" title="Manage your account here" class="account-link">My Account</a>';
    } else {
      echo "<a href='/acme/accounts' title='Go to account management options' class='account-link'>Welcome $clientFirstname!</a> | <a href='/acme/accounts/index.php?action=logout' title='Logout of your ACME account and return to the home page.' class='logout-link'>Logout</a>";
    }

    ?>
  </div>
  </div>

  <?php include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/navigation/dynamic.php"; ?>

</header>
