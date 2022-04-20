<div class = "menu">
    <!--
    <a class = "menu_option" href="account.php">Account</a>
    <a class = "menu_option" href="entreedonnees.php">Entree de donnees</a>
    <a class = "menu_option" href="entreefacture.php">Entree de facture</a>
    <a class = "menu_option" href="evaluation.php">Evaluation/Comparaison</a>
    <a class = "menu_option" href="gestionappareil.php">Gestion des appareils</a>
    <a class = "menu_option" href="index.php">logout</a>
-->

    <p class="utilisateur"> Utilisateur: <?= $_SESSION["username"] ?> </p>
    <ul>
      <li><a class = "menu_option" href="account.php">Account</a></li>
      <li><a class = "menu_option" href="configurationmaison.php">Configuration de maison</a></li>
      <li><a class = "menu_option" href="entreefacture.php">Entree de facture</a></li>
      <li><a class = "menu_option" href="evaluation.php">Evaluation/Comparaison</a></li>
      <li><a class = "menu_option" href="gestionappareil.php">Gestion des appareils</a></li>
      <li><a class = "menu_option" href="index.php">logout</a></li>
    </ul>
</div>  