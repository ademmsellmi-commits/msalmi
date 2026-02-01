<?php
$cnx=mysqli_connect("localhost","root","","batal");
 // . Récupération et protection des données (contre les injections SQL et apostrophes)
 $nom        =$_POST["nom"];
 $prenom     =$_POST["prenom"];
 $date_naiss =$_POST["date_naiss"];
 $experience =$_POST["experience"];
 $disponible =$_POST["disponible"];

 //  La requête SQL
 $rq1 = "INSERT INTO utilisateurs (nom, prenom, date_naissance, experience, disponible) 
         VALUES ('$nom', '$prenom', '$date_naiss', '$experience', '$disponible')";

 // . Exécution
 if (mysqli_query($cnx, $rq1)) {
     echo "<h3 style='color:#2d3250;'>Enregistrement réussi pour $prenom !</h3>";
 } else {
     echo "<h3 style='color: red;'>Erreur </h3>";
 
}

// 6. Fermer la connexion
mysqli_close($cnx);
?>