<?php
session_start();
include("config.php"); // Inclua a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "login") {
        // Processar login
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Usar prepared statements para evitar SQL Injection
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $_SESSION["user"] = $username;
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Usuário ou senha inválidos!');</script>";
        }
    } elseif (isset($_POST["action"]) && $_POST["action"] == "register") {
        // Processar registro
        $username = $_POST["reg_username"];
        $password = $_POST["reg_password"];

        // Verificar se o usuário já existe
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            echo "<script>alert('Usuário já existe!');</script>";
        } else {
            // Inserir o novo usuário
            $stmt = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
                echo "<script>alert('Usuário registrado com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao registrar usuário!');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
      <body> {
    background-color: #e0f7f5; /* Verde água suave */
    font-family: 'Arial', sans-serif;
    color: #2c6155; /* Verde escuro */
}
.container {
    margin-top: 50px;
}
.form-container {
    background-color: #ffffff; /* Branco puro */
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #cce7e4; /* Verde água claro */
}
.btn {
    border-radius: 5px;
    padding: 10px 20px;
    transition: all 0.3s ease;
}
.btn:hover {
    transform: scale(1.05);
}
.btn-register {
    margin-top: 20px;
    text-align: center;
}
.register-form {
    display: none;
}
.form-label {
    font-weight: bold;
    color: #3c7f73; /* Verde acinzentado */
}
.btn-primary {
    background-color: #20c997; /* Verde vibrante */
    border-color: #20c997;
}
.btn-primary:hover {
    background-color: #1aa17a; /* Verde mais escuro */
    border-color: #1aa17a;
}
.btn-link {
    color: #20c997;
    text-decoration: none;
}
.btn-link:hover {
    color: #1aa17a;
    text-decoration: underline;
}
.form-container h3 {
    color: #2c6155; /* Verde escuro */
    font-size: 24px;
    margin-bottom: 20px;
}
.footer {
    margin-top: 30px;
    text-align: center;
    font-size: 18px;
    color: #20c997; /* Verde vibrante */
}

    </style>
</head>
<body>
    <div class="container">
        <!-- Login Form -->
        <div class="row justify-content-center">
            <div class="col-md-4 form-container">
                <h3 class="text-center">Login</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="login">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>

                <div class="btn-register">
                    <a href="#" id="show-register" class="btn btn-link">Não tem uma conta? Registre-se</a>
                </div>
            </div>
        </div>

        <!-- Register Form (Initially hidden) -->
        <div class="row justify-content-center mt-4 register-form" id="register-form">
            <div class="col-md-4 form-container">
                <h3 class="text-center">Registrar Novo Usuário</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="register">
                    <div class="mb-3">
                        <label for="reg_username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="reg_username" name="reg_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="reg_password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="reg_password" name="reg_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </form>

                <div class="btn-register">
                    <a href="#" id="show-login" class="btn btn-link">Já tem uma conta? Faça login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle visibility between login and register form
        document.getElementById('show-register').addEventListener('click', function() {
            document.getElementById('register-form').style.display = 'block';
            document.querySelector('.row > .col-md-4').style.display = 'none'; // Hide login form
        });

        document.getElementById('show-login').addEventListener('click', function() {
            document.getElementById('register-form').style.display = 'none';
            document.querySelector('.row > .col-md-4').style.display = 'block'; // Show login form
        });
    </script>
</body>
</html>
