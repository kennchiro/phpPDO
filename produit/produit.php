
<html>
 <head>
  <title>PRODUIT</title>
	 
  <script src="jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" />
  <script src="jquery.dataTables.min.js"></script>
  <script src="dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="dataTables.bootstrap.min.css" />
  <script src="bootstrap.min.js"></script>
	 
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:rgb(32,33,35);
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }

	  .contenaire,.box{
		  background-image: url(../Photos/camusette_campagne_rt3-825x510.png);
		  background-attachment: scroll;
		  background-blend-mode: darken;
		  background-position :bottom;
		  background-repeat: no-repeat;
	  }
	  
  </style>
 </head>
 <body>
  <div class="container box">
   <h1>PRODUIT</h1>
   <br />
   <div class="table-responsive">
    <br />
    <div align="right">
     <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Ajouter</button>
    </div>
    <br /><br />

    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="10%">Image</th>
	    <th width="10%">Reference produit</th>
       <th width="10%">Libele</th>
       <th width="10%">Prix Unitaire</th>
       <th width="10%">Date de fabrication</th>
       <th width="10%">Date dernier</th>
       <th width="10%">Stock</th>
       <th width="10%">Modifier</th>
       <th width="10%">Supprimer</th>
      </tr>
     </thead>
    </table>

   </div>
  </div>
 </body>
</html>

<div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Ajouter Produit</h4>
    </div>
    <div class="modal-body">
		
	  <label>Reference de produit</label>
     <input type="text" name="refprod" id="refprod" class="form-control"  />
     <br /> 
   
     <label>Libele</label>
     <input type="text" name="libele" id="libele" class="form-control" />
     <br />
    
     <label>Prix Unitaire</label>
     <input type="text" name="prix" id="prix" class="form-control"  />
     <br />

     <label>Date de fabrication</label>
     <input type="date" name="datefab" id="datefab" class="form-control" />
     <br />

     <label>Date dernier</label>
     <input type="date" name="dateder" id="dateder" class="form-control" />
     <br />

     <label>Stock</label>
     <input type="text" name="stock" id="stock" class="form-control"   />
     <br />

     <label>Selectioner votre profile</label>
     <input type="file" name="user_image" id="user_image" />
		
     <span id="user_uploaded_image"></span>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="user_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Ajouter" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
    </div>
   </div>
  </form>
 </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 $('#add_button').click(function(){

  $('#user_form')[0].reset();
  $('.modal-title').text("Ajouter Produit");
  $('#action').val("Add");
  $('#operation').val("Add");
  $('#user_uploaded_image').html('');
  
 });

 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[0, 6, 7],
    "orderable":false,
   },
  ],

 });

 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var Ref = $('#refprod').val();
  var Libele = $('#libele').val();
  var Prix  = $('#prix').val();
  var Datefab = $('#datefab').val();
  var Dateder = $('#dateder').val();
  var Stock = $('#stock').val();
  var extension = $('#user_image').val().split('.').pop().toLowerCase();
  if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalide Image File");
    $('#user_image').val('');
    return false;
   }
  }
  if(Ref != ''&& Libele != '' && Prix != ''&&  Datefab != '' && Dateder != '' && Stock != '')
  {
   $.ajax({
    url:"insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_form')[0].reset();
     $('#userModal').modal('hide');
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   alert("Vous devrez completer tous les champs!!");
  }
 });

 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    $('#userModal').modal('show');
    $('#refprod').val(data.refprod);
    $('#libele').val(data.libele);
    $('#prix').val(data.prix);
    $('#datefab').val(data.datefab);
    $('#dateder').val(data.dateder);
    $('#Stock').val(data.Stock);

    $('.modal-title').text("Modifier commande");
    $('#user_id').val(user_id);
    $('#user_uploaded_image').html(data.user_image);
    $('#action').val("Edit");
    $('#operation').val("Edit");
   }
  })
 });

 $(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
  if(confirm("Etes vous sur de supprimer ceci ?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{user_id:user_id},
    success:function(data)
    {
     alert(data);
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   return false;
  }
 });


});
</script>
