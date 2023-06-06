<?php 
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aerobase";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
} 
?>

<?php 
@$mat=$_GET['Matricule'];
$sql="select * from vol where codevol='$mat'";
$exe=mysqli_query($conn,$sql);
$result=mysqli_fetch_assoc($exe);
if($result){

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>GESTION DES BILLETS D'AVION</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>
<div align="center" >
<h2 align="center">Détail du vol<?php echo" $mat";?></h2>
  <form action="modif.php" method="POST" >
  <table align="center" class="detailtab">
   <tr><td></td><td><input type="hidden" name="" value=" <?php print $mat;?>"></td></tr>
   <tr><td>Date de départ :</td><td><label><?php print ($result['date_depart']); ?></label></td></tr>
   <tr><td>Heure de départ :</td><td><label><?php print ($result['heure_depart']); ?></label></td></tr>
   <tr><td>Ville de destination :</td><td><label><?php print ($result['destination']); ?></label></td></tr>
   <tr><td>Nombre de places en classe A :</td><td><label><?php print ($result['nb_classa']); ?></label></td></tr>
   <tr><td>Nombre de places en classe B :</td><td><label><?php print ($result['nb_classb']); ?></label></td></tr>
   <tr><td>Prix unitaire en classe A :</td><td><label><?php print ($result['prix_classa']); ?> FCFA</label></td></tr>
   <tr><td>Prix unitaire en classe B :</td><td><label><?php print ($result['prix_classb']); ?> FCFA</label></td></tr>
  </table>
  </form>
  
  <?php 
  //classa réservées
       $sql2=mysqli_query($conn,"select count(*)as nbre from passager where choix_class='classe A' and code_vol='$mat' ");
  if($resul=mysqli_fetch_assoc($sql2)){
   $nb=$resul['nbre'];
  echo "Nombre de places réservées en classe A  :<b> $nb </b>";
  }
  ?>
  <?php 
  //classa disponibles
   $sql3=mysqli_query($conn,"select nb_classa from vol where codevol='$mat'");
  if($resul2=mysqli_fetch_assoc($sql3)){
   $nb_classa=$resul2['nb_classa'];
   $dispo= $nb_classa-$nb;
   echo "<br><br>Nombre de places disponibles en classe A :<b> $dispo </b>";
  }
  ?>
  
   <?php 
  //classb réservées
       $sql4=mysqli_query($conn,"select count(*)as nbre from passager where choix_class='classe B' and code_vol='$mat' ");
  if($resul3=mysqli_fetch_assoc($sql4)){
   $nb2=$resul3['nbre'];
  echo "<br><br>Nombre de places réservées en classe B  :<b> $nb2 </b>";
  }
  ?>
  
  <?php 
  //classb disponibles
   $sql5=mysqli_query($conn,"select nb_classb from vol where codevol='$mat'");
  if($resul4=mysqli_fetch_assoc($sql5)){
   $nb_classb=$resul4['nb_classb'];
   $dispo2= $nb_classb-$nb2;
   echo "<br><br>Nombre de places disponibles en classe B : <b>$dispo2</b> ";
  }
  ?>
  <?php 
  $prixa=$result['prix_classa'];
  $rca=$nb*$prixa;
  $prixb=$result['prix_classb'];
  $rcb=$nb2*$prixb;
  $rc=$rca+$rcb;
    echo "<br><br>Recette du vol $mat :<b> $rc</b> FCFA";
  ?>
  </div><br>
  <a href="admin_page.php">Retour</a><br>
</body>
</html>
