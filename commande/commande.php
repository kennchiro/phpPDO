
<html>
 <head>
  <title>COMMANDE!!!</title>
	 
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
   <h1>TOUTES COMMANDES </h1>
   <br />
	  
	  <img  style="width:160px; height: 150px;" src="../Photos/Montpellier-boulangerie-016.png" data-holder-rendered="true"> <img  style="width:160px; height: 150px;" src="../Photos/corsi-di-panificazione.jpg" data-holder-rendered="true"> <img  style="width:160px; height: 150px;" src="../Photos/BAGUETTE-CAMPAGNE_rt-825x510.png" data-holder-rendered="true">
	  
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
	    <th width="10%">Numero de commande</th>
       <th width="10%">Numero de client</th>
       <th width="10%">Date de commande</th>
       <th width="10%">Commande regle</th>
       <th width="10%">Commande a livrer</th>
       <th width="10%">Reference de produit</th>
       <th width="10%">Quantite</th>
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
		
	  <label>Numero de commande</label>
     <input type="text" name="numcom" id="numcom" class="form-control" />
     <br /> 
   
     <label>Numero de client</label>
     <input type="text" name="numero" id="numero" class="form-control" />
     <br />
    
     <label>Date de commande</label>
     <input type="date" name="datecom" id="datecom" class="form-control" />
     <br />

     <label>Commande a regle</label>
     <input type="text" name="comre" id="comre" class="form-control" />
     <br />

     <label>commande a livre </label>
     <input type="text" name="comli" id="comli" class="form-control" />
     <br />

     <label>Reference de produit</label>
     <input type="text" name="refprod" id="refprod" class="form-control" />
     <br />

     <label>Quantite</label>
     <input type="text" name="qte" id="qte" class="form-control" />
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
  $('.modal-title').text("Ajouter commande");
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
  var Numcom = $('#numcom').val();
  var Numcli = $('#numero').val();
  var Datecom  = $('#datecom').val();
  var Comre = $('#comre').val();
  var Comli = $('#comli').val();
  var Ref = $('#refprod').val();
  var Qte = $('#qte').val();
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
  if(Numcom != ''&& Numcli != '' && Datecom != ''&&  Comre != '' && Comli != '' && Ref != '' && Qte != '')
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
    $('#numcom').val(data.numcom);
    $('#numero').val(data.numero);
    $('#datecom').val(data.datecom);
    $('#comre').val(data.comre);
    $('#comli').val(data.comli);
    $('#refprod').val(data.refprod);
    $('#qte').val(data.qte);

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
