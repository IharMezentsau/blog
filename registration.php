<?php

    session_start();

    include_once ("bd.php");

    $data = json_decode(file_get_contents("php://input"), true);

    $resultQuery = "INSERT INTO blog_user.t_user(email,password,name) VALUES('".$data['eMailReg']."','".$data['nameId']."','".$data['passwordReg']."')";

    mysqli_query($link, $resultQuery);

?>