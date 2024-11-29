<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO CLIENTES (nome, email, senha, endereco, cep, telefone) VALUES (:nome, :email, :senha, :endereco, :cep, :telefone)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':endereco' => $endereco,
            ':cep' => $cep,
            ':telefone' => $telefone
        ]);
        echo "Cliente cadastrado com sucesso!";
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
