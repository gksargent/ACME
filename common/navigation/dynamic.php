<nav>
    <?php
    if ($pageTitle == 'Oopsies. Something wonky happened.') {
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation/static.php';
    } elseif ($pageTitle == 'Template Page'){
      include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation/static.php';
    } else {
      echo dynamicNavigation();
    }
     ?>
  </nav>
