<?php

include "conexao.php";

session_start();

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM dados WHERE email = '$email' AND senha = '$senha'";

    $resultado = $conn->query($sql);
    if ($resultado->num_rows==1) {
        $usuario = $resultado->fetch_assoc();
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $usuario['nome'];

        header('Location: perfil.php');
        
        exit();
    } else {
        echo "<script>alert('Email ou senha incorretos. Por favor, tente novamente.');";
        echo "window.location='login.html';</script>";
    }
?>