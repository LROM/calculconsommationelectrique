<div class="sautligne">
    <?php
    //en cas d'erreur

    if (isset($erreurs) && !empty($erreurs) && is_array($erreurs))
    {
        echo '<div class="erreur">';
        echo '<p>Erreurs :</p>';
        foreach ($erreurs as $err)
        {
            echo "<p> $err </p>";
        }
        echo '</div>';
    }
    // En cas de succes ou message d'info
    else if (isset($info) && !empty($info))
    {
        echo '<div class="succes">';
        echo "<p>$info</p>";
        echo '</div>';
    }
    ?>
</div>