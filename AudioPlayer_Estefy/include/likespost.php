<?php 

include("connexion.php");


$likePutPost = $bdd->prepare('UPDATE music SET likes = likes+1 WHERE id = ?');
$likePutPost->execute(array($_GET["likes"]));

echo "<script>window.close();</script>";