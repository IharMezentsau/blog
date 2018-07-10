<?php
    session_start();

    include_once ("bd.php");
    include_once ("class/Db.php");

    $data = json_decode(file_get_contents("php://input"), true);

    $userData = $_SESSION['user_id'];
    $messageData = $data['id'];

    $DB = new Db();
    $dataBase = $DB->getDb();

    $likeDao = new LikeDao($dataBase);
    $countLike = $likeDao->getWhoLikeByMessageByUser($messageData, $userData);

    if ($countLike->likeByUser != 1) {
        $likeDao->insertLike($messageData, $userData);
    }
    else {
        $likeDao->deleteLike($messageData, $userData);
    };

    $summLike = $likeDao->getCountLikeByMessage($messageData);

    echo $summLike->countLike;

?>
