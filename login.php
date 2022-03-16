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
            require_once 'section/menu.php';
            ?>
    
      <form class="form">
                      <h2 class"form_title">Login</h2>
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

  <!--  <form action="/action_page.php">
    <div class="mb-3 mt-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="mb-3">
          <label for="pwd" class="form-label">Password:</label>
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
        </div>
        <div class="form-check mb-3">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember"> Remember me
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form> -->


  <?php
  require_once 'section/footer.php';
  ?>

    </body>
  </html>