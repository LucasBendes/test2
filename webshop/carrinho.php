<?php
session_start();
require 'php/db_connect.php';

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Seu carrinho está vazio!";
    exit;
}

$total = 0;
echo "<h1>Carrinho de Compras</h1>";
echo "<table>";
echo "<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Total</th></tr>";

foreach ($_SESSION['carrinho'] as $produto_id => $item) {
    $subtotal = $item['preco'] * $item['quantidade'];
    $total += $subtotal;
    
    echo "<tr>";
    echo "<td>" . htmlspecialchars($item['nome']) . "</td>";
    echo "<td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>";
    echo "<td>" . $item['quantidade'] . "</td>";
    echo "<td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<p>Total: R$ " . number_format($total, 2, ',', '.') . "</p>";
echo "<a href='php/finalizar_compra.php'>Finalizar Compra</a>";
?>
