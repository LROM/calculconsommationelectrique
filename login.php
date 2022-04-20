<?php
session_start();
require_once 'config.php';
$utilisateurRepo = new UtilisateurRepository($config);
session_destroy();
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

    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
</head>

<body>
    <?php
    $erreurs = array();
    $info = "";

    if (!empty($_POST))
    {
        if (isset($_POST['button_login']))
        {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if (isset($username) && isset($password))
            {
                $utilisateur = $utilisateurRepo->selectUtilisateur($username);
                $password_db = $utilisateur->getPassword();
                if ($password_db != $password)
                {
                    $erreurs[] = "error en login";
                }
                else
                {
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["id"] = $utilisateur->getId();
                    header("Location: account.php");
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

                <form class="form" action="login.php" method="post">
                    <h1>Login</h1>

                    <div class="form_container">

                        <div class="form_group">
                            <input type="text" name="username" id="user" class="form_input" placeholder=" ">
                            <label for="name" class="form_label">User:</label>
                            <span class="form_line"></span>
                        </div>

                        <div class="form_group">
                            <input type="text" name="password" id="password" class="form_input" placeholder=" ">
                            <label for="name" class="form_label">Password:</label>
                            <span class="form_line"></span>
                        </div>

                        <input type="submit" class="form_submit" name="button_login" value="Submit">

                    </div> <br>
                    <p class="form_paragraph"> New user <a href="sign_up.php" class="form_link">Sign up</a></p>

                </form>


                <?php
                require_once 'section/retroaction.php';
                ?>
            </div>
        </div>
    </div>
    <?php
    require_once 'section/footer.php';
    ?>

</body>

</html>