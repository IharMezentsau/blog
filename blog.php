<?php

    $dateMessage = date("Y/m/d H.i.s");

    $DB = new Db();
    $dataBase = $DB->getDb();

    $messageDao = new MessageDao($dataBase);
    $messages = $messageDao->getMessages();

    $answerDao = new AnswerDao($dataBase);
    $answer = $answerDao->getAnswersByMessage(4);

    //$likeDao = new LikeDao($dataBase);

    foreach ($answer as $value) {
        echo $value->answer;
        echo '<br/>';
        echo $value->id;
        echo '<br/>';
    };
    /*foreach ($messages as $value) {
        echo $value->message;
        echo '<br/>';
        echo $value->id;
        echo '<br/>';
    };*/


    /*if (isset($_REQUEST['newMessage']) && ($_REQUEST['newMessage'] != "")){
        $querySendMessage = 'INSERT INTO t_message(`date`, `user_id`, `message`) VALUES ("' . $dateMessage .
            '",' . $_SESSION['user_id'] . ',"' . $_REQUEST['newMessage'] . '");';
        $addMessage = mysqli_query($link, $querySendMessage);
    };

    if (isset($_REQUEST['newAnswer']) && ($_REQUEST['newAnswer'] != "") && (isset($_REQUEST['message_id'] ))){
        $querySendAnswer = 'INSERT INTO t_answer_message(`date`, `user_id`, `message_id`, `answer`) VALUES ("' . $dateMessage .
            '",' . $_SESSION['user_id'] . ',' . $_REQUEST['message_id'] . ',"' . $_REQUEST['newAnswer'] . '");';
        $addAnswer = mysqli_query($link, $querySendAnswer);
    };

    $viewMessage = 10;

    if (isset($_GET['page'])) {
        $p = $_GET['page'];
    }
    else {
        $p = 1;
        $_GET['page'] = $p;
    };

    $numPost = $_GET['page'] * $viewMessage - $viewMessage;

    $resultMessage = mysqli_query($link, 'SELECT t_message.id AS id_message,
                                                t_message.message AS message, 
                                                t_user.name AS user_name_message,
                                                t_user.familyname AS user_familyname_message,
                                                t_message.date AS date_message,
                                                t_user.avatar AS avatar,
                                                t_user.sex AS sex
                                                FROM t_message INNER JOIN 
                                                t_user ON t_message.user_id = t_user.id
                                                ORDER BY t_message.id DESC
                                                LIMIT ' . $numPost . ', ' . $viewMessage . ';');

    $countMessage = mysqli_query($link, 'SELECT COUNT(t_message.id) AS count_message
                                                FROM t_message ;');
    $resultCountMessage = mysqli_fetch_array($countMessage);
    $countPage = ceil($resultCountMessage[0]/$viewMessage);

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

    $i = 0;

    while ($i < count($messages)) {
        echo '<div class="post container">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="' . $messages[$i]["avatar"] . 'alt="user image">
                        <span class="username">
                            <a href="#">' . $messages[$i]['name'] . ' ' . $messages[$i]['familyname'] . '</a>                                   
                        </span>
                        <span class="description">Опубликовано - ' . $messages[$i]['date'] . '</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        ' . $messages[$i]['message'] . '
                    </p>
                    <ul class="list-inline container">';

        $answers = $answerDao->getAnswersByMessage($messages[$i]['id']);
        $resultAnswerCount = count($answers);

        $resultCountMessageLike = $likeDao->getCountLikeByMessage($messages[$i]['id']);

        if (isset($_SESSION['user_id'])) {
            $findLike = $likeDao->getWhoLikeByMessageByUser($messages[$i]['id'], $_SESSION['user_id']);
            echo        '<li>
                            <span class="badge" id="badgeId-' . $messages[$i]['id'] . '">' . $resultCountMessageLike[0] . '</span>
                                <button id="buttonId-' . $messages[$i]['id'] . '" data-idMessage="' . $messages[$i]['id'] . '"
                                        class="' . $findLike . '">   
                                    <i class="far fa-thumbs-up" ></i> Like
                                </button >
                        </li >';
        }
        else{
            echo        '<li>
                            <span class="badge" id="badgeId-' . $messages[$i]['id'] . '">' . $resultCountMessageLike[0] . '</span>
                                    <i class="far fa-thumbs-up" ></i> Like
                        </li >';
        };

        echo            '<li class="pull-right">
                            <a href="#spoiler-' . $messages[$i]['id'] . '" data-toggle="collapse" class="link-black text-sm">
                                <i class="far fa-comments"></i> Комментариев
                                (' . $resultAnswerCount . ')
                            </a>
                        </li>
                    </ul>';
        if (isset($_SESSION['user_id'])) {
            echo '  <form action="index.php" class="form-horizontal" name="sendAnswer" method="post">
                        <div class="input-group">
                            <input class="form-control input-sm" autocomplete="off" name="newAnswer" type="text" placeholder="Напишите комментарий">
                            <span class="input-group-btn">
                                <button type="submit"  class="btn btn-sm btn-primary btn-flat" name="message_id" value="' . $messages[$i]['id'] . '">
                                                       <i class="fas fa-share-square"></i>
                                </button>
                            </span>
                        </div>
                    </form>';
        };
        echo '</div>
              <!-- /.post -->';
                


        if ($resultAnswerCount != 0) {
            echo '<div class="collapse container" id="spoiler-' . $messages[$i]['id'] . '">
                                <div class="well">
                                    <div class="box box-warning direct-chat direct-chat-warning">
                                        <div class="box-body">
                                            <div class="direct-chat-messages">';



            $j = 0;

            while ($j < count($answers)) {

                if ((isset($_SESSION['user_id'])) && ($_SESSION['user_id'] == $answers[$j]['nameId'])) {
                    echo '
                                                    <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg">
                                                      <div class="direct-chat-info clearfix">
                                                        <span class="direct-chat-name pull-left">' .
                        $answers[$j]['name'] . ' ' . $answers[$j]['familyname'] . '
                                                        </span>
                                                        <span class="direct-chat-timestamp pull-right">' . $answers[$j]['date'] . '</span>
                                                      </div>
                                                      <!-- /.direct-chat-info -->
                                                      <img class="direct-chat-img" src="' . $answers[$j]['avatar'] . '" alt="message user image">
                                                      <!-- /.direct-chat-img -->
                                                      <div class="direct-chat-text">' .
                        $answers[$j]['answer'] . '
                                                      </div>
                                                      <!-- /.direct-chat-text -->
                                                  </div>
                                                  <!-- /.direct-chat-msg -->';
                }
                else {
                    echo '<!-- Message to the right -->
                                                    <div class="direct-chat-msg right">
                                                      <div class="direct-chat-info clearfix">
                                                        <span class="direct-chat-name pull-right">' .
                        $answers[$j]['name'] . ' ' . $answers[$j]['familyname'] . '
                                                        </span>
                                                        <span class="direct-chat-timestamp pull-left">' . $answers[$j]['date'] . '</span>
                                                      </div>
                                                      <!-- /.direct-chat-info -->
                                                      <img class="direct-chat-img" src="' . $answers[$j]['avatar'] . '" alt="message user image">
                                                      <!-- /.direct-chat-img -->
                                                      <div class="direct-chat-text">
                                                        ' . $answers[$j]['date'] . '
                                                      </div>
                                                      <!-- /.direct-chat-text -->
                                                  </div>
                                                  <!-- /.direct-chat-msg -->';
                };

                $j++;

            };
            echo '</div>
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
    };



    echo                        '<nav class="text-center">
                                    <ul class="pagination pagination-sm">';

    if ($p == 1) {
        echo                            '<li class="disabled">
                                            <a><i class="fas fa-angle-double-left"></i></a>
                                         </li>
                                         <li class="disabled">
                                            <a><i class="fas fa-chevron-circle-left"></i></a>
                                         </li>';
    }
    else{
        echo                            '<li>
                                            <a href="index.php?page=1">
                                                <i class="fas fa-angle-double-left"></i>
                                            </a>
                                         </li>
                                         <li>
                                            <a href="index.php?page=' . ($_GET['page'] - 1) . '">
                                                <i class="fas fa-chevron-circle-left"></i>
                                            </a>
                                         </li>';
    };

    $p = 0;

    if ($countPage <= 10) {
        while ($p++ < $countPage) {

            if ($_GET['page'] == $p) {
                echo '<li class="active" ><a href="index.php?page=' . $p . '" >' . $p . '</a></li >';
            } else {
                echo '<li><a href="index.php?page=' . $p . '" >' . $p . '</a></li >';
            };

        };
    }
    else{
        switch ($_GET['page']){
            case 1:
                $arrayBiggerTen = array( 1, 2, 'null',($countPage - 1), $countPage);
                break;
            case 2:
                $arrayBiggerTen = array( 1, 2, 'null',($countPage - 1), $countPage);
                break;
            case 3:
                $arrayBiggerTen = array( 1, 2, 3, 'null',($countPage - 1), $countPage);
                break;
            case ($countPage - 2):
                $arrayBiggerTen = array( 1, 2, 'null',($countPage - 2), ($countPage - 1), $countPage);
                break;
            case ($countPage - 1):
                $arrayBiggerTen = array( 1, 2, 'null', ($countPage - 1), $countPage);
                break;
            case ($countPage):
                $arrayBiggerTen = array( 1, 2, 'null',($countPage - 1), $countPage);
                break;
            default:
                $arrayBiggerTen = array( 1, 'null',($_GET['page'] - 1), $_GET['page'], ($_GET['page'] + 1), 'null', $countPage);
                break;
        };

        foreach ($arrayBiggerTen as $valueArrayPage) {

            if ($_GET['page'] == $valueArrayPage) {
                echo '<li class="active" ><a href="index.php?page=' . $valueArrayPage . '" >' . $valueArrayPage . '</a></li >';
            }
            elseif ($valueArrayPage == 'null'){
                echo '<li><a>...</a></li >';
            }
            else {
                echo '<li><a href="index.php?page=' . $valueArrayPage . '" >' . $valueArrayPage . '</a></li >';
            };

        };
    };

    if ($_GET['page'] == $countPage) {
        echo                            '<li class="disabled">
                                            <a>
                                                <i class="fas fa-chevron-circle-right"></i>
                                            </a>
                                         </li>
                                         <li class="disabled">
                                            <a>    
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                         </li>';
    }
    else{
        echo                            '<li>
                                            <a href="index.php?page=' . ($_GET['page'] + 1) . '">
                                                <i class="fas fa-chevron-circle-right"></i>
                                            </a>
                                         </li>
                                         <li>
                                            <a href="index.php?page=' . $countPage . '">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                         </li>';
    };

    echo                            '</ul>
                                </nav>';*/

?>