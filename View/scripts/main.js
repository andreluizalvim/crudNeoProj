var controllerURL = '../Controller/homeController.php';

$(document).ready(function(){
    $("#addnew").on('click',function(){
        $("#tabela").modal('show');
    });
});

    //save on submit
    $('#btnsave').click(function(event){
        event.preventDefault();
        var Usuario = $('#inpUsuario').val();
        var Email = $('#inpEmail').val();
        var Senha = $('#inpSenha').val();
        var CPF = $('#inpCPF').val();
        console.log(Usuario,Email,Senha,CPF);
        
        if(inputValidation(Usuario,Email,Senha,CPF)){
            $.POST(controllerURL,{
                'key': 'save',
                'Usuario' : Usuario,
                'Email': Email,
                'Senha': Senha,
                'CPF': CPF
            });
            $('#inpUsuario').val(null);
            $('#inpEmail').val(null);
            $('#inpSenha').val(null);
            $('#inpCPF').val(null);
            reloadTable();
        } else {
            alertify.alert("Controller nao linkado");
        }
});

function inputValidation(Usuario,Senha,CPF,Email){
    if(Usuario.length<3
    || Email.length<3
    || Senha.length<3
    || CPF.length<3
    ){
        alertify.alert("Preencha os campos corretamente, nenhum dos campos podem ter menos de 3 caracteres");
        return false;
    }
    else return true;
}

function loadTable(){
    $.getJSON(controllerURL,{'call':'renderTable'},function(response){
        console.log(response);
        renderTable(response);
    });
}
function reloadTable(){
    $('table').empty();
    loadTable();
}



// function salvarDados(key){
//     var usuario=$("#name");
//     var senha=$("#senha");
//     var email=$("#email");
//     var cpf=$("#cpf");

//     if(isNotEmpty(usuario) && isNotEmpty(senha) && isNotEmpty(email) && isNotEmpty(cpf)){
//         $.ajax({
//             url: '../Model/homeController.php',
//             method: 'POST',
//             dataType: 'text',
//             data: {
//                 key: key,
//                 usuario: usuario.val(),
//                 senha: senha.val(),
//                 email: email.val(),
//                 cpf: cpf.val(),
//             },
//             success: function (response) {
//                 alert(response);
//             }
//         });
//     }
//}
