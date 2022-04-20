<?php
session_start();
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
                <h1>Acceuil</h1>
                <h3>Compte: <?php echo $_SESSION["username"] ?></h3>
            </div>

            <div class="panel-body">
                <P>Dans cette page vous pouvez gerer vos immeubles et les associer avec des appareils pour faire une stimation de la consomation par annee</P>
                
            </div>
        </div>
    </div>

    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>