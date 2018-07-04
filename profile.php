<!DOCTYPE html>
<html lang="ru">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">


        <title>Б - Блог</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!--<link rel="stylesheet" href="lib/node_modules/bootstrap3/dist/css/bootstrap.css" type="text/css">-->
        <link rel="stylesheet" href="lib/node_modules/bootstrap3/dist/css/bootstrap.css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="lib/node_modules/@fortawesome/fontawesome-free/css/all.css">
        <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
        <link rel="stylesheet" href="lib/node_modules/admin-lte/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="lib/node_modules/admin-lte/dist/css/skins/skin-purple.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    </head>
    <body  class="hold-transition skin-purple sidebar-mini layout-top-nav">
        <?php
            session_start();
            $key = md5(uniqid(rand(),1));

            include_once ('bd.php');
            include_once ('menu.php');

            // Пути загрузки файлов
            $path = 'img/ava/';
            $tmp_path = 'tmp/';
            // Массив допустимых значений типа файла
            $types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
            // Максимальный размер файла
            $size = 10240000;

            if (isset($_REQUEST["deleteAvatar"])) {
                $queryAccaunt = "SELECT avatar
                                FROM t_user
                                WHERE `id`='". $_SESSION['user_id'] ."'
                                LIMIT 1";
                $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error().$queryAccaunt);
                while ($row = mysqli_fetch_assoc($accaunt)) {
                    if ($row['avatar'] != NULL) {
                        unlink($row['avatar']);
                    };
                };
                $queryAccauntImg = "UPDATE t_user SET avatar = NULL 
                                    WHERE `id`=" . $_SESSION['user_id'] . "
                                    LIMIT 1";
                $accaunt = mysqli_query($link, $queryAccauntImg) or trigger_error(mysqli_error() . $queryAccauntImg);

            };


        // Обработка запроса
            if (isset($_REQUEST['editProfile']) && ($_POST['editProfile'] == 'update')) {
                $dateAva = date("Y_m_d_H_i_s");
                $fileExtension = pathinfo($_FILES['avatarAcc']['name'], PATHINFO_EXTENSION);
                $nameAva = $_SESSION['user_id'] . $dateAva . "." . $fileExtension;
                if (is_uploaded_file($_FILES['avatarAcc']['tmp_name'])) {
                    // Проверяем тип файла
                    if (!in_array($_FILES['avatarAcc']['type'], $types)) {
                        die('Запрещённый тип файла. <a href="?">Попробовать другой файл?</a>');
                    };
                    // Проверяем размер файла
                    if ($_FILES['avatarAcc']['size'] > $size) {
                        die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');
                    };
                    // Загрузка файла и вывод сообщения
                    if (!@copy($_FILES['avatarAcc']['tmp_name'], $path . $nameAva)) {
                        echo 'Что-то пошло не так';
                    } else {
                        echo 'Загрузка удачна <a href="' . $path . $nameAva . '">Посмотреть</a> ';
                        $queryAccaunt = "SELECT avatar
                            FROM t_user
                            WHERE `id`='". $_SESSION['user_id'] ."'
                            LIMIT 1";
                        $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error().$queryAccaunt);
                        while ($row = mysqli_fetch_assoc($accaunt)){
                            if ($row['avatar'] != NULL) {
                                unlink($row['avatar']);
                            };
                        };
                        $queryAccauntImg = "UPDATE t_user SET
                                            avatar = '" . $path . $nameAva . "'
                                WHERE `id`=" . $_SESSION['user_id'] . "
                                LIMIT 1";
                        $accaunt = mysqli_query($link, $queryAccauntImg) or trigger_error(mysqli_error() . $queryAccauntImg);
                    };
                };


                if (($_REQUEST['userName']) != "") {
                    $queryAccaunt = "UPDATE t_user SET
                                            name = '" . $_REQUEST['userName'] . "'
                                WHERE `id`=" . $_SESSION['user_id'] . "
                                LIMIT 1";
                    $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error() . $queryAccaunt);
                };
                if (($_REQUEST['familyName']) != "") {
                    $queryAccaunt = "UPDATE t_user SET
                                            familyname = '" . $_REQUEST['familyName'] . "'
                                WHERE `id`=" . $_SESSION['user_id'] . "
                                LIMIT 1";
                    $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error() . $queryAccaunt);
                };
                if (($_POST['gender']) != "") {
                    $queryAccaunt = "UPDATE t_user SET
                                            sex = '" . $_REQUEST['gender'] . "'
                                WHERE `id`=" . $_SESSION['user_id'] . "
                                LIMIT 1";
                    $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error() . $queryAccaunt);
                };


            };

            $queryAccaunt = "SELECT email, password, name, familyname, date, avatar, sex
                            FROM t_user
                            WHERE `id`='". $_SESSION['user_id'] ."'
                            LIMIT 1";
            $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error().$queryAccaunt);



            while ($row = mysqli_fetch_assoc($accaunt)) {
                $options = array( 'U'=>'Скрыт', 'M'=>'Мужской', 'F'=>'Женский');
                $valueSex = $options[$row['sex']];

                    echo '<div class="conteiner">

                              <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile">
                                  <img class="profile-user-img img-responsive img-circle" src="';
                    if ($row['avatar'] != null) {
                        echo                                                                    $row['avatar'];
                    }
                    else {
                        if ($row['sex'] == 'M') {echo                                           'img/male.jpg';}
                        elseif ($row['sex'] == 'F') {echo                                       'img/female.jpg';}
                        elseif ($row['sex'] == 'U') {echo                                       'img/unknow.jpg';};
                    };
                    echo                                                                                        '" alt="User profile picture">';

                    if (isset($_POST['editProfile']) && ($_POST['editProfile'] == 'change')){
                        /*echo '<input class="form-control input-group-lg" autocomplete="off" name="newMessage" type="text" placeholder="Напишите сообщение">
                                <span class="input-group-btn">
                                    <button type="submit"  class="btn btn-group-lg btn-primary btn-flat btn-group" name="message_id" >
                                                           <i class="fas fa-share-square"></i>
                                    </button>
                                </span>';*/

                        echo        '<form enctype="multipart/form-data" class="form-horizontal" method="post" action="profile.php">
                                        
                                            <input type="file" accept="image/*" name="avatarAcc" id="selectedFile" style="display: none;" >
                                            <ul class="list-group list-group-unbordered">
                                                <li class="list-group-item">
                                                    <div class="btn-group btn-group-justified">';
                        if ($row['avatar'] != NULL) {
                            echo                '    <div class="btn-group">
                                                        <button type="submit" name="deleteAvatar"  class="btn btn-danger btn-block btn-group">
                                                            <i class="far fa-trash-alt"></i> Удалить аватар
                                                        </button>
                                                    </div>';
                        };
                        echo                           '<div class="btn-group">
                                                    <input type="button" value="Выбрать аватар" class="btn btn-default btn-block" 
                                                            onclick="document.getElementById(\'selectedFile\').click();">
                                                        </div>    
                                                    </div>
                                                    <p class="text-muted text-center" id="fileNameLoad"></p>  
                                                </li>
                                            </ul>          
                                        
                                        <h3 class="profile-username text-center">' . $row['name'] . ' ' . $row['familyname'] . '</h3>
                                        <p class="text-muted text-center">eMail: ' . $row['email'] . '</p>
                                        
                                        
                                              <div class="box-body">
                                                <div class="form-group">
                                                  <label for="inputName" class="col-sm-2 control-label">Имя</label>                                            
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="userName" id="inputName" placeholder="' . $row['name'] . '">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label for="inputFamilyName" class="col-sm-2 control-label">Фамилия</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="familyName" id="inputFamilyName" placeholder="' . $row['familyname'] . '">
                                                  </div>
                                                </div>
                                                <div class="form-group">
                                                  <label for="inputSex" class="col-sm-2 control-label">Пол</label>
                                                  <div class="col-sm-10">
                                                    <select name="gender" class="form-control" id="inputSex" size="3">';

                        foreach($options as $value=>$name) {
                            if($value == $row['sex']) {
                                echo                    '<option selected value="' . $value . '">' . $name . '</option>';
                            }
                            else {
                                echo                    '<option value="' . $value . '">' . $name . '</option>';
                            };
                        };

                    echo                            '</select>
                                                  </div>
                                                </div>
                                              </div>
      
                                              <!-- /.box-body -->
                                            <div class="box-footer">
                                                <button type="submit"  name="editProfile" value="cancel" class="btn btn-default">Отмена</button>
                                                <button type="submit" name="editProfile" value="update" class="btn btn-info pull-right">
                                                    <i class="fas fa-file-upload"></i> Обновить данные
                                                </button>
                                            </div>
                                              <!-- /.box-footer -->    
                                    
                                    </form>';
                    }
                    else {
                        echo            '<h3 class="profile-username text-center">' . $row['name'] . ' ' . $row['familyname'] . '</h3>
                        
                                        <p class="text-muted text-center">eMail: ' . $row['email'] . '</p>
                                            
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                              <b>Дата регистрации</b> <a class="pull-right">' . $row['date'] . '</a>
                                            </li>
                                            <li class="list-group-item">
                                              <b>Пол</b> <a class="pull-right">' . $valueSex . '</a>
                                            </li>
                                        </ul>
                                        <form enctype="multipart/form-data"  method="post" action="profile.php">
                                              <button type="submit" name="editProfile" value="change" class="btn btn-primary btn-block">
                                                    <b>Изменить данные</b>
                                              </button>
                                        </form>';

                    echo            '</div>
                                    <!-- /.box-body -->
                                  </div>
                                  <!-- /.box -->
                            
                                      <!-- About Me Box -->
                                      <div class="box box-primary">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">About Me</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                          <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                            
                                          <p class="text-muted">
                                            B.S. in Computer Science from the University of Tennessee at Knoxville
                                          </p>
                            
                                          <hr>
                            
                                          <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                            
                                          <p class="text-muted">Malibu, California</p>
                            
                                          <hr>
                            
                                          <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                            
                                          <p>
                                            <span class="label label-danger">UI Design</span>
                                            <span class="label label-success">Coding</span>
                                            <span class="label label-info">Javascript</span>
                                            <span class="label label-warning">PHP</span>
                                            <span class="label label-primary">Node.js</span>
                                          </p>
                            
                                          <hr>
                            
                                          <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                            
                                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.col -->';
                    };

            };



        ?>



        <!--<script src="js/validationReg.js" type="text/javascript"></script>-->
        <script src="lib/node_modules/jquery/dist/jquery.min.js"></script>
        <script src="lib/node_modules/bootstrap3/dist/js/bootstrap.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
        <script src="lib/node_modules/admin-lte/dist/js/adminlte.min.js"></script>
        <script src="lib/node_modules/admin-lte/dist/js/demo.js"></script>

        <!--<script src="js/validator.js"></script>-->

        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-tooltip="tooltip"]').tooltip();
            });
            $('#selectedFile').on('change', function (e) {
                console.log(e.target.files[0].name);
                $('#fileNameLoad').text(e.target.files[0].name);
            });
        </script>

        <script>
            // just for the demos, avoids form submit

            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });
            $("#formReg").validate({
                onsubmit: false,
                submitHandler: function(form) {
                    if ($(form).valid())
                    {
                        form.submit();
                    }
                    return false; // prevent normal form posting
                },
                rules: {
                    passwordReg: "required",
                    confirmPasswordReg: {
                        equalTo: "#passwordReg"
                    }
                }
            });
        </script>
        <!--<script src="js/validationReg.js"></script>-->

    </body>
</html>