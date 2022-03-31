<?php
require_once 'autoloader.php';

//get post pfrom php

function insertUtilisateur(): ?Utilisateur
{
    $utilisateur  = NULL;    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['user'];
    $courriel = $_POST['courriel'];
    $password = $_POST['password'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
    // echo $name;
    }
    if (empty($courriel)) {
        echo "Courriel is empty";
    } else {
    // echo $courriel;
    }
    if (empty($password)) {
        echo "Password is empty";
    } else {
    // echo "password is ok";
    }

    $config = new ModelRepositoryConfig("appconso", "localhost", "etd", "etd123");
    $utilisateurRepository = new UtilisateurRepository($config);

    $utilisateur = new Utilisateur($name, $courriel, $password );
    $utilisateur_id = $utilisateurRepository->insert($utilisateur);
    $utilisateur->setId($utilisateur_id);
    //echo $utilisateur_id;
    }

    return $utilisateur;
}

?>




