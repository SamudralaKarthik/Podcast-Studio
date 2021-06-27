<?php
    session_start();
    // phpinfo();

    $dbconn = pg_connect("host=localhost port=26257 dbname=podcast_webapp user=admin")
    or die('Could not connect: ' . pg_last_error());
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_details WHERE user_id = '$user_id'";
     $result = pg_query($dbconn,$sql);
    $row = pg_fetch_array($result);

    if(isset($_POST['search'])){
        if($row['username']!=$_POST['name']){
            $name = $_POST['name'];
            $sql = "select * from user_details where username = '$name' ";
            $run = pg_query($dbconn,$sql);
            $check = pg_fetch_array($run);
            ?>
            
            <?php
        }
    }
?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="res.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <title></title>
</head>
<body>
    <header>
        <nav>
            <div class="container2">
                <a href="Home.html" style="border: none; text-decoration: none; padding-top:15px;"><h3 class="logo">PodCast<span>Studio.</span></h3></a>
            </div>
            <div class="box-menu">
                <div class="wrapper">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="menu">
                    <a href="#" class="active"><span class="icon fa fa-info-circle"></span><span class="text">About Us</span></a>
                    <a href="#"><span class="icon fa fa-suitcase"></span><span class="text">Portfolio</span></a>
                    <a href="#"><span class="icon fa fa-shopping-basket"></span><span class="text">Store</span></a>
                    <a href="#"><span class="icon fa fa-phone"></span><span class="text">Contacts</span></a>
                </div>
            </div>
        </nav>
    </header>


        <h1 class="heading">Search<span>Results</span></h1>
    <div class="followers">
        <ul><a href="Prajwal.php">
                <?php $_SESSION['id'] = $check['user_id']?>
                <br>
                <br>
                <h3><?php echo $check['username'];?> <button name ='follow'>Follow</button> </h3>
                
            </a></ul>
    </div>
</body>
</html>