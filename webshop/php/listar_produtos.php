<?php
require 'db_connect.php';

$sql = "SELECT * FROM PRODUTOS";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($produtos as $produto) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($produto['nome']) . "</h3>";
    echo "<p>" . htmlspecialchars($produto['descricao']) . "</p>";
    echo "<p>Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
    echo "<p>Estoque: " . $produto['estoque'] . "</p>";
    echo "<a href='adicionar_carrinho.php?id=" . $produto['id'] . "'>Adicionar ao Carrinho</a>";
    echo "</div>";
}
?>
