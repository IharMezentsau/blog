<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>My first blog</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

</head>
<body>

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

                <a href="#" class="btn btn-info" data-toggle="tooltip"
                   data-placement="bottom" title="Регистрация">
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
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10"></div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <h5>
                                Автор
                            </h5>
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





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>