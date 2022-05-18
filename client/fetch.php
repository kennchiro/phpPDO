<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM users ";
if(isset($_POST["search"]["value"]))
{
 $query .= 'WHERE numero LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR nom LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR prenom LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR adresse LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR telephone LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 $image = '';
 if($row["image"] != '')
 {
  $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
 }
 else
 {
  $image = '';
 }
 $sub_array = array();
 $sub_array[] = $image;
 $sub_array[] = $row["numero"];
 $sub_array[] = $row["nom"];
 $sub_array[] = $row["prenom"];
 $sub_array[] = $row["adresse"];
 $sub_array[] = $row["telephone"];
 $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Modifier</button>';
 $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Supprimer</button>';
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>
