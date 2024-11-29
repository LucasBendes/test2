<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "INSERT INTO PRODUTOS (nome, descricao, preco, estoque) VALUES (:nome, :descricao, :preco, :estoque)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':estoque' => $estoque
        ]);
        echo "Produto cadastrado com sucesso!";
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
