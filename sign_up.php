<?php
require_once 'config.php';
$utilisateurRepo = new UtilisateurRepository($config);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Mon app</title>
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="mystyle.css" type="txt/css"> -->

    <link rel="stylesheet" href="mystyle.css">

</head>

<body>

    <?php
    $erreurs = array();
    $info = "";

    if (!empty($_POST))
    {
        if (isset($_POST['button_sign_up']))
        {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $courriel = filter_input(INPUT_POST, 'courriel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if (isset($username) && isset($courriel) && isset($password) && isset($password2) && ($password == $password2))
            {
                try
                {
                    $utilisateur = new Utilisateur($username, $courriel, $password);
                    $utilisateur_id = $utilisateurRepo->insert($utilisateur);
                    $utilisateur->setId($utilisateur_id);
                    header("Location: login.php");
                }
                catch (Exception $ex)
                {
                    $erreurs[] = $ex->getMessage();
                }
            }
        }
    }
    ?>
    <?php
    require_once 'section/header.php';
    ?>

    <div class="container">
        <?php
        require_once 'section/menu-no-logged.php';
        ?>

        <div class="panel">

        <div class="panel-title">

        </div>
        <div class="panel-body">

            <form class="form" action="/sign_up.php" method="post">
                <h1>Sign up</h1>
                <!--<p class "form_paragraph"> New user <a href="#" class="form_link">Sign up</a></p>-->

                <div class="form_container">
                    <div class="form_group">
                        <input type="text" id="name" name="username" class="form_input" placeholder=" ">
                        <label for="name" class="form_label">User Name:</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="form_group">
                        <input type="text" id="courriel" name="courriel" class="form_input" placeholder=" ">
                        <label for="name" class="form_label">Email:</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="form_group">
                        <input type="password" id="password" name="password" class="form_input" placeholder=" ">
                        <label for="name" class="form_label">Password:</label>
                        <span class="form_line"></span>
                    </div>
                    <div class="form_group">
                        <input type="password" id="password2" name="password2" class="form_input" placeholder=" ">
                        <label for="name" class="form_label">Repeat password:</label>
                        <span class="form_line"></span>
                    </div>

                    <input type="submit" class="form_submit" name="button_sign_up" value="Submit">

                </div>

            </form>
        </div>
            <?php
            require_once 'section/retroaction.php';
            ?>

        </div>
    </div>
    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>