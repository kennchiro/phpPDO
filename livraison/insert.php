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
    INSERT INTO `crud`.`livraison` (`id`, `numliv`, `numcom`, `dateliv`, `prixliv`, `nomlivreur`, `nomcli`, `image`) 
    VALUES (NULL, :numliv, :numcom, :dateliv,  :prixliv, :nomlivreur, :nomcli, :image);
  ");
  $result = $statement->execute(
   array(
    ':numliv' => $_POST["numliv"],
    ':numcom'  => $_POST["numcom"],
    ':dateliv'    => $_POST["dateliv"],
    ':prixliv' => $_POST["prixliv"],
    ':nomlivreur' => $_POST["nomlivreur"],
    ':nomcli' => $_POST["nomcli"],
    ':image'  => $image
   )
  );
  if(!empty($result))
  {
   echo 'Data bien inserer !!';
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
  "UPDATE livraison 
   SET numliv = :numliv, numcom = :numcom, dateliv = :dateliv, prixliv = :prixliv, nomlivreur = :nomlivreur, nomcli = :nomcli, image= :image 
   WHERE id = :id 
   "
  );
  $result = $statement->execute(
   array(
    ':numliv'  => $_POST["numliv"],
    ':numcom'  => $_POST["numcom"],
    ':dateliv'    => $_POST["dateliv"],
    ':prixliv' => $_POST["prixliv"],
    ':nomlivreur' => $_POST["nomlivreur"],
    ':nomcli' => $_POST["nomcli"],
    ':image'  => $image,
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Modification avec succes';
  }
 }
}

?>