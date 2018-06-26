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
                                    <a href="profile.php" class="form-control btn btn-primary" data-tooltip="tooltip" 
                                                data-placement="bottom" title="Вход в личный кабинет"> 
                                            <i class="fas fa-user"></i> 
                                    </a>
                                </div>
                                <div class="form-group">
                                    <button name="submit" class="form-control btn btn-danger" type="submit" value="logOut">
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
