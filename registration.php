<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>My first blog REGISTRATION</title>
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">

        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
              integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

        <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

    </head>
    <body>
        <?php

            include_once ('bd.php');

            if (isset($_REQUEST['submit'])){

                $email = $_REQUEST['newEMailReg'];
                if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false)
                {
                    echo "email ok";   //все ОК, email правильный
                }
                else
                {
                    echo "email no ok";//проверка email на правильность НЕ пройдена
                };

                if (empty($_REQUEST['passwordReg'])) {
                    echo 'Enter Password!';
                }

                else {
                    $login = $_REQUEST["newEMailReg"];
                    $password = $_REQUEST["passwordReg"];


                    $query = ("SELECT email FROM blog_user.t_user WHERE email = '".$login."'");
                    $sql = mysqli_query($link ,$query) or die (mysqli_error());

                    if (mysqli_num_rows($sql) > 0){
                        echo 'NOT UNIQUE EMAIL';
                    }
                    else {
                        if (isset($_REQUEST["newUserName"])) {
                            $userName = $_REQUEST["newUserName"];
                            $query = "INSERT INTO blog_user.t_user (email, password, name) VALUES ('" . $login . "','" . $password . "','" . $userName . "')";
                            $result = mysqli_query($link, $query) or die(mysqli_error());
                            echo "SUCCESS";
                        }
                        else {
                            $query = "INSERT INTO blog_user.t_user (email, password, name) VALUES ('" . $login . "','" . $password . "',')";
                            $result = mysqli_query($link, $query) or die(mysqli_error());
                            echo "SUCCESS";
                        }
                    }

                }
            };

        ?>
    </body>
</html>