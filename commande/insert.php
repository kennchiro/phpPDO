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
    INSERT INTO `crud`.`commande` (`id`, `numcom`, `numero`, `datecom`, `comre`, `comli`, `refprod`, `qte`, `image`) VALUES (NULL, :numcom, :numero, :datecom,  :comre, :comli, :refprod, :qte, :image);
  ");
  $result = $statement->execute(
   array(
    ':numcom' => $_POST["numcom"],
    ':numero'  => $_POST["numero"],
    ':datecom'    => $_POST["datecom"],
    ':comre' => $_POST["comre"],
    ':comli' => $_POST["comli"],
    ':refprod' => $_POST["refprod"],
    ':qte' => $_POST["qte"],
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
   "UPDATE commande
   SET numcom = :numcom, numero = :numero, datecom = :datecom , comre = :comre , comli = :comli , refprod = :refprod , qte = :qte , image = :image
   WHERE id = :id 
   "
  );
  $result = $statement->execute(
   array(
     ':numcom'  => $_POST["numcom"],
    ':numero'  => $_POST["numero"],
    ':datecom'    => $_POST["datecom"],
    ':comre' => $_POST["comre"],
    ':comli' => $_POST["comli"],
    ':refprod' => $_POST["refprod"],
    ':qte' => $_POST["qte"],
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