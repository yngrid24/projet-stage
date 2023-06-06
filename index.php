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
$id='1';
$login='chcode';
$pass='chrislink';
//mysqli_query($conn,"insert into secret(id,login,password) values ('$id','$login',md5('$pass'))");
?>

  <?php 
  //nbre classe réservées
  $codevol=test_input(@$_POST['codevol']);
       $sql2=mysqli_query($conn,"select count(*)as nbre from passager where choix_class='classe A' and code_vol='$codevol' ");
  if($resul=mysqli_fetch_assoc($sql2)){
   $nb=$resul['nbre'];
  }
  ?>
 <?php 
  //classe disponibles
   $sql3=mysqli_query($conn,"select nb_classa from vol where codevol='$codevol'");
  if($resul2=mysqli_fetch_assoc($sql3)){
   $nb_classa=$resul2['nb_classa'];
  }
  ?>
  <?php 
  //nbre classb réservées
  //$codevol=@$_POST['codevol'];
       $sql3=mysqli_query($conn,"select count(*)as nbre from passager where choix_class='classe B' and code_vol='$codevol' ");
  if($resul2=mysqli_fetch_assoc($sql3)){
   $nb2=$resul2['nbre'];
  }
  ?>
  <?php 
  //classb disponibles
   $sql4=mysqli_query($conn,"select nb_classb from vol where codevol='$codevol'");
  if($resul3=mysqli_fetch_assoc($sql4)){
   $nb_classb=$resul3['nb_classb'];
  }
  ?>

<?php 
$num=test_input(@$_POST["num"]);
$nom=test_input(@$_POST['nom']);
$prenom=test_input(@$_POST['prenom']);
$sexe=@$_POST['sexe'];
$place=@$_POST['ch_classe'];

function test_input($data){
 $data=trim($data);
 $data=stripslashes($data);
 $data=htmlspecialchars($data);
 return $data; 
 }

if(isset($_POST['submit'])&&!empty($codevol))
{
if(($place=='classe A'&&$nb_classa!=$nb)||($place=='classe B'&&$nb_classb!=$nb2)){
$exe=mysqli_query($conn,"insert into passager (numpiece,nom,prenom,sexe,choix_class,code_vol) 
values('$num','$nom','$prenom','$sexe','$place','$codevol')");
if($exe){
  echo"<b>Insertion réussie !!</b>";
}
else
   echo"<b>Erreur d'insertion !!</b>";
}
else{ 
       if($nb_classa==$nb){
     echo "<b>Désolé, toutes les places en classe A sont déjà occupées pour ce vol.</b>";
     }
      if($nb_classb==$nb2){
     echo "<br><b>Désolé, toutes les places en classe B sont déjà occupées pour ce vol.</b>";
     }
     if(($nb_classb==$nb2)&&($nb_classa==$nb)){
     echo "<br><b>Tous les billets pour ce vol sont déjà réservés.</b>";
     }    
     }
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
	<a href="authentification.php">ADMINISTRATEUR</a>
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
	         // $ligne.='<td><a href="detail.php?Matricule='.$elt['matricule'].'">Modifier</a></td>';
	         print"</tr>";
	         
	     }
	   print'</table>';
	?>
	<h2 align="center">Formulaire de réservation de billet</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
	<table >
	<tr><td><b>Numéro pièce :</b></td></tr>
	<tr><td><input type="text" name="num"></td></tr>
	<tr><td><b>Nom passager :</b></td></tr>
	<tr><td><input type="text" name="nom"></td></tr>
	<tr><td><b>Prenom passager :</b></td></tr>
	<tr><td><input type="text" name="prenom"></td></tr>
	<tr><td><b>Sexe passager :</b></td></tr>
	<tr><td><select name="sexe" id="sexe"  >
         <option  value="MASCULIN">MASCULIN</option>
        <option  value="FEMININ">FEMININ</option>
     </select></td></tr>
	<tr><td><b>Choix d'une place :</b></td></tr>
	<tr><td><select name="ch_classe" id="ch_classe"  >
         <option  value="classe A">Place en classe A</option>
        <option  value="classe B">Place  en classe B</option>
     </select></td></tr>
     <tr><td><b>Code vol :</b></td></tr>
	<tr><td><input type="text" name="codevol"></td></tr>
	<tr><td><input type="submit" name="submit" value="Réserver" class="bouton"></td></tr>
	</table>
	</form>
	</div>
</body>
</html>
