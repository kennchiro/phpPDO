
<html>
 <head>
  <title>VENTE</title>
	 
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

   #button{
    border-radius: 5px;
    background-color: darkgoldenrod;
    color: black;
    border: none;
    margin-top: 4px;
   }
  </style>
 </head>
 <body>
  <div class="container box">
	<div class="im"><a><img  style="width:150px; height: 100px; padding-right: 45" src="../Photos/Shopping Cart Loaded_96px.png" data-holder-rendered="true"></a></div>
   <h1>VENTE</h1> <div class="im"><a><img  style="width:150px; height: 100px;float: right; padding-right: 45 ; margin-top: -168px; margin-right: -45px;" src="../Photos/Cash in Hand_96px.png" data-holder-rendered="true"></a></div>
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
	    <th width="10%">Numero de facture</th>
       <th width="10%">Date de facture</th>
       <th width="10%">Reference de produit</th>
       <th width="10%">Libele</th>
       <th width="10%">Prix de vente</th>
       <th width="10%">Stock sortie</th>
       <th width="10%">SubTotal</th>
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
     <h4 class="modal-title">Ajouter nouveau livraison</h4>
    </div>
    <div class="modal-body">
		
	  <label>Numero de la facture</label>
     <input type="text" name="numfac" id="numfac" class="form-control" />
     <br /> 
   
     <label>Date de facture</label>
     <input type="date" name="datefac" id="datefac" class="form-control" />
     <br />
    
     <label>Reference de produit</label>
     <input type="text" name="refprod" id="refprod" class="form-control" />
     <br />

     <label>Libele</label>
     <input type="text" name="libele" id="libele" class="form-control" />
     <br />

     <label>Prix de vente</label>
     <input type="text" name="prix_vente" id="prix_vente" class="form-control" />
     <br />

     <label>Stock sortie</label>
     <input type="text" name="stock_sortie" id="stock_sortie" class="form-control" />
     <br />

     <label>SubTotal</label>
     <input type="text" name="subtotal" id="subtotal" class="form-control" />
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

</script>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('#add_button').click(function(){
  $('#user_form')[0].reset();
  $('.modal-title').text("Ajouter de nouveau vente");
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
  var Numfac = $('#numfac').val();
  var Datefac = $('#datefac').val();
  var Refprod  = $('#refprod').val();
  var Libele = $('#libele').val();
  var Prix_vente = $('#prix_vente').val();
  var Stock_sortie = $('#stock_sortie').val();
  var Subtotal = $('#subtotal').val() ;

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
  if(Numfac != ''&& Datefac != '' && Refprod != ''&&  Libele != '' && Prix_vente != '' && Stock_sortie != '' && Subtotal != '')
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
    $('#numfac').val(data.numfac);
    $('#datefac').val(data.datefac);
    $('#refprod').val(data.refprod);
    $('#libele').val(data.libele);
    $('#prix_vente').val(data.prix_vente);
    $('#stock_sortie').val(data.stock_sortie);
    $('#subtotal').val(data.subtotal);

    $('.modal-title').text("Modifier la livraison");
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
