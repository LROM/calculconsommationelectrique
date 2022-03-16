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
                <p>Bienvenue</p>
                <h>Mode de Calcul de la Consommation électrique</h>
                        <form action = "form_index">                                                       
                                    <br>
                                    <span class="details">Consommation électrique = KiloWattsheure *periode</span>
                                                                                                                          
                                    <br><br>
                                    <span class="details">kWh/année</span><br><br>
                                    <span class="details">kWh/mois</span><br><br>
                                    <span class="details">kWh/semaine</span><br><br>
                                    <span class="details">kWh/jour</span><br><br>

                                    <span class="details">Coût de l'électricité= KiloWattsheure-periode * Tarif d'électricité</span>                                                                                                  
                        </form>
                
            </div>

            <?php
            require_once 'section/footer.php';
            ?>

    </body>
</html>