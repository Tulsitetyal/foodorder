

<?php include('../config/constants.php') ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
  </head>
  <body style="background-color:#eeeeee;">
    <div class="login">
    <img src="../images/logo1.png" alt="Restaurant Logo" class="img-responsive " width="25%" >
      <h1 class="text-center">Login </h1>
      <br>

      <?php
       if(isset($_SESSION['login']))
      {
        echo $_SESSION['login']; //Display session massage
        unset($_SESSION['login']);//Removing session massege
      }

      if(isset($_SESSION['no-login-message']))
     {
       echo $_SESSION['no-login-message']; //Display session massage
       unset($_SESSION['no-login-message']);//Removing session massege
     }
     ?>
     <br>
      <!-- Login form start -->
      <form action="" method="POST" class="">
        Username:
        <input type="text" name="username" placeholder="Enter Username"class="form-control"><br>

        Password:
        <input type="password" name="password" placeholder="Enter Password" class="form-control"><br>

        <input type="submit" name="submit" value="Login" class="btn-primary btn"><br>
        <br>
        </form>


        <!-- Login  form ends here -->

        <p class="text-center" >Created By - <a href="#" style="color:red;">Tulsi Tetyal and Philip James</a> </p>

    </div>
  </body>
  <?php
       if(isset($_POST['submit'])) {
         //Process for login
         //1. Get the Data from login page
          $username = $_POST['username'];
          $password = md5($_POST['password']);

          //2. SQL to check whether the user with username and password match or not
          $sql="SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";

          //3.Execute the query
          $res = mysqli_query($conn,$sql);

          //4.Counts rows to check whether the user exists or not
          $count =mysqli_num_rows($res);
          if($count==1)
          {
            //USer Available And login success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user']= $username; // To check whether the user is logged in  or not and logout will unset it
            //Redirect to home page/Dashboard
            header('location:'.SITEURL.'admin/');
          }
          else {
            {
              //USer not  Available And login fail.
              $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
              //Redirect to login page again
              header('location:'.SITEURL.'admin/login.php');
            }
          }
       }
   ?>
</html>
