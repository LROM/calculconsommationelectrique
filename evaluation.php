<?php
session_start();
require_once 'config.php';
$maisonRepo = new MaisonRepository($config);
$appareilRepo = new AppareilRepository($config);
$consomationRepository = new ConsomationRepository($config, $maisonRepo, $appareilRepo);
$tarifRepo = new TarifRepository($config);
$factureRepo = new FactureRepository($config);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mon app</title>
    <link rel="stylesheet" href="mystyle.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->

</head>

<body>

    <?php
    require_once 'section/header.php';
    ?>

    <?php
    $maisons = $maisonRepo->selectAllUtilisateurId($_SESSION["id"]);
    ?>


    <div class="container">

        <?php
        require_once 'section/menu-logged.php';
        ?>

        <div class="panel">
            <div class="panel-title">
                <h1>Evaluation</h1>
            </div>
            <div class="panel-body">
                <div>


                    <?php
                    foreach ($maisons as $maison)
                    {
                    ?>
                        <h3>Adresse de maison: <?= $maison->getAddress() ?></h3>
                        <p>Historique de consommation dans le dernier année</p>
                        <table>
                            <tr>
                                <th>No Facture</th>
                                <th>De</th>
                                <th>Ou</th>
                                <th>Cout facture sans taxes</th>
                            </tr>
                            <?php
                            $facturesByMaison = $factureRepo->selectByMaisonId($maison->getId());
                            $totalFactureAnnee = 0;
                            foreach ($facturesByMaison as $facture)
                            {
                                $totalFactureAnnee = $totalFactureAnnee + $facture->getTotalSansTaxe();
                            ?>
                                <tr>
                                    <td><?= $facture->getNumeroFacture() ?></td>
                                    <td class="td-center"><?= $facture->getDateDebut()->format("Y-m-d") ?></td>
                                    <td class="td-center"><?= $facture->getDateFin()->format("Y-m-d") ?></td>
                                    <td class="td-center"><?= $facture->getTotalSansTaxe() ?> $</td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td class="td-center"><?= $totalFactureAnnee ?> $</td>
                            </tr>
                        </table>

                        <p>Coût projété pour une année</p>

                        <?php
                            $tarif = $tarifRepo->selectAnnee(2022);
                            $tarifavant40kwjour = $tarif->getKilowattsHeureMoinsEgal40();
                            $tafifapres40kwjour = $tarif->getKilowattsHeurePlus40();
                            $tarifconnexionreseaujour= $tarif->getCoutAccessReseauParJour();
 // recuperer tous les consommations
 // faire la multipication de kwh de chaque appareail par numbre d<eures par jour = kwjourappareil
 // sumar tous les kwjourappareil par session () = totalkwjourprintemps
 // if(totalkwjourprintemps <=40){
 //    $kwavant40kwjourprintemps = totalkwjourprintemps;
 //      $kwapres40kwjourprintemps = 0;
//  }
// ELSE{
//    $kwavant40kwjourprintemps = 40;
 //      $kwapres40kwjourprintemps = totalkwjourprintemps - 40;
//}

                            $consommations = $consomationRepository->selectByMaison($maison->getId());

                            $totalkwjourprintemps = 0;
                            $totalkwjourete = 0;
                            $totalkwjourautonme = 0;
                            $totalkwjourhiver = 0;
                            foreach($consommations as $consommation){
                                $totalkwjourprintemps += $consommation->getHeuresParJourPrintemps() * $consommation->getAppareil()->getKilowattsHeure();
                                $totalkwjourete += $consommation->getHeuresParJourEte()  * $consommation->getAppareil()->getKilowattsHeure();
                                $totalkwjourautonme += $consommation->getHeuresParJourAutomme()  * $consommation->getAppareil()->getKilowattsHeure();
                                $totalkwjourhiver += $consommation->getHeuresParJourHiver()  * $consommation->getAppareil()->getKilowattsHeure();
                            }

                            $kwavant40kwjourprintemps;
                            $kwapres40kwjourprintemps;
                            $kwavant40kwjourete;
                            $kwapres40kwjourete;
                            $kwavant40kwjourautonme;
                            $kwapres40kwjourautonme;
                            $kwavant40kwjourhiver;
                            $kwapres40kwjourhiver;

                            if( $totalkwjourprintemps <= 40){
                                $kwavant40kwjourprintemps = $totalkwjourprintemps;
                                $kwapres40kwjourprintemps = 0;
                            }
                            else{
                                $kwavant40kwjourprintemps = 40;
                                $kwapres40kwjourprintemps = $totalkwjourprintemps - 40 ;
                            }

                            if( $totalkwjourete <= 40){
                                $kwavant40kwjourete = $totalkwjourete;
                                $kwapres40kwjourete = 0;
                            }
                            else{
                                $kwavant40kwjourete = 40;
                                $kwapres40kwjourete = $totalkwjourete - 40 ;
                            }

                            if( $totalkwjourautonme <= 40){
                                $kwavant40kwjourautonme = $totalkwjourautonme;
                                $kwapres40kwjourautonme = 0;
                            }
                            else{
                                $kwavant40kwjourautonme = 40;
                                $kwapres40kwjourautonme = $totalkwjourautonme - 40 ;
                            }

                            if( $totalkwjourhiver <= 40){
                                $kwavant40kwjourhiver = $totalkwjourhiver;
                                $kwapres40kwjourhiver = 0;
                            }
                            else{
                                $kwavant40kwjourhiver = 40;
                                $kwapres40kwjourhiver = $totalkwjourhiver - 40 ;
                            }
                            $kwavant40kwjourprintemps;
                            $kwapres40kwjourprintemps;
                            $kwavant40kwjourete;
                            $kwapres40kwjourete;
                            $kwavant40kwjourautonme;
                            $kwapres40kwjourautonme;
                            $kwavant40kwjourhiver;
                            $kwapres40kwjourhiver;

                            $prixvant40kwjourprintemps = $kwavant40kwjourprintemps*$tarifavant40kwjour*93; //93 jour en printemps
                            $prixpres40kwjourprintemps = $kwapres40kwjourprintemps*$tafifapres40kwjour*93; //93 jour en printemps
                            $prixavant40kwjourete = $kwavant40kwjourete*$tarifavant40kwjour*93; //93 jour en printemps
                            $prixapres40kwjourete = $kwapres40kwjourete*$tafifapres40kwjour*93; //93 jour en printemps
                            $prixavant40kwjourautonme = $kwavant40kwjourautonme*$tarifavant40kwjour*90; //90 jour en printemps
                            $prixapres40kwjourautonme = $kwapres40kwjourautonme*$tafifapres40kwjour*90; //90 jour en printemps
                            $prixavant40kwjourhiver = $kwavant40kwjourhiver*$tarifavant40kwjour*89; //89 jour en printemps
                            $prixapres40kwjourhiver =  $kwapres40kwjourhiver*$tafifapres40kwjour*89; //89 jour en printemps

                            $totalcoutavant40kwjour =  $prixvant40kwjourprintemps + $prixavant40kwjourete + $prixavant40kwjourautonme +  $prixavant40kwjourhiver;
                            $totalcoutapres40kwjour = $prixpres40kwjourprintemps + $prixapres40kwjourete + $prixapres40kwjourautonme + $prixapres40kwjourhiver;
                            $totalaccesreseau = $tarifconnexionreseaujour * 365;
                            $totalcoutprojete = $totalcoutavant40kwjour + $totalcoutapres40kwjour  + $totalaccesreseau;
                        ?>

                        <table>
                            <tr>
                                <th></th>
                                <th>Tarif</th>
                                <th>Printemps</th>
                                <th>Été</th>
                                <th>Autonme</th>
                                <th>Hiver</th>
                                <th>Total</th>
                            </tr>

                            <tr>
                                <td>Avant 40 kw par jour</td>
                                <td><?= $tarifavant40kwjour ?> $ / kwh</td>
                                <td><?= $prixvant40kwjourprintemps?> $</td>
                                <td><?= $prixavant40kwjourete ?> $</td>
                                <td><?= $prixavant40kwjourautonme?> $</td>
                                <td><?= $prixavant40kwjourhiver?> $</td>
                                <td><?= $totalcoutavant40kwjour?> $</td>
                            </tr>
                            <tr>
                                <td>Aprés 40 kw par jour</td>
                                <td><?= $tafifapres40kwjour ?> $ / kwh</td>
                                <td><?= $prixpres40kwjourprintemps?> $</td>
                                <td><?= $prixapres40kwjourete ?> $</td>
                                <td><?= $prixapres40kwjourautonme  ?> $</td>
                                <td><?= $prixapres40kwjourhiver?> $</td>
                                <td><?= $totalcoutapres40kwjour ?> $</td>
                            </tr>
                            <tr>
                                <td>Coût de connexion au reseau par année</td>
                                <td><?= $tarifconnexionreseaujour ?> $ / jour</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?= $totalaccesreseau?> $</td>
                            </tr>

                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?= $totalcoutprojete ?> $</td>
                            </tr>
                        </table>
                        <p>Validation de coût d'electricité</p>

                        <table>
                            <tr>
                                <th></th>
                                <th>Coût</th>
                            </tr>
                            <tr>
                            
                                <td>Coût dernier année</td>
                                <td><?= $totalFactureAnnee?> $ </td>
                            </tr>
                            <tr>
                                <td>Coût projeté pour une anné</td>
                                <td><?= $totalcoutprojete?> $</td>
                            </tr>
                            <tr>
                            <td>Total economie projeté</td>
                            <td><h2><?=$totalFactureAnnee - $totalcoutprojete?> $</h2></td>
                            </tr>

                        </table>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <?php
        require_once 'section/footer.php';
        ?>
    </div>
</body>

</html>