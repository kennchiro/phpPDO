<?php

// Pour le boutton client 
if(isset($_POST["client"]))
{

	?>

<script type="text/javascript">
window.location = "client/client.php";
</script>

	<?php
 
}


// Pour le boutton produit 
if(isset($_POST["produit"]))
{

	?>

<script type="text/javascript">
window.location = "produit/produit.php";
</script>

	<?php
 
}


// Pour le boutton commande
if(isset($_POST["commande"]))
{

	?>

<script type="text/javascript">
window.location = "commande/commande.php";
</script>

	<?php
 
}



// Pour le boutton vente et facture
if(isset($_POST["vente_facture"]))
{

	?>

<script type="text/javascript">
window.location = "Vente_Facture/vente.php";
</script>

	<?php
 
}



// Pour le boutton livraison
if(isset($_POST["livraison"]))
{

	?>

<script type="text/javascript">
window.location = "livraison/livraison.php";
</script>

	<?php
 
}



// Pour le boutton voir plus
if(isset($_POST["voir_plus"]))
{

	?>

<script type="text/javascript">
 alert("Bientot!!");
</script>

	<?php
 
}

 ?>