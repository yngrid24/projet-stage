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

<!DOCTYPE html>
<html>
<head>
	<title>GESTION DES BIELLETS D'AVION</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>
	<div align="center">
	<?php 
	print'<h2>Historique des vols déjà effectués :</h2>';
	//l'affichage d'un vol disparait de la liste un jour après la date de départ
	     $rq=mysqli_query($conn,"select * from vol where date_depart <> '0000-00-00' and datediff(date_depart,now())<=-1");
	print'<table border="1" class="tab"><tr><th>Date</th><th>Heure</th>
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
	
	</div><br>
	<a href="admin_page.php">Retour</a><br>
</body>
</html>
