<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>My first blog</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

</head>
<body>
    <?php
        session_start();
        include_once ('bd.php');
    ?>

    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand" href="#">Б</a>
            </div>

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
                <button type="button" data-toggle="modal" data-tooltip="tooltip" data-target="#registration"
                class="btn btn-info" title="Регистрация" data-placement="bottom">
                    <i class="far fa-address-card"></i>
                </a>
            </form>

            </div>

        </div>
    </div>


    <div class="container masonry" data-columns>
        <div class="item">
            <div class="thumbnail">
                <div class="caption">
                    <p>Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren Loren </p>
                    <div class="container">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h5>
                                Автор
                            </h5>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h5>
                                Дата
                            </h5>
                        </div>
                    </div>
                    <a href="#spoiler-1" data-toggle="collapse" class="btn btn-primary collapsed spoiler">Ответ</a>
                    <div class="collapse" id="spoiler-1">
                        <div class="well">
                            <p>Параграф с текстом</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="registration">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Регистрация нового пользователя</h4>
                </div>
                <div class="modal-body">
                    <form action="registration.php" id="formReg">
                        <div class="form-group">
                            <input type="text" id="eMailReg" name="newEMailReg" class="form-control" placeholder="Введите E-mail *" value="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="newUserName" id="nameId" placeholder="Введите Имя" value="">
                        </div>
                        <div class="form-group">
                            <input type="password" id="passwordReg" class="form-control" placeholder="Введите пароль *" value="" name="passwordReg">
                        </div>
                        <div class="form-group">
                            <input type="password" id="confirmPasswordReg" class="form-control" placeholder="Подтвердите пароль *" value="" name="confirmPasswordReg">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="regBtn" value="submit" name="submit" class="btn btn-primary">
                                <i class="fas fa-address-card"></i> Зарегистрироваться
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-body">
                    <p style="color: red">* Поля обязательные для заполнения</p>
                </div>
            </div>
        </div>
    </div>




    <!--<script src="js/validationReg.js" type="text/javascript"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
    <script src="js/validator.js"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-tooltip="tooltip"]').tooltip();
        });
    </script>

    <script>
        // just for the demos, avoids form submit
        $("#formReg").validate().cancelSubmit = true;
        $.tools.validator.localize("fi", {
            '*'          : 'Virheellinen arvo',
            ':email'     : 'Virheellinen s&auml;hk&ouml;postiosoite',
            ':number'    : 'Arvon on oltava numeerinen',
            ':url'       : 'Virheellinen URL',
            '[max]'      : 'Arvon on oltava pienempi, kuin $1',
            '[min]'      : 'Arvon on oltava suurempi, kuin $1',
            '[required]' : 'Kent&auml;n arvo on annettava'
        });
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $( "#formReg" ).validate({
            lang: 'fi',
            rules: {

                passwordReg: "required",
                confirmPasswordReg: {
                    equalTo: "#passwordReg"
                }
            }
        });
    </script>
    <script src="js/validationReg.js"></script>

</body>
</html>