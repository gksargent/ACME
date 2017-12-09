<?php
include_once $_SERVER['DOCUMENT_ROOT']."/acme/common/base-variables-functions.php";


$productDisplay = buildProductsDisplay($products);

echo $productDisplay;


 ?>
