$('#form1').submit(function (e) {
    e.preventDefault();
    //Quando o formulário for enviado pelo input:submit, estamos pegando o evento e cancelando o reload
    //console.log("ta vinculado");


    //Caputarndo os campos recebido pelo form e atribuindo para variáveis do arquivo js

    var u_nome = $('#name').val(); // Capturando pelo id o campo do form.
    var u_comment = $('#comment').val(); // Capturando pelo id o campo do form.

    //console.log(u_nome, u_comment);  ##Acompanhando o recebimento dos dados.


    //Criando uma requisição ajax
    // Ao acionar precisa informar 4 parâmetros:
    $.ajax({
        url: 'http://localhost/jquery_ajax_lessons/inserir.php',
        method: 'POST',
        data: { name: u_nome, comment: u_comment }, // Enviando dados entre chaves -> key : value
        dataType: 'json'
    }).done(function (result) { //Quando realizar o processo, receber um resultado
        $('#name').val('');
        $('#comment').val('');
        getComments();
        console.log(result);
    });
});


// Função para trazer os comentários do banco para a tela
function getComments() {

    //Criando uma requisição ajax parecida com anterior

    $.ajax({
        url: 'http://localhost/jquery_ajax_lessons/selecionar.php',
        method: 'GET',
        dataType: 'json'
    }).done(function (result) {
        //console.log(result);
        var box_comm = document.querySelector('.box_comment');
        while (box_comm.firstChild) {
            box_comm.firstChild.remove();
        }

        for (i = 0; i < result.length; i++) {
            $('.box_comment').prepend('<div class="b_comm"><h4>' + result[i].name + '</h4><p>' + result[i].comment + '</p></div>');
        }
    });
}

getComments();