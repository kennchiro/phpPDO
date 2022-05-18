<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $image = '';
  if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();
  }
  $statement = $connection->prepare("
   INSERT INTO `crud`.`users` (`id`, `numero`, `nom`, `prenom`, `adresse`, `telephone`, `image`) VALUES (NULL, :numero,:nom ,:prenom 
    , :adresse , :telephone , :image);
  ");
  $result = $statement->execute(
   array(
    ':numero' => $_POST["numero"],
    ':nom' => $_POST["nom"],
	  ':prenom' => $_POST["prenom"],
    ':adresse' => $_POST["adresse"],
    ':telephone' => $_POST["telephone"],
    ':image'  => $image
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {
  $image = '';
  if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();
  }
  else
  {
   $image = $_POST["hidden_user_image"];
  }
  $statement = $connection->prepare(
   "UPDATE users
   SET numero = :numero, nom = :nom, prenom = :prenom , adresse = :adresse , telephone = :telephone ,  image = :image
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':numero' => $_POST["numero"],
    ':nom' => $_POST["nom"],
	  ':prenom' => $_POST["prenom"],
    ':adresse' => $_POST["adresse"],
    ':telephone' => $_POST["telephone"],
    ':image'  => $image,
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>