<?php
// connexion à la base de données
try
{
    $bdd = new PDO('mysql:host='.(getenv('MYSQL_HOST') ?: 'localhost').';dbname=Estefy;charset=utf8', 'root', '');
}

catch(Exception $e)

{
        die('Erreur : '.$e->getMessage());
        // my sql envoie les erreurs sql
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}