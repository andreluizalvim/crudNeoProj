
$(document).ready(function(){
    $("#addnew").on('click',function(){
        $("#tabela").modal('show');
    });
});



function salvarDados(key){
    var usuario=$("#usuario");
    var senha=$("#senha");
    var email=$("#email");
    var cpf=$("#cpf");

    if(isNotEmpty(usuario) && isNotEmpty(senha) && isNotEmpty(email) && isNotEmpty(cpf)){
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: ID,
                usuario: usuario.val(),
                senha: senha.val(),
                email: email.val(),
                cpf: cpf.val(),
            },
            success: function (response) {
                alert(response);
            }
        });
    }
}

function isNotEmpty(caller){
    if (caller.val()==''){
        caller.css('border','1px solid red');
        return false;
    } else
        caller.css('border','');

        return true;
}