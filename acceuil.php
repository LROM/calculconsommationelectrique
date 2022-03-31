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

            <?php
            require_once 'section/menu.php';
            ?>


            <div class="container">
                <?php
                    require_once 'db/utilisateur_api.php';
                    $utilisateur = insertUtilisateur();
                ?>

                <h1>Accueil: Bienvenue <?php echo $utilisateur->getUsername() ?></h1>

                <?php
                    echo "<p>user id: ".$utilisateur->getId()."</p>"; 
                    echo "<p>username: ".$utilisateur->getUsername()."</p>";
                    echo "<P>courriel: ".$utilisateur->getCourriel()."</p>";
                    echo "<p>password: ".$utilisateur->getPassword()."</p>";
                ?>

            </div>

            <?php
            require_once 'section/footer.php';
            ?>

    </body>
</html>