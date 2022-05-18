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
    INSERT INTO `crud`.`produit` (`id`, `refprod`, `libele`, `prix`, `datefab`, `dateder`, `stock`, `image`) VALUES (NULL, :refprod, :libele, :prix,  :datefab, :dateder, :stock, :image);
  ");
  $result = $statement->execute(
   array(
    ':refprod' => $_POST["refprod"],
    ':libele'  => $_POST["libele"],
    ':prix'    => $_POST["prix"],
    ':datefab' => $_POST["datefab"],
    ':dateder' => $_POST["dateder"],
    ':stock' => $_POST["stock"],
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
   "UPDATE produit
   SET refprod = :refprod, libele = :libele, prix = :prix , datefab = :datefab , dateder = :dateder , stock = :stock , image = :image
   WHERE id = :id 
   "
  );
  $result = $statement->execute(
   array(
     ':refprod'  => $_POST["refprod"],
    ':libele'  => $_POST["libele"],
    ':prix'    => $_POST["prix"],
    ':datefab' => $_POST["datefab"],
    ':dateder' => $_POST["dateder"],
    ':stock' => $_POST["stock"],
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