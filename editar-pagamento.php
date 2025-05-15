<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$database = "scc_clinico";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pagamento_id = $_POST["pagamento_id"];
    $valor = $_POST["valor"];
    $metodo_pagamento = $_POST["metodo_pagamento"];
    $data_pagamento = $_POST["data_pagamento"];
    $status_pagamento = $_POST["status_pagamento"];

    $sql = "UPDATE pagamento SET valor = ?, metodo_pagamento = ?, data_pagamento = ?, status_pagamento = ? WHERE id_pagamento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsssi", $valor, $metodo_pagamento, $data_pagamento, $status_pagamento, $pagamento_id);
    
    if ($stmt->execute()) {
        echo "Pagamento atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar pagamento: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pagamento</title>
</head>
<body>
    <h2>Editar Pagamento</h2>
    <form method="post" action="">
        <label for="pagamento_id">ID do Pagamento:</label>
        <input type="number" name="pagamento_id" required><br>
        
        <label for="valor">Valor:</label>
        <input type="number" step="0.01" name="valor" required><br>
        
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
        
        <label for="status_pagamento">Status do Pagamento:</label>
        <select name="status_pagamento">
            <option value="Pendente">Pendente</option>
            <option value="Pago">Pago</option>
            <option value="Cancelado">Cancelado</option>
        </select><br>
        
        <button type="submit">Atualizar Pagamento</button>
    </form>
</body>
</html>
