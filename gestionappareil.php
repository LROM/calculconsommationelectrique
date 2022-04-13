<?php
require_once 'config.php';
$appareilRepo = new AppareilRepository($config);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion appareil</title>

    <link rel="stylesheet" href="mystyle.css">


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
</head>

<body>

    <?php
    require_once 'section/header.php';
    ?>

    <?php
    require_once 'section/menu-logged.php';
    ?>

    <?php
    $erreurs = array();
    $info = "";

    if (!empty($_POST))
    {
        if (isset($_POST['boutonajouterappareil']))
        {
            $nameAppareil = filter_input(INPUT_POST, 'nameAppareil', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $kilowatts_heure = filter_input(INPUT_POST, 'kilowattsheure', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (isset($nameAppareil))
            {
                try
                {
                    $nvAppareil = new Appareil($nameAppareil, $kilowatts_heure);
                    $appareilRepo->insert($nvAppareil);
                    $info = "Appareil $nameAppareil ajouté avec succès!";
                    $nameAppareil = "";
                }
                catch (Exception $ex)
                {
                    $erreurs[] = $ex->getMessage();
                }
            }
        }
        else if (isset($_POST['boutonSupprimer']))
        {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            if (isset($id))
            {
                $succes = $appareilRepo->delete($id);
                if ($succes)
                    $info = "Tag supprimé avec succès!";
                else
                    $erreurs[] = "Erreur à la suppression du tag.";
            }
        }
        // Nous sommes dans le cas d'une demande de modification d'un tag
        else if (isset($_POST['boutonDemandeModification']))
        {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            if (isset($id))
            {
                $appareilAModifier = $appareilRepo->select($id);
                if ($appareilAModifier != null)
                {
                    $nameAppareil = $appareilAModifier->getName();
                    $kilowatts_heure = $appareilAModifier->getKilowattsHeure();
                }
            }
        }
        // Nous sommes dans le cas de la modification d'un tag
        else if (isset($_POST['boutonModifier']))
        {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nameAppareil = filter_input(INPUT_POST, 'nameAppareil', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $kilowattsheure = filter_input(INPUT_POST, 'kilowattsheure', FILTER_SANITIZE_NUMBER_INT);
            if (isset($id) && isset($nameAppareil) && isset($kilowattsheure))
            {
                $appareilAModifier = $appareilRepo->select($id);
                if ($appareilAModifier != null)
                {
                    try
                    {
                        $appareilAModifier->setName($nameAppareil);
                        $appareilAModifier->setKilowattsHeure($kilowattsheure);
                        $succes = $appareilRepo->update($appareilAModifier);
                        $tagAModifier = null;
                        $nameAppareil = "";
                        $kilowattsheure = "";
                        if ($succes)
                            $info = "Appareil modifié avec succès!";
                        else
                            $erreurs[] = "Impossible de modifier le appareil.";
                    }
                    catch (Exception $ex)
                    {
                        $erreurs[] = $ex->getMessage();
                    }
                }
            }
        }
    }
    ?>

    <?php
    require_once 'section/retroaction.php';
    ?>

    <div class="sautligne">
        <h1>Registre des appareils</h1>
        <table>


            <tr>
                <th>Appareil</th>
                <th>KWH</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $appareils = $appareilRepo->selectAll();
            foreach ($appareils as $appareil)
            {
            ?>

                <tr>
                    <td><?= $appareil->getName() ?></td>
                    <td><?= $appareil->getKilowattsHeure() ?></td>
                    <td>
                        <form name="modifierAppareil" action="gestionappareil.php" method="post">
                            <input type="hidden" name="id" value="<?= $appareil->getId() ?>">
                            <input class="c_bouton" type="submit" name="boutonDemandeModification" value="Modifier">
                        </form>
                    </td>
                    <td>
                        <form name="supprimerAppareil" action="gestionappareil.php" method="post">
                            <input type="hidden" name="id" value="<?= $appareil->getId() ?>">
                            <input class="c_bouton" type="submit" name="boutonSupprimer" value="Supprimer">
                        </form>
                    </td>
                </tr>

            <?php
            }
            ?>

        </table>

        <div class="sautligne">
            <?php
            if (isset($appareilAModifier))
            {
            ?>
                <form class="form" name="modifierAppareil" action="gestionappareil.php" method="post">
                    <h1>Modification d'un appareil</h1>
                    <label>Appareil à modifier : <input type="text" name="nameAppareil" value="<?= $nameAppareil ?>"></label>
                    <br><br>
                    <label>KiloWattsheure à modifier : <input type="text" name="kilowattsheure" value="<?= $kilowatts_heure ?>"></label>
                    <br><br>
                    <input type="hidden" name="id" value="<?= $appareilAModifier->getId() ?>">
                    <input type="submit" name="boutonModifier" value="Modifier">
                    <input type="submit" name="boutonAnnuler" value="Annuler">
                </form>
            <?php
            }
            else
            {
            ?>


                <br><br>
                <form class="form" name="ajouterAppareil" action="gestionappareil.php" method="post">
                    <h1>Ajout d'un nouveau appareil</h1>
                    <label>Nom d'appareil : <input type="text" name="nameAppareil" value="<?= $nameAppareil ?>"> </label>
                    <br><br>
                    <label>KiloWattsheure: <input type="text" name="kilowattsheure" value="<?= $kilowatts_heure ?>"> </label>
                    <br><br>
                    <input type="submit" name="boutonajouterappareil" value="Ajouter">

                </form>
            <?php
            }
            ?>
        </div>

    </div>





    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>