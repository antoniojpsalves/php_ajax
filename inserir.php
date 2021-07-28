<?php

    header("Content-Type: application/json"); //Cabaçalho http para trabalhar dados por Json

    //recebendo os dados do javascript e atribuindo em variáveis para poder salvar depois.
    $name = $_POST['name'];
    $comment = $_POST['comment'];


    //Criando a conexão com o banco de dados usando uma instância do PDO.
    $pdo = new PDO("mysql:host=localhost; dbname=db-comment-ajax;", "root", "");

    //preparando o insert com bind value pra tratar os valores antes de enviar ao banco
    $stmt = $pdo->prepare("INSERT INTO comments (name, comment) VALUES (:na, :co)");

    //atribuindo o valor da variável $name à máscara :na
    $stmt->bindValue(':na', $name);

    //atribuindo o valor da variável $comment à máscara :co
    $stmt->bindValue(':co', $comment);

    //executando a query com os valores substituídos
    $stmt->execute();


    //verificando se foi inserido ao banco de dados

    if($stmt->rowCount() >= 1){
        echo json_encode("Comentário salvo com sucesso!");
    } else {
        echo json_encode("Falha ao salvar comentário.");
    }
