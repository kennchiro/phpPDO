<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM commande
  WHERE id = '".$_POST["user_id"]."'
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
 $output["numcom"]  = $row["numcom"];
  $output["numero"]  = $row["numero"];
  $output["datecom"]    = $row["datecom"];
  $output["comre"] = $row["comre"];
  $output["comli"] = $row["comli"];
  $output["refprod"] = $row["refprod"];
  $output["qte"] = $row["qte"];
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