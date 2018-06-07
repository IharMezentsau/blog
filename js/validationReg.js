    $("#regBtn").click(function(e) {
        e.preventDefault();
        var dataEMail = $("#eMailReg").val();
        var dataNameId = $("#nameId").val();
        var dataPassword = $("#passwordReg").val();
        var data = {eMailReg:dataEMail, nameId:dataNameId, passwordReg:dataPassword};
        $.ajax({
            type: 'POST',
            url: 'registration.php',
            data: JSON.stringify(data),
        }, "json");
    });
