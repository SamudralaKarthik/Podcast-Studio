<?php
    session_start();
    // phpinfo();

    $dbconn = pg_connect("host=localhost port=26257 dbname=podcast_webapp user=admin")
    or die('Could not connect: ' . pg_last_error());
    $user_id = $_SESSION['user_id'];
    if(isset($_POST['smbt-btn'])){
        $pcname = $_POST['firstname'];
        $about = $_POST['lastname'];
        $eno = $_POST['epno'];
        $plname = $_POST['plname'];
        $audio = $_FILES["aud"]['name'];
        $target = "audio/".basename($_FILES["aud"]['name']);
        $image = $_FILES['dp']['name'];
        $target2 = "images/".basename($_FILES['dp']['name']);
        // $catg = $_POST['category'];
       
        

        $sql = "INSERT into podcast_details(user_id, pname, about, epno, plname, audio,image) values('$user_id','$pcname', '$about', '$eno', '$plname','$audio','$image')";
        $result = pg_query($dbconn, $sql) or die('Could not connect: ' . pg_last_error());
        move_uploaded_file($_FILES["aud"]['tmp_name'], $target);
        move_uploaded_file($_FILES['dp']['tmp_name'], $target2);
        if($result){
        $sql3 = "UPDATE user_details SET post = post + 1 where user_id = '$user_id'";
        $a = pg_query($dbconn,$sql3);
        echo "<script>window.location = 'Feed.php'</script>";
        }
    }
?>