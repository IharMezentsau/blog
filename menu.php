<!--<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                <span class="sr-only">Открыть навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Логотип</a>
        </div>
        <div class="collapse navbar-collapse" id="responsive-menu">
            <ul class="nav navbar-nav">
                <li><a href="#">Пункт 1</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Пункт 2 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Пункт 1</a></li>
                        <li><a href="#">Пункт 2</a></li>
                        <li><a href="#">Пункт 3</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Пункт 4</a></li>
                    </ul>
                </li>
                <li><a href="#">Пункт 3</a></li>
                <li><a href="#">Пункт 4</a></li>
            </ul>
            <form action="" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="E-mail" value="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Пароль" value="">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> ВОЙТИ
                </button>
            </form>
        </div>
    </div>
</div>-->

<header class="main-header">
            <!-- Header Navbar: style can be found in header.less -->

            <nav class="navbar navbar-inverse navbar-static-top">

                    <div class="navbar-header">
<?php

    if (!isset($_SESSION['user_id'])){
        echo '          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                            <span class="sr-only">Открыть навигацию</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>';
    };
?>
                        <a class="navbar-brand" href="index.php">Б</a>
                    </div>

                    <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">



<?php
    if (isset($_POST['authorisation']) && ($_POST['authorisation'] == 'logout')){
        session_unset();
        session_destroy();
    };
    if (isset($_SESSION['user_id'])) {
        $resultUser = mysqli_query($link, 'SELECT t_user.avatar AS avatar,
                                                        t_user.sex AS sex,
                                                        t_user.name AS name,
                                                        t_user.familyname AS familyname
                                                        FROM t_user WHERE 
                                                        t_user.id = ' . $_SESSION['user_id'] . ';');

        echo                '<li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="';
        while ($row = mysqli_fetch_assoc($resultUser)) {

            if ($row['avatar'] != null) {
                echo $row['avatar'];
                $userAvatar = $row['avatar'];
                } else {
                if ($row['sex'] == 'M') {
                    echo 'img/male.jpg';
                    $userAvatar = 'img/male.jpg';
                }
                elseif ($row['sex'] == 'F') {
                    echo 'img/female.jpg';
                    $userAvatar = 'img/female.jpg';
                }
                elseif ($row['sex'] == 'U') {
                    echo 'img/unknow.jpg';
                    $userAvatar = 'img/unknow.jpg';
                };
            };
            $userFullName = $row['name'] . ' ' . $row['familyname'];

            echo                                            '" class="user-image" alt="User Image">';
            echo                        '<span class="hidden-xs"> ' . $row['name'] . ' ' . $row['familyname'] . '</span>';
        };

        echo '
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="' .  $userAvatar . '" class="img-circle" alt="User Image">
    
                                        <p>
                                            ' . $userFullName . '
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <!---->
                                            <div class="pull-left">
                                                <a href="profile.php" class="btn btn-default"
                                                   data-tooltip="tooltip" title="Вход в личный кабинет"><i class="fas fa-user"></i> Профиль</a>
                                            </div>
                                            <div class="pull-right">
                                                <form action="index.php" name="authorisation" id="responsive-menu" method="post">
                                                    <button name="submit" class="btn btn-danger" type="submit" value="logOut">
                                                        <i class="fas fa-door-closed"></i> ВЫЙТИ
                                                    </button>
                                                    <input name="authorisation" class="form-control" type="hidden" value="logout">
                                                </form>
                                            </div>
                                       <!--  -->
                                    </li>
                                </ul>
                            </li>';
    }
    else {
            echo '         
                            <li>
                                <div class="collapse navbar-collapse" id="responsive-menu">
                                    <form action="index.php" name="authorisation" class="navbar-form navbar-right" 
                                            id="responsive-menu" method="post">
                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="userName" placeholder="E-mail" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="userPassword" placeholder="Пароль" value="">
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control">
                                            <i class="fas fa-sign-in-alt"></i> ВОЙТИ
                                        </button>
                                        <button type="button" data-toggle="modal" data-tooltip="tooltip" data-target="#registration"
                                                class="btn btn-info form-control" title="Регистрация" data-placement="bottom">
                                             <i class="far fa-address-card"></i>
                                        </button>
                                        
                                    </form>
                                </div>
                            </li>
                            
                            ';
    };
?>

                        <!-- Control Sidebar Toggle Button -->


                        </ul>

                    </div>

            </nav>
        </header>
