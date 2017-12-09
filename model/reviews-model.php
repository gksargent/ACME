<?php

//model for the reviews CRUD process

/*
functions needed:
  1. add a new review
  2. get reviews for a specific inventory item
  3. get reviews written by a specific user
  4. get a specific review
  5. update a specific review
  6. delete a specific review
*/

//==============================================================================
//============================== add new review ================================
//==============================================================================

function newReview($reviewText, $invId, $clientId){
  $db = acmeConnect();
  $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}




//==============================================================================
//================ get reviews for a specific inventory item ===================
//==============================================================================

function getItemReviews($invId) {
  $db = acmeConnect();
  $sql = 'SELECT r.*, c.* FROM reviews r INNER JOIN clients c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY reviewDate DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}




//==============================================================================
//================== get reviews written by a specific user ====================
//==============================================================================

function getClientReviews($clientId) {
  $db = acmeConnect();
  $sql = 'SELECT * FROM reviews WHERE clientId = :clientId ORDER BY reviewDate DESC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();

  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $reviews;
}





//==============================================================================
//========================== get a specific review =============================
//==============================================================================

function getReview($reviewId) {
  $db = acmeConnect();
  $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId ORDER BY reviewDate ASC';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();

  $review = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();

  return $review;
}





//==============================================================================
//======================== update a specific review ============================
//==============================================================================

function updateReview($reviewText, $clientId, $invId, $reviewId) {
  $db = acmeConnect();
  $sql = 'UPDATE reviews SET reviewText = :reviewText, clientId = :clientId, invId = :invId WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}





//==============================================================================
//======================== delete a specific review ============================
//==============================================================================

function deleteReview(); {
  $db = acmeConnect();
  $sql = 'DELETE * FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  return $rowsChanged;
}
?>
