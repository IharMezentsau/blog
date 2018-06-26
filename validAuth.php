<?php
    if (isset($_POST['userName']) && isset($_POST['userPassword']))
    {
        $login = mysqli_real_escape_string($link, $_POST['userName']);
        $password = md5($_POST['userPassword']);

        // делаем запрос к БД
        // и ищем юзера с таким логином и паролем

        $query = "SELECT *
                    FROM t_user
                    WHERE `email`='". $login ."' AND `password`='". $password ."'
                    LIMIT 1";
        $sql = mysqli_query($link, $query) or trigger_error(mysqli_error().$query);

        // если такой пользователь нашелся
        if (mysqli_num_rows($sql) == 1) {
            // то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)

            $row = mysqli_fetch_assoc($sql);
            $_SESSION['user_id'] = $row['id'];

            // не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
        }
        else {
            header('Location:authorisation.php');
            die();
        }
    };

?>