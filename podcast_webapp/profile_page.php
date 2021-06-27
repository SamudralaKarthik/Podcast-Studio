<?php
    session_start();
    // phpinfo();

    $dbconn = pg_connect("host=localhost port=26257 dbname=podcast_webapp user=admin")
    or die('Could not connect: ' . pg_last_error());
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user_details WHERE user_id = '$user_id'";
     $result = pg_query($dbconn,$sql);


     $query = "select * from follow where follower_id = '$user_id'";
    $run = pg_query($dbconn,$query);
    $row = pg_fetch_array($result);

    $query2 = "select * from follow where user_id = '$user_id'";
    $run2 = pg_query($dbconn,$query2);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="feed_page.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!--js for bootstrap 5-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!--2 js for bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="music.js"></script>
    <title>PODCAST</title>
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
                    <a href="Feed.php" ><span class="icon fa fa-home"></span><span class="text">Home</span></a>
                    
                </div>
            </div>
        </nav>
    <div class="col-md-10 mx-auto" style="margin-top: 70px;">
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">

                    <div class="profile mr-3"><img src="images/user.png" alt="..." width="130" class="rounded mb-2 img-thumbnail"><a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a></div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo $row['username'] ?></h4>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline-item mb-0 navbar-nav">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block" style="padding-left: 5px;"><?php echo $row['post']; ?></h5><small class="text-muted"> <i class="fas fa-image mr-1"></i>Posts</small>
                    </li>
                    <!-- <li class="list-inline-item">
                        <a href="#" style="text-decoration: none; color: black;">
                            <h5 class="font-weight-bold mb-0 d-block" style="padding-left: 5px;">745</h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Followers</small>
                        </a>
                    </li> -->
                    <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link dropdown-toggle" style="color: black;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h5 class="font-weight-bold mb-0 d-block" style="padding-left: 5px;"><?php echo $row['followers']; ?></h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Followers</small>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                        while($row2 = pg_fetch_array($run2)){

                        $followerid = $row2['follower_id'];
                        $sql = "select * from user_details where user_id = '$followerid'";
                        $q = pg_query($dbconn,$sql);
                        $r = pg_fetch_array($q);
                        ?>
                        <h3><?php echo $r['username']; ?></h3>
                    <?php
                    }
                    ?>
                        </ul>
                    </li>
                    <!-- <li class="list-inline-item">
                        <a href="#" style="text-decoration: none; color: black;">
                            <h5 class="font-weight-bold mb-0 d-block" style="padding-left: 5px;">340</h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Following</small>
                        </a>
                    </li> -->
                    <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link dropdown-toggle" style="color: black;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h5 class="font-weight-bold mb-0 d-block" style="padding-left: 5px;"><?php echo $row['following']; ?></h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Following</small>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                               while($row = pg_fetch_array($run)){

                                $followerid = $row['user_id'];
                                $sql = "select * from user_details where user_id = '$followerid'";
                                $q = pg_query($dbconn,$sql);
                                $r = pg_fetch_array($q);
                                ?>
                                <h3><?php echo $r['username']; ?></h3>
                                <?php
                            }
                        ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="px-4 py-3">
                <h5 class="mb-0">About</h5>
                <div class="p-4 rounded shadow-sm bg-light">
                    <p class="font-italic mb-0">PODCAST Dreamer</p>
                    <p class="font-italic mb-0">News reader</p>
                    <p class="font-italic mb-0">Photographer</p>
                </div>
            </div>
            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Recent Posts</h5>
                </div>
                
            </div>
            <div class="feeds">
            <?php
     $sql = "SELECT * FROM podcast_details where user_id='$user_id'";
     $result = pg_query($dbconn,$sql);
     if(isset($result)){
         while($row = pg_fetch_array($result)){
    
   
?>
                <div class="music-container">
                    <div class="box">
                        <div class="image">
                        <img src="images/<?php echo $row['image']; ?>" />
                        
                        </div>
                        <div class="music">
                        <p>PodCast:<?php echo $row['pname'] ?></p>
                            
                            <audio src="audio/<?php echo $row['audio']; ?>" controls></audio>
                        </div>
                    </div>
                </div>
                <?php
             }
        }
        ?>
        </div>
    </div>
    </div>
    </div>
</body>

</html>