<!DOCTYPE html>
<html lang="ru">
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Б - Профиль</title>

        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

    </head>
    <body>
        <?php
            session_start();
            include_once ('bd.php');
            include_once ('menu.php');

            // Пути загрузки файлов
            $path = 'img/ava/';
            $tmp_path = 'tmp/';
            // Массив допустимых значений типа файла
            $types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
            // Максимальный размер файла
            $size = 10240000;


            // Обработка запроса
            if (isset($_REQUEST['editProfile'])) {
                $dateAva = date("Y_m_d_H_i_s");
                $fileExtension = pathinfo($_FILES['avatarAcc']['name'], PATHINFO_EXTENSION);
                $nameAva = $_SESSION['user_id'] . $dateAva . "." . $fileExtension;

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
                    $queryAccauntImg = "UPDATE t_user SET
                                        avatar = '" . $path . $nameAva . "'
                            WHERE `id`=". $_SESSION['user_id'] ."
                            LIMIT 1";
                    $accaunt = mysqli_query($link, $queryAccauntImg) or trigger_error(mysqli_error().$queryAccauntImg);
                };



            };

            $queryAccaunt = "SELECT email, password, name, familyname, date, avatar, sex
                            FROM t_user
                            WHERE `id`='". $_SESSION['user_id'] ."'
                            LIMIT 1";
            $accaunt = mysqli_query($link, $queryAccaunt) or trigger_error(mysqli_error().$queryAccaunt);

            while ($row = mysqli_fetch_assoc($accaunt)) {
                    echo '<div class="container">
                            <div class="item">
                                <div class="thumbnail">
                                    <img src="';
                    if ($row['avatar'] != null) {
                        echo $row['avatar'];
                    }
                    else {
                        if ($row['sex'] == 'M') {echo 'img/male.jpg';}
                        elseif ($row['sex'] == 'F') {echo 'img/female.jpg';}
                        elseif ($row['sex'] == 'U') {echo 'img/unknow.jpg';};
                    };
                    echo                                            '" alt="" class="img-circle img-responsive">
                                    <form enctype="multipart/form-data"  method="post" action="profile.php">
                                        Аватар: <input type="file" name="avatarAcc" accept="image/*" title="Выбрать аватар">
                                        <button type="submit" name="editProfile"  class="btn btn-primary">
                                            <i class="fas fa-file-upload"></i> Загрузить аватар
                                        </button>
                                    </form>
                                    <div class="caption">
                                        <h3><a href="#">Название нашего поста</a></h3>
                                        <p>Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren </p>
                                        <a href="#" class="btn btn-success">Подробнее <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                
                        </div>';
            };
        ?>



        <!--<script src="js/validationReg.js" type="text/javascript"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
        <script src="js/validator.js"></script>
        <script src="http://gregpike.net/demos/bootstrap-file-input/bootstrap.file-input.js"></script>

        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-tooltip="tooltip"]').tooltip();
            });
            $('input[type=file]').bootstrapFileInput();
            $('.file-inputs').bootstrapFileInput();
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