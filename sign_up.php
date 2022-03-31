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
            require_once 'section/header.php';
            ?>

            <?php
            require_once 'section/menu-no-logged.php';
            ?>


    <div class="container">
    
      <form class="form" action="/login.php" method="post">
      <h1>Sign up</h1>
                      <!--<p class "form_paragraph"> New user <a href="#" class="form_link">Sign up</a></p>-->
                  
                  <div class="form_container">
                      <div class="form_group">
                          <input type="text" id="name" name="name" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Name:</label>
                          <span class="form_line"></span>
                      </div>
                      <div class="form_group">
                          <input type="text" id="lastname" name="lastname" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Lastname:</label>
                          <span class="form_line"></span>
                      </div>
                      <div class="form_group">
                          <input type="text" id="user"  name="user" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">User:</label>
                          <span class="form_line"></span>
                      </div>
                      <div class="form_group">
                          <input type="text" id="courriel" name="courriel" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Email:</label>
                          <span class="form_line"></span>
                      </div>
                      <div class="form_group">
                          <input type="text" id="password" name="password"  class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Password:</label>
                          <span class="form_line"></span>
                      </div>
                      <div class="form_group">
                          <input type="text" id="password2" name="password2" class="form_input" placeholder=" ">
                          <label for="name" class="form_label">Repeat password:</label>
                          <span class="form_line"></span>
                      </div>

                     <input type="submit" class="form_submit" value="Submit">

                  </div> 
                    <!--<p class "form_paragraph"> New user <a href="#" class="form_link">Sign up</a></p>-->   
                                  
        </form>
    </div>

  <?php
  require_once 'section/footer.php';
  ?>

    </body>
  </html>