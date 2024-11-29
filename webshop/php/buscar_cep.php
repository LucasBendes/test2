<?php
if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];
    $url = "https://viacep.com.br/ws/$cep/json/";

    $json = file_get_contents($url);
    $data = json_decode($json, true);

    if (isset($data['erro']) && $data['erro'] == true) {
        echo "CEP não encontrado!";
    } else {
        echo "Endereço: " . htmlspecialchars($data['logradouro']) . ", " . htmlspecialchars($data['bairro']) . " - " . htmlspecialchars($data['localidade']) . "/" . htmlspecialchars($data['uf']);
    }
}
?>
