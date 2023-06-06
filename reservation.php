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
$num=@$_POST['num'];
$nom=@$_POST['nom'];
$prenom=@$_POST['prenom'];
$sexe=@$_POST['sexe'];
$place=@$_POST['ch_classe'];
$codevol=@$_POST['codevol'];

if(isset($_POST['bmodif'])&&!empty($codevol))
{
$exe=mysqli_query($conn,"update passager set nom='$nom',prenom='$prenom',sexe='$sexe',choix_class='$place',
code_vol='$codevol' where numpiece='$num'");
if($exe){
  echo"Modification réussie !!";
}
else
   echo"Erreur de modification !!";
}

?>
<?php 
if(isset($_POST['bsupp'])&&!empty($num))
{
$exe2=mysqli_query($conn,"delete from passager where numpiece='$num'");
if($exe2){
  echo"Annulation éffectuée !!";
}
else
   echo"Impossible d'annuler !!";
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>GESTION BILLET D'AVION</title>
	<meta charset="utf8">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>
<div  align="center">

<?php 
	
 @$mat=$_GET['Matricule'];
 print"<h2>Listes des passagers ayant réservé un billet pour le vol $mat :</h2>";
$sql="select * from passager where code_vol='$mat'";
$exe=mysqli_query($conn,$sql);
	print'<table border="1" class="tab"><tr><th>NUMERO PIECE</th><th>NOM</th><th>PRENOM</th><th>SEXE</th><th>PLACE</th></tr>';
	     while($rst=mysqli_fetch_assoc($exe)){
	         $num=$rst['numpiece'];
	        $nom=$rst['nom'];
	        $prenom=$rst['prenom'];
	        $sexe=$rst['sexe'];
	        $place=$rst['choix_class'];
	        
	         print"<tr>";
	         echo"<td>$num</td>";
	         echo"<td>$nom</td>";
	         echo"<td>$prenom</td>";
	         echo"<td>$sexe</td>";
	         echo"<td>$place</td>";
	         print"</tr>";
	         
	     }
	   print'</table>';
	?>
	<?php 
	//nbrepassagers
	   $kk=mysqli_query($conn,"select count(*) as nbp from passager where code_vol='$mat'");
	    if($res=mysqli_fetch_assoc($kk)){
	    $nomb=$res['nbp'];
	    }
	   echo "<br><b>Nombre total des passagers : $nomb</b>";
	?>
	<h2 align="center">Formulaire de modification ou d'annulation d'une réservation</h2>
	<form action="" method="POST">
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
	<tr><td><input type="submit" name="bmodif" value="Modifier" class="bouton"></td></tr>
	<tr><td><input type="submit" name="bsupp" value="Annuler" class="bouton"></td></tr>
	</table>
	</form>
	</div>
</body>
