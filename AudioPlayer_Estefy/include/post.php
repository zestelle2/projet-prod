<?php
// connexion à la base de données
include '../include/connexion.php';

// tableau Json avec les données dans music
$req = $bdd->query('SELECT * FROM music');
$reponse = $req->fetchAll();

$musics = json_encode($reponse);

echo "<br><br>";
echo $reponse[1][2];
