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
                                                t_user.familyname AS user_familyname_message,
                                                t_message.date AS date_message,
                                                t_user.avatar AS avatar,
                                                t_user.sex AS sex
                                                FROM t_message INNER JOIN 
                                                t_user ON t_message.user_id = t_user.id
                                                ORDER BY t_message.id DESC;');

    if (isset($_SESSION['user_id'])) {
        echo '  <form action="index.php" class="form-horizontal" name="sendMessage" method="post">
                            <div class="input-group">
                                <input class="form-control input-group-lg" autocomplete="off" name="newMessage" type="text" placeholder="Напишите сообщение">
                                <span class="input-group-btn">
                                    <button type="submit"  class="btn btn-group-lg btn-primary btn-flat" name="message_id" >
                                                           <i class="fas fa-share-square"></i>
                                    </button>
                                </span>
                            </div>
                        </form>';
    };

    while ($row = mysqli_fetch_assoc($resultMessage)) {
        echo '<div class="post container">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="';
        if ($row['avatar'] != null) {
            echo $row['avatar'];
        } else {
            if ($row['sex'] == 'M') {
                echo 'img/male.jpg';
            } elseif ($row['sex'] == 'F') {
                echo 'img/female.jpg';
            } elseif ($row['sex'] == 'U') {
                echo 'img/unknow.jpg';
            };
        };
        $quaryAnswerCount = 'SELECT COUNT(t_answer_message.id) AS answer_count FROM t_answer_message 
                                                WHERE t_answer_message.message_id = ' . $row['id_message'] . ';';
        $answerCount = mysqli_query($link, $quaryAnswerCount);
        $resultAnswerCount = mysqli_fetch_array($answerCount);
        echo '" alt="user image">
                        <span class="username">
                                          <a href="#">' . $row['user_name_message'] . ' ' . $row['user_familyname_message'] . '</a>                                   
                                        </span>
                        <span class="description">Опубликовано - ' . $row['date_message'] . '</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        ' . $row['message'] . '
                    </p>
                    <ul class="list-inline container">
                        <li class="pull-right">
                            <a href="#spoiler-' . $row['id_message'] . '" data-toggle="collapse" class="link-black text-sm">
                                <i class="far fa-comments"></i> Комментариев
                                (' . $resultAnswerCount[0] . ')
                            </a>
                        </li>
                    </ul>';
        if (isset($_SESSION['user_id'])) {
            echo '  <form action="index.php" class="form-horizontal" name="sendAnswer" method="post">
                        <div class="input-group">
                            <input class="form-control input-sm" autocomplete="off" name="newAnswer" type="text" placeholder="Напишите комментарий">
                            <span class="input-group-btn">
                                <button type="submit"  class="btn btn-sm btn-primary btn-flat" name="message_id" value="' . $row['id_message'] . '">
                                                       <i class="fas fa-share-square"></i>
                                </button>
                            </span>
                        </div>
                    </form>';
        };
        echo '</div>
                <!-- /.post -->
                
            
                
                            <div class="collapse container" id="spoiler-' . $row['id_message'] . '">
                                <div class="well">';

        $message_id = $row['id_message'];

        $quaryResultAnswer = 'SELECT t_answer_message.id AS id_answer,
                                                t_answer_message.answer AS answer,
                                                t_user.name AS user_name_answer,
                                                t_user.familyname AS user_familyname_answer,
                                                t_answer_message.date AS date_answer,
                                                t_user.avatar AS avatar_answer,
                                                t_user.sex AS sex_answer,
                                                t_answer_message.user_id AS answer_message_user_id
                                                FROM t_answer_message INNER JOIN 
                                                t_user ON t_answer_message.user_id = t_user.id
                                                INNER JOIN t_message ON 
                                                t_answer_message.message_id = t_message.id 
                                                WHERE t_answer_message.message_id = ' . $row['id_message'] . '
                                                ORDER BY t_answer_message.id DESC;';
        $resultAnswer = mysqli_query($link, $quaryResultAnswer);

        echo                        '<div class="box box-warning direct-chat direct-chat-warning">
                                        <div class="box-body">
                                            <div class="direct-chat-messages">';

        while ($row = mysqli_fetch_assoc($resultAnswer)) {

            if ($_SESSION['user_id'] == $row['answer_message_user_id']) {
                echo                        '
                                                <!-- Message. Default to the left -->
                                                <div class="direct-chat-msg">
                                                  <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-left">' .
                    $row['user_name_answer'] . ' ' . $row['user_familyname_answer'] . '
                                                    </span>
                                                    <span class="direct-chat-timestamp pull-right">' . $row['date_answer'] . '</span>
                                                  </div>
                                                  <!-- /.direct-chat-info -->
                                                  <img class="direct-chat-img" src="';
                if ($row['avatar_answer'] != null) {
                    echo $row['avatar_answer'];
                } else {
                    if ($row['sex_answer'] == 'M') {
                        echo 'img/male.jpg';
                    } elseif ($row['sex_answer'] == 'F') {
                        echo 'img/female.jpg';
                    } elseif ($row['sex_answer'] == 'U') {
                        echo 'img/unknow.jpg';
                    };
                };
                echo '" alt="message user image">
                                                  <!-- /.direct-chat-img -->
                                                  <div class="direct-chat-text">' .
                    $row['answer'] . '
                                                  </div>
                                                  <!-- /.direct-chat-text -->
                                              </div>
                                              <!-- /.direct-chat-msg -->';
            } else {
                echo '<!-- Message to the right -->
                                                <div class="direct-chat-msg right">
                                                  <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-right">' .
                    $row['user_name_answer'] . ' ' . $row['user_familyname_answer'] . '
                                                    </span>
                                                    <span class="direct-chat-timestamp pull-left">' . $row['date_answer'] . '</span>
                                                  </div>
                                                  <!-- /.direct-chat-info -->
                                                  <img class="direct-chat-img" src="';
                if ($row['avatar_answer'] != null) {
                    echo $row['avatar_answer'];
                } else {
                    if ($row['sex_answer'] == 'M') {
                        echo 'img/male.jpg';
                    } elseif ($row['sex_answer'] == 'F') {
                        echo 'img/female.jpg';
                    } elseif ($row['sex_answer'] == 'U') {
                        echo 'img/unknow.jpg';
                    };
                };
                echo '" alt="message user image">
                                                  <!-- /.direct-chat-img -->
                                                  <div class="direct-chat-text">
                                                    ' . $row['date_answer'] . '
                                                  </div>
                                                  <!-- /.direct-chat-text -->
                                              </div>
                                              <!-- /.direct-chat-msg -->';
            };


        };
        echo                                '</div>
                                            <!--/.direct-chat-messages-->
                                        </div>
                                        <!-- /.box-body -->
                                    <!--/.direct-chat -->
                                    </div>
                                <!--/.direct-well -->        
                                </div>
                            <!--/.direct-collapse --> 
                            </div>';

    };

?>