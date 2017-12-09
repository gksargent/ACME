<?php
//this is the model for products


//================================ this handles new categories =====================================
function newCategory($categoryName){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
} //================================================================================================



//================================ this handles new products =======================================
function newProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'INSERT INTO inventory (categoryId, invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, invVendor, invStyle) VALUES (:categoryId, :invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :invVendor, :invStyle)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
  $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
  $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
  $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
  $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
  $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
} //================================================================================================




//============================== this gets all the product details =================================
function getProductBasics() {
  $db = acmeConnect();
  $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $products;
}
//==================================================================================================




//============================= this gets a single product based on id =============================
function getProductInfo($invId){
  $db = acmeConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $productInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $productInfo;
}
//==================================================================================================




//================================ this handles updating products ==================================
function updateProduct($invId, $categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
  $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
  $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
  $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
  $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
  $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
} //================================================================================================




//================================ this handles deleting products ==================================
function deleteProduct($invId){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'DELETE FROM inventory WHERE invId = :invId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
} //================================================================================================




//================== this handles getting a list of products based on category =====================
function getProductsByCategory($type){
  $db = acmeConnect();
  $sql = 'SELECT * FROM inventory WHERE categoryId IN (
              SELECT categoryId FROM categories WHERE categoryName = :categoryId)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':categoryId', $type, PDO::PARAM_STR);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $products;
} //================================================================================================

?>
