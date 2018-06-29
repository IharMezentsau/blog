<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Б - Блог</title>

    <link rel="stylesheet" href="lib/node_modules/bootstrap3/dist/css/bootstrap.css" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="lib/node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="lib/node_modules/jquery.formvalid/src/jquery.formValid.csss">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

</head>
<body>
    <?php
        session_start();
        include_once ('bd.php');
        include_once ('validAuth.php');
        include_once ('menu.php');
        include_once ('blog.php');
        include_once ('regForm.php');
    ?>

    <!--<script src="js/validationReg.js" type="text/javascript"></script>-->
    <script src="lib/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="lib/node_modules/bootstrap3/dist/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>


    <!--<script src="js/validator.js"></script>-->


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-tooltip="tooltip"]').tooltip();
        });
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