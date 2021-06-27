<?php
    session_start();
    // phpinfo();

    $dbconn = pg_connect("host=localhost port=26257 dbname=podcast_webapp user=admin")
    or die('Could not connect: ' . pg_last_error());


     if(isset($_POST['sign-inbtn'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);

        $sql = "SELECT * FROM user_details WHERE username = '$username' AND PASSWORD = '$password' ";
        $result = pg_query($dbconn, $sql);
        $row  = pg_fetch_array($result);


        if($row['username'] == $username && $row['password'] == $password){
            echo "<script>window.location='Feed.php'</script>";
            $_SESSION['user_id'] = $row['user_id'];
        }
        else{
            echo "<script>alert('Check your credentials')</script>";
            echo "<script>location.replace('login.php') </script>";
        }
    }

    if(isset($_POST['sign-upbtn'])){
        $init = 0;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpt_password = $_POST['rpt-password'];

        if($rpt_password == $password){
            $password = md5($password);
            $sql = "INSERT into user_details(username, email, password,post,followers,following) values('$username', '$email', '$password','$init','$init','$init')";
            $result = pg_query($dbconn, $sql);

        $sql = "SELECT * FROM user_details WHERE username = '$username' AND PASSWORD = '$password' ";
        $result = pg_query($dbconn, $sql);
        $row  = pg_fetch_array($result);


        if(isset($result)){
            echo "<script> window.location='login.php'</script>";
            echo "alert('Account created successfully')";
        }
    }
    else{
        echo "alert('Passwords not matching')";
    }
    }

?>


 <!DOCTYPE html>
 <html lang="en">

<head>
    <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="styles.css" />
     <title>Sign in & Sign up Form</title>
 </head>

 <body>

     <div class="container">
         <div class="forms-container">
             <div class="signin-signup">
                 <form action="login.php" method="POST" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                     <div class="input-field">
                         <i class="fas fa-user"></i>
                         <input type="text" name='username' placeholder="Username" />
                     </div>
                     <div class="input-field">
                         <i class="fas fa-lock"></i>
                         <input type="password" name='password' placeholder="Password" />
                     </div>
                     <input type="submit" name='sign-inbtn' value="Login" class="btn solid" />
                     <p class="social-text">Or Sign in with social platforms</p>
                     <div class="social-media">
                         <a href="#" class="social-icon">
                             <i class="fab fa-facebook-f"></i>
                         </a>
                         <a href="#" class="social-icon">
                             <i class="fab fa-twitter"></i>
                         </a>
                         <a href="#" class="social-icon">
                             <i class="fab fa-google"></i>
                         </a>
                         <a href="#" class="social-icon">
                             <i class="fab fa-linkedin-in"></i>
                         </a>
                     </div>
                 </form>
                 <form action="login.php" method="POST" class="sign-up-form">
                     <h2 class="title">Sign up</h2>
                     <div class="input-field">
                         <i class="fas fa-user"></i>
                         <input type="text" name="username" placeholder="Username" />
                     </div>
                     <div class="input-field">
                         <i class="fas fa-envelope"></i>
                         <input type="email" name="email" placeholder="Email" />
                     </div>
                     <div class="input-field">
                         <i class="fas fa-lock"></i>
                         <input type="password" name="password" placeholder="Password" />
                     </div>
                     <div class="input-field">
                         <i class="fas fa-lock"></i>
                         <input type="password" name="rpt-password" placeholder="Repeat Password" />
                     </div>
                     <input type="submit" name="sign-upbtn" class="btn" value="Sign up" />
                     <p class="social-text">Or Sign up with social platforms</p>
                     <div class="social-media">
                         <a href="#" class="social-icon">
                             <i class="fab fa-facebook-f"></i>
                         </a>
                         <a href="#" class="social-icon">
                             <i class="fab fa-twitter"></i>
                         </a>
                         <a href="#" class="social-icon">
                             <i class="fab fa-google"></i>
                         </a>
                         <a href="#" class="social-icon">
                             <i class="fab fa-linkedin-in"></i>
                         </a>
                     </div>
                 </form>
             </div>
         </div>

         <div class="panels-container">
             <div class="panel left-panel">
                 <div class="content">
                     <h3>New here ?</h3>
                     <p>
                         pcasting for an innovative Project
                     </p>
                     <button class="btn transparent" id="sign-up-btn">
               Sign up
             </button>
                 </div>
                 <img src="imgs/signin.jpg" class="image" alt="" />
             </div>
             <div class="panel right-panel">
                 <div class="content">
                     <h3>One of us ?</h3>
                     <p>
                         pcasting for an innovative Project
                     </p>
                     <button class="btn transparent" id="sign-in-btn">
               Sign in
             </button>
                 </div>
                 <img src="imgs/signnup.jpg" class="image" alt="" />
             </div>
         </div>
     </div>
     <script src="login.js"></script>
 </body>
</html>