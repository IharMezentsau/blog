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

    <?php
        include_once ('menu.php');
    ?>

    <?php
        include_once ('blog.php')
    ?>

    <?php
        include_once ('regForm.php');
    ?>

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