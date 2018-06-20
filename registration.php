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
                    $passwordHash = md5($password);
                    $date = date("Y/m/d H.i.s");

                    $length = 255;
                    $chartypes = "all";


                    function random_string($length, $chartypes)
                    {
                        $chartypes_array=explode(",", $chartypes);
                        // задаем строки символов.
                        //Здесь вы можете редактировать наборы символов при необходимости
                        $lower = 'abcdefghijklmnopqrstuvwxyz'; // lowercase
                        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // uppercase
                        $numbers = '1234567890'; // numbers
                        $special = '^@*+-+%()!?'; //special characters
                        $chars = "";
                        // определяем на основе полученных параметров,
                        //из чего будет сгенерирована наша строка.
                        if (in_array('all', $chartypes_array)) {
                            $chars = $lower . $upper. $numbers . $special;
                        } else {
                            if(in_array('lower', $chartypes_array))
                                $chars = $lower;
                            if(in_array('upper', $chartypes_array))
                                $chars .= $upper;
                            if(in_array('numbers', $chartypes_array))
                                $chars .= $numbers;
                            if(in_array('special', $chartypes_array))
                                $chars .= $special;
                        }
                        // длина строки с символами
                        $chars_length = strlen($chars) - 1;
                        // создаем нашу строку,
                        //извлекаем из строки $chars символ со случайным
                        //номером от 0 до длины самой строки
                        $string = $chars{rand(0, $chars_length)};
                        // генерируем нашу строку
                        for ($i = 1; $i < $length; $i = strlen($string)) {
                            // выбираем случайный элемент из строки с допустимыми символами
                            $random = $chars{rand(0, $chars_length)};
                            // убеждаемся в том, что два символа не будут идти подряд
                            if ($random != $string{$i - 1}) $string .= $random;
                        }
                        // возвращаем результат
                        return $string;
                    };

                    $validString = random_string($length, $chartypes);


                    $query = ("SELECT email FROM t_user WHERE email = '".$login."'");
                    $sql = mysqli_query($link ,$query) or die (mysqli_error());

                    if (mysqli_num_rows($sql) > 0){
                        echo 'NOT UNIQUE EMAIL';
                    }
                    else {
                        if (isset($_REQUEST["newUserName"])) {
                            $userName = $_REQUEST["newUserName"];
                            $query = "INSERT INTO t_user (email, password, name, date, validstring, validreg) VALUES ('" . $login . "','" . $passwordHash . "','" . $userName . "','" . $date . "','" . $validString . "','" . "FALSE" . "')";
                            $result = mysqli_query($link, $query) or die(mysqli_error());
                            echo "SUCCESS";
                        }
                        else {
                            $query = "INSERT INTO t_user (email, password, date, validstring, validreg) VALUES ('" . $login . "','" . $passwordHash . "','" . $date . "','" . $validString . "','" . "FALSE" . "')";
                            $result = mysqli_query($link, $query) or die(mysqli_error());
                            echo "SUCCESS";
                        }
                    }

                }
            };


        ?>
    </body>
</html>