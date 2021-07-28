<?php

    header('Content-Type: application/json'); //Cabeçalho para poder trabalhar com dados em json

    $pdo = new PDO('mysql:host=localhost; dbname=db-comment-ajax;', 'root', ''); // instânciando o pdo


    // Criando a query de Select para trazer os dados do banco
    $stmt = $pdo->prepare("SELECT * FROM comments");
    $stmt->execute();

    //Verificando se há retorno de dados
    if($stmt->rowCount() >= 1) {
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)); //retornando os dados convertidos em json
    } else {
        echo json_encode("Nenhum comentário salvo no banco."); //Caso o banco esteja vazio.
    }