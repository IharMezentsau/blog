alert("11");
function checkPassword() {
    alert("11");
    var stringPassword = document.getElementById("passwordReg");
    var stringConfirmPassword = document.getElementById("validPasswordReg");
    if ((stringPassword != "") && (stringPassword.length >5) && (stringConfirmPassword != "")){

        alert("11");
}
function enterPassword() {
    var errorMessage;
    var submitKeyMessage;
    if (document.getElementById("passwordReg") == document.getElementById("validPasswordReg")){
        errorMessage = document.getElementById("error");
        submitKeyMessage = document.getElementById("submitKey");
        if(errorMessage != undefined){
            errorMessage.parentNode.removeChild(errorMessage);
        }
        if(submitKeyMessage != undefined){
            submitKeyMessage.parentNode.removeChild(submitKeyMessage);
        }
        if (document.getElementById("submitKey") == undefined) {
            var k = document.createElement("input");

            k.setAttribute("type", "submit");
            k.setAttribute("name", "submit");
            k.setAttribute("value", "submit");
            k.setAttribute("id", "submitKey");
            document.getElementById("form_id").appendChild(k);
        }
    }
    else{
        errorMessage = document.getElementById("error");
        submitKeyMessage = document.getElementById("submitKey");

        if(submitKeyMessage != undefined){
            submitKeyMessage.parentNode.removeChild(submitKeyMessage);
        };

        if(errorMessage==undefined){
            var k = document.createElement("h2");
            k.setAttribute("id", "error");

            var k1 = document.createTextNode("wrong confirm password");
            k.appendChild(k1);
            document.body.appendChild(k);
        }
    }
}