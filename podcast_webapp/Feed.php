<?php
    session_start();
    // phpinfo();

    $dbconn = pg_connect("host=localhost port=26257 dbname=podcast_webapp user=admin")
    or die('Could not connect: ' . pg_last_error());
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_details WHERE user_id = '$user_id'";
     $result = pg_query($dbconn,$sql);
    $row = pg_fetch_array($result)

?>


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="feed_page.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <title></title>
</head>
<body>
        <nav>
            <div class="container2" style="padding-top:15px ;">
                <a href="Feed.html" style="border: none; text-decoration: none;"><h3 class="logo">PodCast<span>Studio.</span></h3></a>
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
                    <a href="#" class="active"><span class="icon fa fa-home"></span><span class="text">Home</span></a>
                    <a href="profile_page.php"><span class="icon fa fa-user"></span><span class="text">Profile</span></a>
                    <a href="uploading.html"><span class="icon fa fa-plus"></span><span class="text">Publish</span></a>
                    <a href="logout.php"><span class="icon fa fa-angle-left"></span><span class="text">Logout</span></a>
                </div>
            </div>
        </nav>

    

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/main.js"></script>

        <form action="feed_act.php" method="POST">
    <div class="search-box">
        <input type="text" name="name" placeholder="Search anything" class="search-input">
        <button name="search" class="search-btn">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>

<h1 class="heading">Recent<span>Feeds</span></h1>
<center>
<!-- <div class='filter'>
        <form action="Feed.php" method="POST">
            <Label>Spiritual</Label> <input type="checkbox" value="" name="category-1">
            <Label>Motivaional</Label> <input type="checkbox" name="category-2">
            <Label>Education</Label> <input type="checkbox" name="category-3">
            <Label>Entertainment</Label> <input type="checkbox" name="category-4">
            <input type="submit" name="catg" value="confirm">
        </form>

    </div>
    <?php
    if(isset($_POST['catg'])){

    if(isset($_POST['category-1'])){
        $choice = $_POST['category-1'];
    }
    if(isset($_POST['category-2'])){
        $choice = $_POST['category-2'];
    }
    if(isset($_POST['category-3'])){
        $choice = $_POST['category-3'];
    }
    if(isset($_POST['category-4'])){
        $choice = $_POST['category-4'];
    }
}
    ?>
    <div>
        Choice taken: <?php echo $choice; ?>
    </div> -->
    <div class="feeds">
        <?php 
         $s = "select * from follow where follower_id='$user_id'";
         $ru = pg_query($dbconn,$s);
         while($rod = pg_fetch_array($ru)){
             $id = $rod['user_id'];
             $sql1 = "select * from podcast_details where user_id = '$id'";
             $r = pg_query($dbconn,$sql1);
             while($c = pg_fetch_array($r)){
                 $sql2 = "select * from user_details where user_id = '$id'";
                 $q = pg_query($dbconn,$sql2);
                 $d = pg_fetch_array($q);
        ?>



        <div class="music-container">
            <div class="box">
                <div class="image">
                    <img src="images/<?php echo $c['image']; ?>" alt="" />
                </div>
                <div class="music">
                    <p>Author: <?php echo $d['username']; ?></p>
                    <br>
                    <p>PodCast: <?php echo $c['pname']; ?></p>
                    <audio src="audio/<?php echo $c['audio'];?>" controls></audio>
                </div>
            </div>
        </div>
        <?php } }?>
             </div>
             </center>
    <script type="text/javascript" src="music.js"></script>
</body>
</html>