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
            require_once 'section/header.php';
            ?>

            <?php
            require_once 'section/menu-no-logged.php';
            ?>
    
    <div class="container">
    
        <form class="form" action="/account.php" method="post">
        <h1>Login</h1>   
                     <!-- <p class "form_paragraph"> New user <a href="#" class="form_link">Register</a></p>-->                  
                  <div class="form_container">
                      <!--<div class="form_group">
                         <input type="text" id="name" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Name:</label>
                          <span class="form_line"></span>
                      </div>-->
                      <div class="form_group">
                          <input type="text" id="user" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">User:</label>
                          <span class="form_line"></span>
                      </div>
                      <div class="form_group">
                          <input type="text" id="password" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Password:</label>
                          <span class="form_line"></span>
                      </div>

                     <input type="submit" class="form_submit" value="Submit">

                  </div>  <br>
                      <p class "form_paragraph"> New user <a href="#" class="form_link">Sign up</a></p>   
                                  
        </form>
      </div>

  <?php
  require_once 'section/footer.php';
  ?>

    </body>
  </html>