<?php
$cnx=mysqli_connect("localhost","root","","batal");
 // . Récupération et protection des données (contre les injections SQL et apostrophes)
 $sujet      =$_POST["sujet"];
 $nom_b      =$_POST["nom_boss"];
 $tel        =$_POST["tel"];
 $date_d     =$_POST["date_debut"];
 $date_f     =$_POST["date_fin"];


 //  La requête SQL
 $rq1 = "INSERT INTO travaux (sujet, nom_boss, telephone, date_debut, date_fin) 
 VALUES 
 ('$sujet', '$nom_b', '$tel', '$date_d', '$date_f')";

 // . Exécution
 if (mysqli_query($cnx, $rq1)) {
     echo "<h3 style='color:#2d3250;'>Enregistrement réussi pour $nom_b !</h3>";
 } else {
     echo "<h3 style='color: red;'>Erreur ". mysqli_error($cnx)." </h3>";
 
}

// 6. Fermer la connexion
mysqli_close($cnx);
?>