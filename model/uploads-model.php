<?php

//model for the product image upload process

/*
There are several steps to successfully upload an image:
1. add image info to the database table
2. store the full size image info
3. generate and store thumbnail image info
 */


//step 1: add image info to the database table
function storeImages($imgPath, $invId, $imgName) {
  $db = acmeConnect();
  $sql = 'INSERT INTO images (invId, imgPath, imgName) VALUES (:invId, :imgPath, :imgName)';
  $stmt = $db->prepare($sql);

  //step 2: store the full size image info
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
  $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
  $stmt->execute();

  //step 3: generate and store thumbnail image info
  $imgPath = makeThumbnailName($imgPath); //change name in path
  $imgName = makeThumbnailName($imgName); //change name in file name
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
  $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
  $stmt->execute();

  //check for changes
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}




//==============================================================================
//=================== return all thumbnails matching a product id ==============
//==============================================================================

function getProductThumbnails($invId) {
  $db = acmeConnect();
  $sql = 'SELECT * FROM images WHERE invId = :invId ORDER BY imgName';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $productThumbnails = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $productThumbnails;
}


function getAllProductThumbnails($invId) {
  $db = acmeConnect();
  $sql = 'SELECT imgId, imgPath, imgName, imgDate FROM images WHERE imgName LIKE "%-tn%" AND invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $productThumbnails = $stmt->fetchAll(PDO::FETCH_NAMED);
  $stmt->closeCursor();
  return $productThumbnails;
}






?>
