<?php
session_start();
require 'db_connect.php';

if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];
    
    // Verifica se o carrinho já foi iniciado
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    
    // Consulta o produto
    $stmt = $pdo->prepare("SELECT * FROM PRODUTOS WHERE id = :id");
    $stmt->execute([':id' => $produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($produto) {
        // Verifica se o produto já está no carrinho
        if (isset($_SESSION['carrinho'][$produto_id])) {
            $_SESSION['carrinho'][$produto_id]['quantidade'] += 1;
        } else {
            $_SESSION['carrinho'][$produto_id] = [
                'nome' => $produto['nome'],
                'preco' => $produto['preco'],
                'quantidade' => 1
            ];
        }
        echo "Produto adicionado ao carrinho!";
    } else {
        echo "Produto não encontrado!";
    }
}
?>
