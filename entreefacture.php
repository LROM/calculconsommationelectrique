<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mon app</title>

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

                <h1>Entree de facture</h1>
            </div>
            <div class="panel-body">
            </div>

        </div>
    </div>
    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>