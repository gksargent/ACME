<?php
//this is the model for user accounts


//==================== this handles site registrations =======================
function registerClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
}
//============================================================================
//===========================================================================


//============================================================================
//====================== check for existing email address ====================
//============================================================================

function checkExistingEmail($clientEmail){
  $db = acmeConnect();
  $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();

  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();

  if(empty($matchEmail)){
    return 0;
  } else {
    return 1;
  }
}

//============================================================================
//============================================================================



//============================================================================
//================ get client data based on an email address =================
//============================================================================

function getClient($clientEmail){
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}




//============================================================================
//================ get client data based on a clientId =================
//============================================================================

function getClientId($clientId){
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}





//==================== this updates client account info =====================
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
}
//================================================================================================






//==================== this updates client password =====================
function updatePassword($clientPassword, $clientId){
  $db = acmeConnect();

  //this creates placeholders that the bindValue replaces with actual data
  $sql = 'UPDATE clients SET clientPassword = :hashedPassword WHERE clientId = :clientId';

  $stmt = $db->prepare($sql);
  $stmt->bindValue(':hashedPassword', $clientPassword, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

  //this runs the statements above and inserts the data into the database
  $stmt->execute();

  //this checks to see how many rows were added as a result of the above statements
  $rowsChanged = $stmt->rowCount();

  //this closes the interaction between the function and the database server
  $stmt->closeCursor();

  //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
  return $rowsChanged;
}
//================================================================================================
 ?>
