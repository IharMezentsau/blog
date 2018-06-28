<?php

    $dateMessage = date("Y/m/d H.i.s");

    if (isset($_REQUEST['newMessage']) && ($_REQUEST['newMessage'] != "")){
        $querySendMessage = 'INSERT INTO t_message(`date`, `user_id`, `message`) VALUES ("' . $dateMessage .
            '",' . $_SESSION['user_id'] . ',"' . $_REQUEST['newMessage'] . '");';
        $addMessage = mysqli_query($link, $querySendMessage);
    };

    if (isset($_REQUEST['newAnswer']) && ($_REQUEST['newAnswer'] != "") && (isset($_REQUEST['message_id'] ))){
        $querySendAnswer = 'INSERT INTO t_answer_message(`date`, `user_id`, `message_id`, `answer`) VALUES ("' . $dateMessage .
            '",' . $_SESSION['user_id'] . ',' . $_REQUEST['message_id'] . ',"' . $_REQUEST['newAnswer'] . '");';
        $addAnswer = mysqli_query($link, $querySendAnswer);
    };


    $resultMessage = mysqli_query($link, 'SELECT t_message.id AS id_message,
                                                t_message.message AS message, 
                                                t_user.name AS user_name_message,
                                                t_message.date AS date_message,
                                                t_user.avatar AS avatar,
                                                t_user.sex AS sex
                                                FROM t_message INNER JOIN 
                                                t_user ON t_message.user_id = t_user.id
                                                ORDER BY t_message.id ASC;');


    while ($row = mysqli_fetch_assoc($resultMessage)){
        echo '<div class="container masonry" data-columns>
                <div class="item">
                    <div class="thumbnail">
                        <div class="caption">
                            <div class="container-fluid">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <img src="';
        if ($row['avatar'] != null) {
            echo                                $row['avatar'];
        }
        else {
            if ($row['sex'] == 'M') {
                echo 'img/male.jpg';
            }
            elseif ($row['sex'] == 'F') {
                echo                           'img/female.jpg';
            }
            elseif ($row['sex'] == 'U') {
                echo                            'img/unknow.jpg';
            };
        };
        $quaryAnswerCount = 'SELECT COUNT(t_answer_message.id) AS answer_count FROM t_answer_message 
                                                WHERE t_answer_message.message_id = ' . $row['id_message'] . ';';
        $answerCount = mysqli_query($link, $quaryAnswerCount);
        $resultAnswerCount = mysqli_fetch_array($answerCount);
        echo                                        '" alt="" class="img-circle img-responsive img-blog">
                                    <h6>Имя автора: ' . $row['user_name_message'] . '</h6>
                                    <h6>Дата сообщения: ' . $row['date_message'] . '</h6>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8 well">
                                    <p>' . $row['message'] . '</p>' .
                                '</div>
                              
                            </div>
                            <a href="#spoiler-' . $row['id_message'] . '" data-toggle="collapse" class="btn btn-primary collapsed spoiler">Ответов 
                            <span class="badge">' . $resultAnswerCount[0] . '</span></a>
                            <div class="collapse" id="spoiler-' . $row['id_message'] . '">
                                <div class="well">';

        $message_id = $row['id_message'];

        $quaryResultAnswer = 'SELECT t_answer_message.id AS id_answer,
                                                t_answer_message.answer AS answer,
                                                t_user.name AS user_name_answer,
                                                t_answer_message.date AS date_answer,
                                                t_user.avatar AS avatar,
                                                t_user.sex AS sex
                                                FROM t_answer_message INNER JOIN 
                                                t_user ON t_answer_message.user_id = t_user.id
                                                INNER JOIN t_message ON 
                                                t_answer_message.message_id = t_message.id 
                                                WHERE t_answer_message.message_id = ' . $message_id . '
                                                ORDER BY t_answer_message.id ASC;';
        $resultAnswer = mysqli_query($link, $quaryResultAnswer);

        while ($row = mysqli_fetch_assoc($resultAnswer)){


            echo                    '<div class="container-fluid" data-columns>
                                        <div class="item">
                                            <div class="thumbnail">
                                                <div class="caption">
                                                    <div class="container-fluid">
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                                            <img src="';
            if ($row['avatar'] != null) {
                echo                                                $row['avatar'];
            }
            else {
                if ($row['sex'] == 'M') {
                    echo 'img/male.jpg';
                }
                elseif ($row['sex'] == 'F') {
                    echo                                            'img/female.jpg';
                }
                elseif ($row['sex'] == 'U') {
                    echo                                            'img/unknow.jpg';
                };
            };
            echo                                                                '" alt="" class="img-circle img-responsive img-blog">
                                                            <h6>Имя автора: ' . $row['user_name_answer'] . '</h6>
                                                            <h6>Дата сообщения: ' . $row['date_answer'] . '</h6>
                                                        </div>
                                                        <div class="col-lg-10 col-md-10 col-sm-6 col-xs-6 well">
                                                            <p>' . $row['answer'] . '</p>' .
                                                        '</div>
                                                      
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>';};
        if (isset($_SESSION['user_id'])) {
            echo '                              
                                    <div class="container">
                                        <form action="index.php" name="sendAnswer" class="navbar-form navbar-center" method="post">
                                           <div class="form-group">
                                               <input type="text" class="form-control" name="newAnswer" value="">                                                                             
                                           </div>
                                           <button type="submit"  class="btn btn-primary" name="message_id" value="' . $message_id . '">
                                               <i class="fas fa-share-square"></i>
                                           </button>    
                                        </form>
                                    </div>';

            };
        echo '                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    };

    if (isset($_SESSION['user_id'])) {
       echo '
            <div class="navbar navbar-inverse navbar-static-bottom">
                <div class="container">
                    <form action="index.php" name="sendMessage" class="navbar-form navbar-center" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="newMessage" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-share-square"></i>
                        </button>    
                    </form>
                </div>
            </div>';};
?>
