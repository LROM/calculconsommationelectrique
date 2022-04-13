<?php
require_once 'db/autoloader.php';
const NOM_BD = "appconso";
define("ADRESSE_HOTE_BD", "localhost");
const NOM_UTILISATEUR_BD = "etd";
const MDP_BD = "etd123";
$config = new ModelRepositoryConfig(NOM_BD, ADRESSE_HOTE_BD, NOM_UTILISATEUR_BD, MDP_BD);
