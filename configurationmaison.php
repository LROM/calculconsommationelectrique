<?php
session_start();
require_once 'config.php';
$maisonRepo = new MaisonRepository($config);
$appareilRepo = new AppareilRepository($config);
$consomationRepository = new ConsomationRepository($config, $maisonRepo, $appareilRepo);
$tarifRepo = new TarifRepository($config);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mon app</title>

    <link rel="stylesheet" href="mystyle.css">


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
</head>

<body>

    <?php
    require_once 'section/header.php';
    ?>

    <?php
    $erreurs = array();
    $info = "";

    if (!empty($_POST))
    {
        if (isset($_POST['boutonEditerMaison']))
        {
            $maisonId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $maison = $maisonRepo->select($maisonId);
        }
        if (isset($_POST['boutonAjouterConsommation']))
        {
            $maisonId = filter_input(INPUT_POST, 'maisonId', FILTER_SANITIZE_NUMBER_INT);
            $appareilId = filter_input(INPUT_POST, 'appareilId', FILTER_SANITIZE_NUMBER_INT);
            $heurePrintemps = filter_input(INPUT_POST, 'heurePrintems', FILTER_SANITIZE_NUMBER_INT);
            $heureEte = filter_input(INPUT_POST, 'heureEte', FILTER_SANITIZE_NUMBER_INT);
            $heureAutomne = filter_input(INPUT_POST, 'heureAutomne', FILTER_SANITIZE_NUMBER_INT);
            $heureHiver = filter_input(INPUT_POST, 'heureHiver', FILTER_SANITIZE_NUMBER_INT);

            $maison = $maisonRepo->select($maisonId);
            $appareil = $appareilRepo->select($appareilId);
            $consommation = new Consommation($maison, $appareil, $heurePrintemps, $heureEte, $heureAutomne, $heureHiver);

            $consomationRepository->insert($consommation);

            $heurePrintemps = "";
            $heureEte = "";
            $heureAutomne = "";
            $heureHiver = "";
        }
        if (isset($_POST['boutonSupprimerConsommation']))
        {
            $consommationId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $consommation = $consomationRepository->select($consommationId);
            $maisonId = $consommation->getMaison()->getId();
            $maison = $maisonRepo->select($maisonId);

            $consomationRepository->delete($consommationId);
        }
        if (isset($_POST['boutonPreparerModifierConsommation']))
        {
            $consommationAModifierId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $consommationAModifier = $consomationRepository->select($consommationAModifierId);
            $maisonId = $consommationAModifier->getMaison()->getId();
            $maison = $maisonRepo->select($maisonId);
            //$appareilToSelect = $consommation->getAppareil()->getId();

        }
        if (isset($_POST['boutonModifierConsommation']))
        {
            $consommationAModifieriId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $maisonId = filter_input(INPUT_POST, 'maisonId', FILTER_SANITIZE_NUMBER_INT);
            $appareilId = filter_input(INPUT_POST, 'appareilId', FILTER_SANITIZE_NUMBER_INT);
            $heurePrintemps = filter_input(INPUT_POST, 'heurePrintems', FILTER_SANITIZE_NUMBER_INT);
            $heureEte = filter_input(INPUT_POST, 'heureEte', FILTER_SANITIZE_NUMBER_INT);
            $heureAutomne = filter_input(INPUT_POST, 'heureAutomne', FILTER_SANITIZE_NUMBER_INT);
            $heureHiver = filter_input(INPUT_POST, 'heureHiver', FILTER_SANITIZE_NUMBER_INT);

            $consommation = $consomationRepository->select($consommationAModifieriId);
            $maison = $maisonRepo->select($maisonId);
            $appareil = $appareilRepo->select($appareilId);

            echo "maisonid";
            echo $maison->getId();
            $consommation->setMaison($maison);
            $consommation->setAppareil($appareil);
            $consommation->setHeuresParJourPrintemps($heurePrintemps);
            $consommation->setHeuresParJourEte($heureEte);
            $consommation->setHeuresParJourAutomme($heureAutomne);
            $consommation->setHeuresParJourHiver($heureHiver);
            $consomationRepository->update($consommation);
            $appareilId;
            $heurePrintems = "";
            $heureEte = "";
            $heureAutomne = "";
            $heureHiver = "";
        }
    }
    ?>

    <div class="container">
        <?php
        require_once 'section/menu-logged.php';
        ?>
        <div class="panel">
            <div class="panel-title">
                <h1>Edition de maison</h1>
            </div>
            <div class="panel-body">
                <br><br>
                <!-------------------------------->
                <!-- START CONFIGURATION MAISON -->

                <!-- Affichage maison -->
                <p>Proprietaire: <?= $_SESSION["username"] ?></p>
                <p>Addres: <?= $maison->getAddress() ?></p>
                <p>Code postal: <?= $maison->getCodePostal() ?></p>

                <form name="editerMaisson" action="configurationmaison.php" method="post">
                    <input type="hidden" name="id" value="<?= $maison->getId() ?>">
                    <input type="submit" name="boutonEditerMaison" value="Editer">
                </form>

                <form name="supprimerMaison" action="account.php" method="post">
                    <input type="hidden" name="id" value="<?= $maison->getId() ?>">
                    <input type="submit" name="boutonSupprimer" value="Supprimer">
                </form>


                <!-- Affichage consommations -->
                <h3>Consommation par annee</h3>
                <table>
                    <tr>
                        <th>Appareil</th>
                        <th>KWH</th>
                        <th>Heures/jour Printemps</th>
                        <th>Heures/jour Ete</th>
                        <th>Heures/jour Automne</th>
                        <th>Heures/jour Hiver</th>
                        <th>Cout par annee</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    $consommations = $consomationRepository->selectByMaison($maisonId);
                    $totalMaison = 0;
                    $prix_kwh = $tarifRepo->selectAnnee(2022)->getKilowattsHeureMoinsEgal40();

                    foreach ($consommations as $consommation)
                    {
                        $kwh = $consommation->getAppareil()->getKilowattsHeure();
                        $hp = $consommation->getHeuresParJourPrintemps();
                        $he = $consommation->getHeuresParJourEte();
                        $ha = $consommation->getHeuresParJourAutomme();
                        $hh = $consommation->getHeuresParJourHiver();

                        $coutAppareilParAnnee = $kwh * ($hp * 93 + $he * 93  + $ha * 90 + $hh * 89) * $prix_kwh ;

                        $totalMaison = $totalMaison + $coutAppareilParAnnee ;
                    ?>
                        <tr>
                            <td><?= $consommation->getAppareil()->getName() ?></td>
                            <td class="td-center"><?= $consommation->getAppareil()->getKilowattsHeure() ?></td>
                            <td class="td-center" ><?= $consommation->getHeuresParJourPrintemps() ?></td>
                            <td class="td-center"><?= $consommation->getHeuresParJourEte() ?></td>
                            <td class="td-center"><?= $consommation->getHeuresParJourAutomme() ?></td>
                            <td class="td-center"><?= $consommation->getHeuresParJourHiver() ?></td>
                            <td class="td-center"> $<?= $coutAppareilParAnnee ?> </td>
                            <td class="td-center">
                                <form name="modifierConsommation" action="configurationmaison.php" method="post">
                                    <input type="hidden" name="id" value="<?= $consommation->getId() ?>">
                                    <input type="submit" name="boutonPreparerModifierConsommation" value="Modifier">
                                </form>
                            </td>
                            <td class="td-center">
                                <form name="supprimerConsomation" action="configurationmaison.php" method="post">
                                    <input type="hidden" name="id" value="<?= $consommation->getId() ?>">
                                    <input type="submit" name="boutonSupprimerConsommation" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="6">Total</td>
                        <td class="td-center" >$<?= $totalMaison ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>


                <!-- Gestion Consomation -->
                <div class="sautligne">
                    <?php
                    if (isset($consommationAModifier))
                    {
                    ?>
                        <form name="modifierConsommation" action="configurationmaison.php" method="post">
                            <p>Modification de consomation</p>
                            <input type="hidden" name="maisonId" value="<?= $maisonId ?>">
                            <label for="appareilModifier">Appareil</label>
                            <select id="appareilModifier" name="appareilId">
                                <?php
                                $appareils = $appareilRepo->selectAll();
                                foreach ($appareils as $appareil)
                                {
                                    if ($appareil->getId() == $consommationAModifier->getAppareil()->getId())
                                    {
                                ?>
                                        <option value="<?= $appareil->getId() ?>" selected><?= $appareil->getName() ?></option>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <option value="<?= $appareil->getId() ?>"><?= $appareil->getName() ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <br>
                            <label for="heurePrintems">Heures primtemp:</label>
                            <input id="heurePrintems" type="text" name="heurePrintems" value="<?= $consommationAModifier->getHeuresParJourPrintemps() ?>">
                            <br>
                            <label for="heureEte">Heures ete: </label>
                            <input id="heureEte" type="text" name="heureEte" value="<?= $consommationAModifier->getHeuresParJourEte() ?>">
                            <br>
                            <label for="heureAutomne">Heures automne: </label>
                            <input id="heureAutomne" type="text" name="heureAutomne" value="<?= $consommationAModifier->getHeuresParJourAutomme() ?>">
                            <br>
                            <label for="heureHiver">Heures hiver: </label>
                            <input id="heureHiver" type="text" name="heureHiver" value="<?= $consommationAModifier->getHeuresParJourHiver() ?>">
                            <br>
                            <input type="hidden" name="id" value="<?= $consommationAModifier->getId() ?>">
                            <input type="submit" name="boutonModifierConsommation" value="Modifier">
                            <input type="submit" name="boutonAnnulerModifierConsomation" value="Annuler">
                        </form>
                    <?php
                    }
                    else
                    {
                    ?>
                        <form name="ajouterConsomation" action="configurationmaison.php" method="post">
                            <p>Ajout de consomation</p>
                            <input type="hidden" name="maisonId" value="<?= $maisonId ?>">
                            <label for="appareil">Appareil</label>
                            <select id="appareil" name="appareilId">
                                <?php
                                $appareils = $appareilRepo->selectAll();
                                foreach ($appareils as $appareil)
                                {
                                ?>
                                    <option value="<?= $appareil->getId() ?>"><?= $appareil->getName() ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <br>
                            <label for="heurePrintems">Heures primtemp:</label>
                            <input id="heurePrintems" type="text" name="heurePrintems" value="<?= $heurePrintemps ?>">
                            <br>
                            <label for="heureEte">Heures ete: </label>
                            <input id="heureEte" type="text" name="heureEte" value="<?= $heureEte ?>">
                            <br>
                            <label for="heureAutomne">Heures automne: </label>
                            <input id="heureAutomne" type="text" name="heureAutomne" value="<?= $heureAutomne ?>">
                            <br>
                            <label for="heureHiver">Heures hiver: </label>
                            <input id="heureHiver" type="text" name="heureHiver" value="<?= $heureHiver ?>">
                            <br>
                            <input type="submit" name="boutonAjouterConsommation" value="Ajouter">
                        </form>
                    <?php
                    }
                    ?>
                </div>


                <!-- END Configuration maison -->
                <!-------------------------------->

            </div>
        </div>

    </div>
    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>