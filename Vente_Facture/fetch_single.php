<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM vente
  WHERE id = '".$_POST["user_id"]."'
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["numfac"]  = $row["numfac"];
  $output["datefac"]  = $row["datefac"];
  $output["refprod"]    = $row["refprod"];
  $output["libele"] = $row["libele"];
  $output["prix_vente"] = $row["prix_vente"];
  $output["stock_sortie"] = $row["stock_sortie"];
  $output["subtotal"] = $row["subtotal"];
  if($row["image"] != '')
  {
   $output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
  }
  else
  {
   $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
  }
 }
 echo json_encode($output);
}
?>