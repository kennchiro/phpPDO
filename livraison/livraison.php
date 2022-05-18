
<html>
 <head>
  <title>LIVRAISON</title>
	 
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
	  
  </style>
 </head>
 <body>
  <div class="container box">
	  
	  <img style="height: 200px ; width: 50% ; margin: 0px auto;" src="../Photos/service-livraison.jpg" data-holder-rendered="true"> 
	  
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
	    <th width="10%">Numero de livraison</th>
       <th width="10%">Numero de commande</th>
       <th width="10%">Date de livraison </th>
       <th width="10%">Prix de livraison</th>
       <th width="10%">Nom de livreur</th>
       <th width="10%">Nom du client</th>
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
		
	  <label>Numero de livraison</label>
     <input type="text" name="numliv" id="numliv" class="form-control" />
     <br /> 
   
     <label>Numero de commande</label>
     <input type="text" name="numcom" id="numcom" class="form-control" />
     <br />
    
     <label>Date de livraison</label>
     <input type="date" name="dateliv" id="dateliv" class="form-control" />
     <br />

     <label>Prix de livraison</label>
     <input type="text" name="prixliv" id="prixliv" class="form-control" />
     <br />

     <label>Nom de livreur</label>
     <input type="text" name="nomlivreur" id="nomlivreur" class="form-control" />
     <br />

     <label>Nom du client</label>
     <input type="text" name="nomcli" id="nomcli" class="form-control" />
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
  $('.modal-title').text("Ajouter de nouveau livraison");
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
  var Numliv = $('#numliv').val();
  var Numcom = $('#numcom').val();
  var Dateliv  = $('#dateliv').val();
  var Prixliv = $('#prixliv').val();
  var Nomlivreur = $('#nomlivreur').val();
  var Nomcli = $('#nomcli').val();
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
  if(Numliv != ''&& Numcom != '' && Dateliv != ''&&  Prixliv != '' && Nomlivreur != '' && Nomcli != '')
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
    $('#numliv').val(data.numliv);
    $('#numcom').val(data.numcom);
    $('#dateliv').val(data.dateliv);
    $('#prixliv').val(data.prixliv);
    $('#nomlivreur').val(data.nomlivreur);
    $('#nomcli').val(data.nomcli);

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
