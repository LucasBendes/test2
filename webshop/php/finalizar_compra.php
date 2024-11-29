<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Seu carrinho está vazio!";
    exit;
}

$cliente_id = 1; // Substituir pelo ID do cliente logado
$total = 0;

// Calcula o total da compra
foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['preco'] * $item['quantidade'];
}

// Insere a compra no banco de dados
$sql = "INSERT INTO COMPRAS (cliente_id, total) VALUES (:cliente_id, :total)";
$stmt = $pdo->prepare($sql);
$stmt->execute([':cliente_id' => $cliente_id, ':total' => $total]);

// Recupera o ID da compra inserida
$compra_id = $pdo->lastInsertId();

// Insere os itens da compra
foreach ($_SESSION['carrinho'] as $produto_id => $item) {
    $sql = "INSERT INTO ITENS_COMPRA (compra_id, produto_id, quantidade, preco) VALUES (:compra_id, :produto_id, :quantidade, :preco)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':compra_id' => $compra_id,
        ':produto_id' => $produto_id,
        ':quantidade' => $item['quantidade'],
        ':preco' => $item['preco']
    ]);
}

// Esvazia o carrinho
unset($_SESSION['carrinho']);

echo "Compra finalizada com sucesso!";
?>
