<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Mon app</title>
        
        <link rel="stylesheet" href="mystyle_setbills.css" type="txt/css"> 

        
       <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <div class="title">Registre de Consommation</div>
                    <br><br>
                        <form action = "form_reg_1">
                            <div class ="appareils-details">
                                <div class="input-box">
                                    <span class="details">Plinthe Electrique 1500W (1.5 kWh)</span>                                                          
                                    <br><br>
                                   
                                </div>
                                <div>  
                                    <span class="details">kWh</span>                                   
                                    <input type="text" id="kwh" name="kwh"><br><br>                                                                   
                                </div>

                                <div class="input-box">
                                    <span class="details">Quantite</span>
                                    <input type="text" id="qte" name="qte"><br><br> 
                                </div>
                                
                                <div class="input-box">
                                    <span class="details">Heures par jour</span> 
                                    <input type="text" id="hrs" name="hrs"><br><br>
                                </div>

                                <div class="input-box">
                                    <span class="details">Jours</span> 
                                    <input type="text" id="jrs" name="jrs"><br><br>
                                </div>

                                <div class="input-box">
                                <label for="periode">Periode</label>
                                    <select id="periode">
                                    <option value="annee">Par année</option>
                                    <option value="mois">Par mois</option>
                                    <option value="semaine">Par semaine</option>
                                    <option value="jour">Par jour</option>
                                    </select><br><br>  
                                </div>
                                <div>  
                                    <span class="details">kWh/periode</span>                                   
                                    <input type="text" id="kwh/p" name="kwh/p"><br><br>                                                                   
                                </div>
                               
                            </div>
                            <div class="conso-details">
                                <div class="input-box">
                                    <span class="details">Consommation électrique </span> 
                                    <input type="text" id="conso" name="conso"> <br><br>
                                    <input type="text" id="k_p" name="k_p"><br><br>
                                </div>

                                <div class="input-box">
                                    <span class="details">Coût (tx inclus) </span> 
                                    <input type="text" id="cout" name="cout"> <br><br>
                                   
                                </div>
                            </div>                   
                        </form>
                        <hr>

                        <form action = "form_reg_2">
                            <div class ="appareils-details">
                                <div class="input-box">
                                    <span class="details">Chauffe-eau-40 gal-3000W (3kWh)</span>                                                          
                                    <br><br>
                                   
                                </div>
                                
                                <div class="input-box">
                                    <span class="details">Quantite</span>
                                    <input type="text" id="qte" name="qte"><br><br> 
                                </div>
                                
                                <div class="input-box">
                                    <span class="details">Heures</span> 
                                    <input type="text" id="hrs" name="hrs"><br><br>
                                </div>

                                <div class="input-box">
                                <label for="periode">Periode</label>
                                    <select id="periode">
                                    <option value="annee">Par année</option>
                                    <option value="mois">Par mois</option>
                                    <option value="semaine">Par semaine</option>
                                    <option value="jour">Par jour</option>
                                    </select><br><br>  
                                </div>
                                <div>  
                                    <span class="details">kWh/periode</span>                                   
                                    <input type="text" id="kwh" name="kwh"><br><br>                                                                   
                                </div>
                               
                            </div>
                            <div class="conso-details">
                                <div class="input-box">
                                    <span class="details">Consommation électrique </span> 
                                    <input type="text" id="conso" name="conso"> <br><br>
                                    <input type="text" id="k_p" name="k_p"><br><br>
                                </div>

                                <div class="input-box">
                                    <span class="details">Coût (tx inclus) </span> 
                                    <input type="text" id="cout" name="cout"> <br><br>
                                   
                                </div>
                            </div>                   
                        </form>                   
                        
                        <hr>
                        <form action = "form_reg_1">
                            <div class ="appareils-details">
                                <div class="input-box">
                                    <span class="details">Refrigérateur 2002-2008 (1.25kWh par)</span>                                                          
                                    <br><br>
                                   
                                </div>
                                
                                <div class="input-box">
                                    <span class="details">Quantite</span>
                                    <input type="text" id="qte" name="qte"><br><br> 
                                </div>
                                
                                <div class="input-box">
                                    <span class="details">Heures</span> 
                                    <input type="text" id="hrs" name="hrs"><br><br>
                                </div>

                                <div class="input-box">
                                <label for="periode">Periode</label>
                                    <select id="periode">
                                    <option value="annee">Par année</option>
                                    <option value="mois">Par mois</option>
                                    <option value="semaine">Par semaine</option>
                                    <option value="jour">Par jour</option>
                                    </select><br><br>  
                                </div>
                                <div>  
                                    <span class="details">kWh/periode</span>                                   
                                    <input type="text" id="kwh" name="kwh"><br><br>                                                                   
                                </div>
                               
                            </div>
                            <div class="conso-details">
                                <div class="input-box">
                                    <span class="details">Consommation électrique </span> 
                                    <input type="text" id="conso" name="conso"> <br><br>
                                    <input type="text" id="k_p" name="k_p"><br><br>
                                </div>

                                <div class="input-box">
                                    <span class="details">Coût (tx inclus) </span> 
                                    <input type="text" id="cout" name="cout"> <br><br>
                                   
                                </div>
                            </div>                   
                        </form>

                    </div>    
                </div>                
        

            <?php
            require_once 'section/footer.php';
            ?>

    </body>
</html>