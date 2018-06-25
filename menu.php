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

    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Б</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="sr-only">Открыть меню</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <form action="index.php" name="authorisation" class="navbar-form navbar-right collapse navbar-collapse" id="responsive-menu" method="post">

                <?php
                    if (isset($_POST['authorisation']) && ($_POST['authorisation'] == 'logout')){

                        session_unset();
                        session_destroy();

                    };

                    if (isset($_SESSION['user_id'])) {
                        echo    '<div class="form-group">
                                    <button name="submit" class="form-control btn btn-primary" type="submit" value="logOut">
                                        <i class="fas fa-door-closed"></i> ВЫЙТИ
                                    </button>
                                </div>
                                <div class="form-group">
                                    <input name="authorisation" class="form-control" type="hidden" value="logout">
                                </div>';
                    }
                    else {
                        echo '  
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="userName" placeholder="E-mail" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="userPassword" placeholder="Пароль" value="">
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sign-in-alt"></i> ВОЙТИ
                                    </button>
                                    <button type="button" data-toggle="modal" data-tooltip="tooltip" data-target="#registration"
                                            class="btn btn-info" title="Регистрация" data-placement="bottom">
                                        <i class="far fa-address-card"></i>
                                    </button>';
                    };

                ?>

            </form>

        </div>

    </div>


<!--<div class="container">
    <div class="row">
        <div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                        <span class="sr-only">Открыть меню</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="responsive-menu">
                    <ul class="nav navbar-nav">
                        <li> <a href="">1</a> </li>
                        <li> <a href="">1</a> </li>
                        <li> <a href="">1</a> </li>
                        <li> <a href="">1</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>-->