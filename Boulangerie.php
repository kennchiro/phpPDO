<?php

include('redirect.php');

 ?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Agency Template</title>


<link rel="stylesheet" href="css/bootstrap.css">

	<style type="text/css">
		.sub1{
			margin-top: -100px;
		}
		.carousel-control{
			  background: rgba(0,0,0, .5);
			  box-sizing: border-box;
		}
		
		#sub1,#sub2,#sub3,#sub4,#sub5,#sub6{
			height: 40px;
			width: 120px;
			border-radius: 19px;
			background:rgba(185,185,185,1.00);
		}
		
		#boul{
			padding-left: 153px;
			font-size: 20px;
			color: goldenrod;
	   
		}
	
	</style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#">Bakery</a></div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<img class="img-circle" alt="140x140" style="width:80px; height: 50px;" src="Photos/Boulangerie.png" data-holder-rendered="true"> <a id="boul">GESTION DE BOULANGERIE</a>
      <ul class="nav navbar-nav">
        <li class="active"> </li>
        <li> </li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li> </li>
        <li class="dropdown">
<ul class="dropdown-menu">
            <li><a href="#">Action</a> </li>
            <li><a href="#">Another action</a> </li>
            <li><a href="#">Something else here</a> </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<!-- HEADER -->
<header>
  <div id="carousel1" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel1" data-slide-to="0" class="active"></li>
      <li data-target="#carousel1" data-slide-to="1"></li>
      <li data-target="#carousel1" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active"><img src="Photos/bl4.jpg" alt="First slide image" width="1000" height="484" class="center-block">
        <div class="carousel-caption">
          <h3>Nos produits actuels</h3>
          <p>1</p>
        </div>
      </div>
      <div class="item"><img src="Photos/bl3.jpg" alt="Second slide image" width="1000" height="520" class="center-block">
        <div class="carousel-caption">
          <h3>Des differents produits</h3>
          <p>2 </p>
        </div>
      </div>
      <div class="item"><img src="Photos/bl5.jpg" alt="Third slide image" width="940" height="654" class="center-block">
        <div class="carousel-caption">
          <h3>100% de produit naturel </h3>
          <p>3</p>
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
</header>
<!-- / HEADER --> 

<!--  SECTION-1 -->
<p></p>
	<p></p>
	
<section>
<div class="container ">
    <div class="row">
		
      <div class="col-lg-4 col-sm-12 text-center"> <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="Photos/images (1).jpg" data-holder-rendered="true">
       <form action="" method="POST">
		<p></p>  <input type="submit" value="Client" name="client" id="sub1">
	   </form> 
        <p>Liste des Clients avec des actions praticable.</p>
      </div>
		
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="Photos/produit.jpg" data-holder-rendered="true">
		 <form method="POST" action="">
       <p></p> <input type="submit" value="Produit" name="produit" id="sub2">
		 </form>
        <p>Liste des produits avec des actions praticable.</p>
      </div>
		
		
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px; background: transparent;" src="Photos/commande.png" data-holder-rendered="true">
		 <form method="POST" action="">
       <p></p> <input type="submit" value="Commande" name="commande" id="sub3">
		  </form>
        <p>Liste des Commandes avec des actions praticable.</p>
      </div>
		
		
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="Photos/vente.png" data-holder-rendered="true">
		 <form method="POST" action="">
        <p></p> <input type="submit" value="Vente et Facture" name="vente_facture" id="sub4">
		 </form>
        <p>Liste des ventes au produit.</p>
      </div>
		
		
      <div class="col-lg-4 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="Photos/service-livraison.jpg" data-holder-rendered="true">
	 <form action="" method="POST">
      <p></p> <input type="submit" value="Livraison" name="livraison" id="sub5">
	 </form>
  <p>Liste des livraisons avec des actions praticable.</p>
      </div>
		
	<div class="col-lg-4 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="Photos/Actions-list-add-icon.png" data-holder-rendered="true">
	 <form action="" method="POST">
      <p></p> <input type="submit" value="Voir plus" name="voir_plus" id="sub6">
	 </form>
  <p>Bientot...</p>
      </div>
</div>
    <div class="row">
      <div class="col-lg-12 page-header text-center">
      <img class="img-circle" alt="140x140" style="width:50px; height: 50px;" src="Photos/localisation.png" data-holder-rendered="true">  <h2>FIANARANTSOA 301</h2>
      </div>
    </div>
</div>
<!-- /container -->  <!-- / CONTAINER--> 
</section>
<!-- FOOTER -->
<div class="container"> </div>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © Kenchiro. Tout est bien claire.</p>
      </div>
    </div>
  </div>
</footer>
<!-- / FOOTER --> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
