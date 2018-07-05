<?php
    session_start();

    include_once ("bd.php");

    $data = json_decode(file_get_contents("php://input"), true);

    $userData = $_SESSION['user_id'];
    $messageData = $data['id'];

    $queryFindLike = "SELECT *
                        FROM t_like
                        WHERE `user_id`='". $userData ."' AND `message_id`='". $messageData ."'
                        LIMIT 1;";
    $sql = mysqli_query($link, $queryFindLike);

    if (mysqli_num_rows($sql) != 1) {
        $resultQuery = "INSERT INTO t_like(message_id, user_id) VALUES(" . $data['id'] . ", " . $userData . ");";
    }
    else {
        $resultQuery = "DELETE FROM t_like WHERE `user_id`=". $userData ." AND `message_id`=". $messageData .";";
    };

    mysqli_query($link, $resultQuery);

    $querySummLike = "SELECT COUNT(user_id) FROM t_like WHERE message_id =" . $messageData . ";";
    $resultSummQuery = mysqli_fetch_array(mysqli_query($link, $querySummLike));

    echo $resultSummQuery[0];

    //$jsonAnswer = "{'countLike': $resultSummQuery}";

    //header('Content-Type: application/json');

    //$jsonAnswerCode = json_encode($jsonAnswer);
    //echo $jsonAnswerCode;

?>
