<?php

    $dateMessage = date("Y/m/d H.i.s");

    $messageDao = new MessageDao($dataBase);

    $answerDao = new AnswerDao($dataBase);

    $likeDao = new LikeDao($dataBase);

    if (isset($_REQUEST['newMessage']) && ($_REQUEST['newMessage'] != "")){
        $messageDao->newMessage($dateMessage, $_SESSION['user_id'], $_REQUEST['newMessage']);
    };

    if (isset($_REQUEST['newAnswer']) && ($_REQUEST['newAnswer'] != "") && (isset($_REQUEST['message_id'] ))){
        $answerDao->newAnswer($dateMessage, $_SESSION['user_id'], $_REQUEST['newAnswer'], $_REQUEST['message_id']);
    };

    $viewMessage = 10;

    if (isset($_REQUEST['page'])) {
        $p = $_REQUEST['page'];
    }
    else {
        $p = 1;
        $_REQUEST['page'] = $p;
    };

    $numPost = $_REQUEST['page'] * $viewMessage - $viewMessage;

    $messages = $messageDao->getMessages($numPost, $viewMessage);

    $countMessage = $messageDao->getCountMessage();
    $resultCountMessage = $countMessage->countMessage;
    $countPage = ceil($resultCountMessage/$viewMessage);

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

    foreach ($messages as $message) {
        echo '<div class="post container">
                    <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="' . $message->avatar . 'alt="user image">
                        <span class="username">
                            <a href="#">' . $message->name . ' ' . $message->familyname . '</a>                                   
                        </span>
                        <span class="description">Опубликовано - ' . $message->date . '</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        ' . $message->message . '
                    </p>
                    <ul class="list-inline container">';

        $answers = $answerDao->getAnswersByMessage($message->id);

        $resultAnswerCount = count($answers);

        $countlikes = $likeDao->getCountLikeByMessage($message->id);

        if (isset($_SESSION['user_id'])) {

            $findLike = $likeDao->getWhoLikeByMessageByUser($message->id, $_SESSION['user_id']);

            echo        '<li>
                            <span class="badge" id="badgeId-' . $message->id . '">' . $countlikes->countLike . '</span>
                                <button id="buttonId-' . $message->id . '" data-idMessage="' . $message->id . '"
                                        class="';

            if ($findLike->likeByUser != 1){
                echo 'likeButton btn btn-info btn-sm';
            }
            else{
                echo 'likeButton btn btn-danger btn-sm';
            }

            echo                                                            '">   
                                    <i class="far fa-thumbs-up" ></i> Like
                                </button >
                        </li >';
        }
        else{
            echo        '<li>
                            <span class="badge" id="badgeId-' . $message->id . '">' . $countlikes->countLike . '</span>
                                    <i class="far fa-thumbs-up" ></i> Like
                        </li >';
        };

        echo            '<li class="pull-right">
                            <a href="#spoiler-' . $message->id . '" data-toggle="collapse" class="link-black text-sm">
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
                                <button type="submit"  class="btn btn-sm btn-primary btn-flat" name="message_id" value="' . $message->id . '">
                                                       <i class="fas fa-share-square"></i>
                                </button>
                            </span>
                            <input type="hidden" name="page" value="' . $p . '">
                        </div>
                    </form>';
        };
        echo '</div>
              <!-- /.post -->';

        if ($resultAnswerCount != 0) {
            echo '<div class="collapse container" id="spoiler-' . $message->id . '">
                                <div class="well">
                                    <div class="box box-warning direct-chat direct-chat-warning">
                                        <div class="box-body">
                                            <div class="direct-chat-messages">';

            foreach ($answers as $answer) {

                if ((isset($_SESSION['user_id'])) && ($_SESSION['user_id'] == $answer->user_id)) {
                    echo '
                                                    <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg">
                                                      <div class="direct-chat-info clearfix">
                                                        <span class="direct-chat-name pull-left">' .
                        $answer->name . ' ' . $answer->familyname . '
                                                        </span>
                                                        <span class="direct-chat-timestamp pull-right">' . $answer->date . '</span>
                                                      </div>
                                                      <!-- /.direct-chat-info -->
                                                      <img class="direct-chat-img" src="' . $answer->avatar . '" alt="message user image">
                                                      <!-- /.direct-chat-img -->
                                                      <div class="direct-chat-text">' .
                        $answer->answer . '
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
                        $answer->name . ' ' . $answer->familyname . '
                                                        </span>
                                                        <span class="direct-chat-timestamp pull-left">' . $answer->date . '</span>
                                                      </div>
                                                      <!-- /.direct-chat-info -->
                                                      <img class="direct-chat-img" src="' . $answer->avatar . '" alt="message user image">
                                                      <!-- /.direct-chat-img -->
                                                      <div class="direct-chat-text">
                                                        ' . $answer->date . '
                                                      </div>
                                                      <!-- /.direct-chat-text -->
                                                  </div>
                                                  <!-- /.direct-chat-msg -->';
                };

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
                                            <a href="index.php?page=' . ($_REQUEST['page'] - 1) . '">
                                                <i class="fas fa-chevron-circle-left"></i>
                                            </a>
                                         </li>';
    };

    $p = 0;

    if ($countPage <= 10) {
        while ($p++ < $countPage) {

            if ($_REQUEST['page'] == $p) {
                echo '<li class="active" ><a href="index.php?page=' . $p . '" >' . $p . '</a></li >';
            } else {
                echo '<li><a href="index.php?page=' . $p . '" >' . $p . '</a></li >';
            };

        };
    }
    else{
        switch ($_REQUEST['page']){
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
                $arrayBiggerTen = array( 1, 'null',($_REQUEST['page'] - 1), $_REQUEST['page'], ($_REQUEST['page'] + 1), 'null', $countPage);
                break;
        };

        foreach ($arrayBiggerTen as $valueArrayPage) {

            if ($_REQUEST['page'] == $valueArrayPage) {
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

    if ($_REQUEST['page'] == $countPage) {
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
                                            <a href="index.php?page=' . ($_REQUEST['page'] + 1) . '">
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
                                </nav>';

?>