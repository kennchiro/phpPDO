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
    INSERT INTO `crud`.`vente` (`id`, `numfac`, `datefac`, `refprod`, `libele`, `prix_vente`, `stock_sortie`,  `subtotal`, `image`) 
    VALUES (NULL, :numfac, :datefac, :refprod,  :libele, :prix_vente, :stock_sortie,  :subtotal, :image);
  ");
  $result = $statement->execute(
   array(
    ':numfac' => $_POST["numfac"],
    ':datefac'  => $_POST["datefac"],
    ':refprod'    => $_POST["refprod"],
    ':libele' => $_POST["libele"],
    ':prix_vente' => $_POST["prix_vente"],
    ':stock_sortie' => $_POST["stock_sortie"],
    ':subtotal' => $_POST["subtotal"],
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
  "UPDATE vente 
   SET numfac = :numfac, datefac = :datefac, refprod = :refprod, libele = :libele, prix_vente = :prix_vente,  stock_sortie = :stock_sortie, subtotal = :subtotal, image= :image 
   WHERE id = :id 
   "
  );
  $result = $statement->execute(
   array(
    ':numfac'  => $_POST["numfac"],
    ':datefac'  => $_POST["datefac"],
    ':refprod'    => $_POST["refprod"],
    ':libele' => $_POST["libele"],
    ':prix_vente' => $_POST["prix_vente"],
    ':stock_sortie' => $_POST["stock_sortie"],
    ':subtotal' => $_POST["subtotal"],
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