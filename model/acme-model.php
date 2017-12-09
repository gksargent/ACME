<?php
function getCategories(){
  $db = acmeConnect();
  $sql = 'SELECT * FROM categories ORDER BY categoryName ASC';
  $stmt = $db->prepare($sql);

  $stmt->execute();
  $categories = $stmt->fetchAll();
  $stmt->closeCursor();

  return $categories;
}
 ?>
