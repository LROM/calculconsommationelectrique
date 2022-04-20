<?php
session_start();
require_once 'config.php';
$maisonRepo = new MaisonRepository($config);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mon app</title>

    <!--       <link rel="stylesheet" href="mystyle.css" type="txt/css"> -->
    <link rel="stylesheet" href="mystyle.css">


    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
</head>

<body>

    <?php
    require_once 'section/header.php';
    ?>


    <div class="container">

        <?php
        require_once 'section/menu-logged.php';
        ?>

        <div class="panel">
            <div class="panel-title">
                <h1>accueil</h1>
            </div>

            <div class="panel-body">
                <P>Dans cette page vous pouvez gerer vos immeubles et les associer avec des appareils pour faire une stimation de la consomation par annee</P>

                <table>
                    <tr>
                        <th>Addres</th>
                        <th>Code postal</th>
                        <th>Consomation projecte par an</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    $maisons = $maisonRepo->selectAll();
                    foreach ($maisons as $maison)
                    {
                    ?>

                        <tr>
                            <td><?= $maison->getAddress() ?></td>
                            <td><?= $maison->getCodePostal() ?></td>
                            <td>TO DO</td>
                            <td class="td-center">
                                <form name="editerMaisson" action="account.php" method="post">
                                    <input type="hidden" name="id" value="<?= $maison->getId() ?>">
                                    <input type="submit" name="boutonEditerMaison" value="Editer">
                                </form>
                            </td>
                            <td class="td-center">
                                <form name="supprimerMaison" action="account.php" method="post">
                                    <input type="hidden" name="id" value="<?= $maison->getId() ?>">
                                    <input type="submit" name="boutonSupprimer" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>

    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>