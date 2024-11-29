function buscarCep(cep) {
    // Checa se o CEP tem 8 caracteres (formato válido)
    if (cep.length === 8) {
        // Faz a requisição para o PHP que consulta a API ViaCEP
        fetch(`php/buscar_cep.php?cep=${cep}`)
            .then(response => response.text())
            .then(data => {
                // Exibe o endereço retornado pela API
                document.getElementById('cep_result').innerHTML = data;
                // Preenche automaticamente os campos de endereço
                if (data.indexOf('erro') === -1) {
                    let dados = data.split('<br>');
                    document.getElementById('endereco').value = dados[0]; // Endereço
                }
            })
            .catch(error => {
                document.getElementById('cep_result').innerHTML = "Erro ao buscar o CEP.";
            });
    } else {
        document.getElementById('cep_result').innerHTML = "CEP inválido!";
    }
}