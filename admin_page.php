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
//Si l'utilisateur n'est pas connecté, on le ramène à la page index
if (!isset($_SESSION['id'])) {
	header('Location: authentification.php?action=redirect');
	exit();
}
?>
<?php 
//enregistrement des vols
$date=@$_POST['date'];
//$date=test_input(@$_POST["date"]);
$heure=@$_POST['heure'];
$destination=test_input(@$_POST["destination"]);
$nb_classa=@$_POST['nb_classa'];
$nb_classb=@$_POST['nb_classb'];
$prix_classa=@$_POST['prix_classa'];
$prix_classb=@$_POST['prix_classb'];
$codevol=test_input(@$_POST["codevol"]);

if(isset($_POST['submit'])&&!empty($codevol))
{
$exe=mysqli_query($conn,"insert into vol(date_depart,heure_depart,destination,nb_classa,nb_classb,prix_classa,prix_classb,codevol) 
values('$date','$heure','$destination','$nb_classa','$nb_classb','$prix_classa','$prix_classb','$codevol')");
if($exe){
  echo"<b>Insertion réussie !!</b>";
}
else
   echo"<b>Erreur d'insertion !!</b>";
}

function test_input($data){
 $data=trim($data);
 $data=stripslashes($data);
 $data=htmlspecialchars($data);
 return $data; 
 }
?>
<?php 
//modification des vols
if(isset($_POST['bmodif'])&&!empty($codevol))
{
$exe=mysqli_query($conn,"update vol set date_depart='$date',heure_depart='$heure',destination='$destination',
 nb_classa='$nb_classa',nb_classb='$nb_classb',prix_classa='$prix_classa',prix_classb='$prix_classb' where codevol='$codevol' ");
if($exe){
  echo"Modification réussie !!";
}
else
   echo"Impossible de modifier !!";
}

?>
<?php 
//suppression des vols
if(isset($_POST['bsupp'])&&!empty($codevol))
{
//$exe=mysqli_query($conn,"update vol set date_depart='$date',heure_depart='$heure',destination='$destination',
 //nb_classa='$nb_classa',nb_classb='$nb_classb',prix_classa='$prix_classa',prix_classb='$prix_classb' where codevol='$codevol' ");
$exe=mysqli_query($conn,"delete from vol where codevol='$codevol'");
if($exe){
  echo"Suppréssion réussie !!";
}
else
   echo"Impossible de supprimer !!";
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
	<div align="center">
	<p>
	<a href="authentification.php?action=deconn">déconnexion</a><br>
	<a href="index.php">Accueil</a><br>
	<a href="historique.php">Historique des vols</a>
	</p>
	<h2 align="center">Enregistrement d'un vol</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
	<table >
	<tr><td><b>Date départ :</b></td></tr>
	<tr><td><input type="date" name="date"></td></tr>
	<tr><td><b>Heure départ :</b></td></tr>
	<tr><td><input type="time" name="heure"></td></tr>
	<tr><td><b>Destination :</b></td></tr>
	<tr><td><input type="text" name="destination"></td></tr>
	<tr><td><b>Nombre de places A :</b></td></tr>
	<tr><td><input type="number" name="nb_classa"></td></tr>
	<tr><td><b>Nombre de places B :</b></td></tr>
	<tr><td><input type="number" name="nb_classb"></td></tr>
	<tr><td><b>Prix en classe A :</b></td></tr>
	<tr><td><input type="number" name="prix_classa"></td></tr>
	<tr><td><b>Prix en classe B :</b></td></tr>
	<tr><td><input type="number" name="prix_classb"></td></tr>
	<tr><td><b>Code vol:</b></td></tr>
	<tr><td><input type="text" name="codevol"></td></tr>
	<tr><td><input type="submit" name="submit" value="Enregistrer" class="bouton"></td></tr>
		<tr><td><input type="submit" name="bmodif" value="Modifier"  class="bouton"></td></tr>
		<tr><td><input type="submit" name="bsupp" value="Supprimer"  class="bouton"></td></tr>
	</table>
	</form>
	<p ><br ></p>
	<?php 
	print'<h2>Vols disponibles :</h2>';
	//l'affichage d'un vol disparait de la liste un jour après la date de départ
	     $rq=mysqli_query($conn,"select * from vol where date_depart <> '0000-00-00' and datediff(date_depart,now())>-1");
	print'<table border="1" class="tab"><tr><th>Date départ</th><th>Heure départ</th>
	<th>Destination</th><th>Nombre de places A</th><th>Nombre de places B</th><th>Prix classe A</th><th>Prix classe B</th><th>Code vol</th></tr>';
	     while($rst=mysqli_fetch_assoc($rq)){
	     
	        $dat_dep=$rst['date_depart'];
	        $heure_dep=$rst['heure_depart'];
	        $dest=$rst['destination'];
	        $nb_classea=$rst['nb_classa'];
	        $nb_classeb=$rst['nb_classb'];
	        $prix_classea=$rst['prix_classa'];
	        $prix_classeb=$rst['prix_classb'];
	        $levol=$rst['codevol'];
	         print"<tr>";
	         echo"<td>$dat_dep</td>";
	         echo"<td>$heure_dep</td>";
	         echo"<td>$dest</td>";
	         echo"<td>$nb_classea</td>";
	         echo"<td>$nb_classeb</td>";
	         echo"<td>$prix_classea</td>";
	         echo"<td>$prix_classeb</td>";
	         echo"<td>$levol</td>";
	         echo'<td><a href="detail.php?Matricule='.$rst['codevol'].'">Détail</a></td>';
	         echo'<td><a href="reservation.php?Matricule='.$rst['codevol'].'">Réservation</a></td>';
	         print"</tr>";
	         
	     }
	   print'</table>';
	?>
	</div>
</body>
</html>
