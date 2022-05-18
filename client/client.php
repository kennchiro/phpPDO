
<html>
 <head>
  <title>CLIENT</title>
	 
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
    background-color: rgb(32,33,35);
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
	  
	 
	  <div class="im"><a><img  style="width:100px; height: 100px; padding-left: 20px;" src="../Photos/images.jpg" data-holder-rendered="true"></a></div>
	  <h1>CLIENT</h1> 
		  
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
	     <th width="10%">Numero</th>
       <th width="10%">Nom</th>
       <th width="10%">Prenom</th>
       <th width="10%">Adresse</th>
       <th width="10%">Telephone</th>
       <th width="10%">Edit</th>
       <th width="10%">Delete</th>
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
     <h4 class="modal-title">Ajouter nouveau Client</h4>
    </div>
    <div class="modal-body">
		
	 <label>votre Numero</label>
     <input type="text" name="numero" id="numero" class="form-control" />
     <br />	
	 
     <label>Votre nom</label>
     <input type="text" name="nom" id="nom" class="form-control" />
     <br />
		
     <label>Votre prenom</label>
     <input type="text" name="prenom" id="prenom" class="form-control" />
     <br />

     <label>Votre adresse</label>
     <input type="text" name="adresse" id="adresse" class="form-control" />
     <br />

      <label>Votre telephone</label>
     <input type="text" name="telephone" id="telephone" class="form-control" />
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
 
 <span class="badge badge-primary">Text</span>
 <span class="badge badge-pill badge-primary">Text</span>
  
 
  

</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 $('#add_button').click(function(){
  $('#user_form')[0].reset();
  $('.modal-title').text("Add User");
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
  var Numero = $('#numero').val();
  var Nom = $('#nom').val();
  var Prenom = $('#prenom').val();
  var Adresse = $('#adresse').val();
  var Telephone = $('#telephone').val();
  var extension = $('#user_image').val().split('.').pop().toLowerCase();
  if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#user_image').val('');
    return false;
   }
  }
  if(Numero != '' && Nom != '' && Prenom != ''&& Adresse != '' && Telephone != '')
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
   alert("Vous devrez remplir toutes les champs!!");
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
    $('#numero').val(data.numero);
    $('#nom').val(data.nom);
    $('#prenom').val(data.prenom);
    $('#adresse').val(data.adresse);
    $('#telephone').val(data.telephone);
    $('.modal-title').text("Edit User");
    $('#user_id').val(user_id);
    $('#user_uploaded_image').html(data.user_image);
    $('#action').val("Edit");
    $('#operation').val("Edit");
   }
  })
 });

 $(document).on('click', '.delete', function(){
  var user_id = $(this).attr("id");
  if(confirm("Etes vous sure de supprimer ceci ?"))
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
