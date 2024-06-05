<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            header('Location: home.php');
        } else {
            echo "Email ou senha incorretos.";
        }
    } elseif (isset($_POST['register'])) {
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmSenha = $_POST['confirmSenha'];

        if ($senha == $confirmSenha) {
            $sql = "INSERT INTO usuario (nomeCompleto, email, senha) VALUES ('$nomeCompleto', '$email', '$senha')";
            if ($conn->query($sql) === TRUE) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "As senhas não coincidem.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit" name="login">Login</button>
        </form>
        <h2>Cadastro</h2>
        <form method="POST">
            <input type="text" name="nomeCompleto" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="password" name="confirmSenha" placeholder="Confirme a Senha" required>
            <button type="submit" name="register">Cadastrar</button>
        </form>
    </div>
</body>
</html>