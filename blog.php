<?php

    $resultMessage = mysqli_query($link, 'SELECT * FROM blog_user.t_message INNER JOIN 
                                                blog_user.t_user ON blog_user.t_message.user_id = blog_user.t_user.id;');

    $resultAnswer = mysqli_query($link, 'SELECT * FROM blog_user.t_answer_message INNER JOIN 
                                                blog_user.t_user ON blog_user.t_answer_message.user_id = blog_user.t_user.id
                                                INNER JOIN blog_user.t_message ON 
                                                blog_user.t_answer_message.message_id = blog_user.t_message.id;');

    while ($row = mysqli_fetch_assoc($resultMessage)){
    echo '<div class="container masonry" data-columns>
            <div class="item">
                <div class="thumbnail">
                    <div class="caption">
                        <p>' . $row['blog_user.t_message.message'] . '</p>' .
                        '<div class="container">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <h5>' . $row['blog_user.t_user.name'] . '</h5>' .
                            '</div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <h5>' . $row['blog_user.t_message.date'] . '</h5>' .
                            '</div>
                        </div>
                        <a href="#spoiler-1" data-toggle="collapse" class="btn btn-primary collapsed spoiler">Ответ</a>
                        <div class="collapse" id="spoiler-1">
                            <div class="well">';
        while ($row = mysqli_fetch_assoc($resultAnswer)){
                        echo '<div class="container masonry" data-columns>
                                <div class="item">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <p>' . $row['blog_user.t_answer_message.answer'] . '</p>' .
                                            '<div class="container">
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                    <h5>' . $row['blog_user.t_user.name'] . '</h5>' .
                                                '</div>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                    <h5>' . $row['blog_user.t_answer_message.date'] . '</h5>' .
                                                '</div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>';};
    echo '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';};


//<div class="container masonry" data-columns>
   // <div class="item">
      //  <div class="thumbnail">
        //    <div class="caption">
                //<p>Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren </p>
                //<div class="container">
                    //<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        //<h5>
                        //    Автор
                      //  </h5>
                    //</div>
                   // <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                   // </div>
                 //   <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                        //<h5>
                      //      Дата
                    //    </h5>
                  //  </div>
                //</div>
                //<a href="#spoiler-1" data-toggle="collapse" class="btn btn-primary collapsed spoiler">Ответ</a>
                //<div class="collapse" id="spoiler-1">
              //      <div class="well">
            //            <p>Параграф с текстом</p>
          //          </div>
        //        </div>
      //      </div>
    //    </div>
  //  </div>
//</div>
            ?>