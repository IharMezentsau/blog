<?php

    session_start();

    include_once ("bd.php");

    $data = json_decode(file_get_contents("php://input"), true);

    $resultQuery = "INSERT INTO blog_user.t_user(email,password,name) VALUES(".$userData.",".$data['id'].",".$data['countData'].")";

    mysqli_query($link, $resultQuery);

    $sth = mysqli_query($link, "SELECT * FROM shop.t_buyer");
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    print json_encode($rows);
?>