<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$database = "scc_clinico";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consulta_id = $_POST['consulta_id'];
    $valor = $_POST['valor'];
    $metodo_pagamento = $_POST['metodo_pagamento'];
    $data_pagamento = $_POST['data_pagamento'];
    $status_pagamento = "Pendente";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO pagamento (consulta_id_consulta, valor, metodo_pagamento, data_pagamento, status_pagamento) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idsss", $consulta_id, $valor, $metodo_pagamento, $data_pagamento, $status_pagamento);
    
    if ($stmt->execute()) {
        print "Pagamento salvo com sucesso!";
    } else {
        echo "Erro ao salvar pagamento: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pagamento</title>
</head>
<body>
    <h2>Registrar Pagamento</h2>
    <form method="post" action="">
        <label for="consulta_id">ID da Consulta:</label>
        <input type="number" name="consulta_id" required><br>
        
        <label for="valor">Valor:</label>
        <input type="text" name="valor" required><br>
        
        <label for="metodo_pagamento">Método de Pagamento:</label>
        <select name="metodo_pagamento" required>
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Cartão de Débito">Cartão de Débito</option>
            <option value="Pix">Pix</option>
            <option value="Boleto">Boleto</option>
        </select><br>
        
        <label for="data_pagamento">Data do Pagamento:</label>
        <input type="date" name="data_pagamento" required><br>
        
        <button type="submit">Salvar Pagamento</button>
    </form>
</body>
</html>
