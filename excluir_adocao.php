<?php
include "conexao.php";
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    $usuario_id = $_SESSION['usuario_id'];
    $adocao_id = $_GET['id'];

    $verificar_permissao = "SELECT usuario_id FROM adocao WHERE id = ?";
    $stmt = $conn->prepare($verificar_permissao);
    $stmt->bind_param("i", $adocao_id);
    $stmt->execute();
    $stmt->bind_result($publicador_id);
    $stmt->fetch();
    $stmt->close();

    if ($usuario_id == $publicador_id) {
        $excluir_sql = "DELETE FROM adocao WHERE id = ?";
        $stmt = $conn->prepare($excluir_sql);
        $stmt->bind_param("i", $adocao_id);

        if ($stmt->execute()) {
            header("Location: adocao.php");
        } else {
            echo "Erro ao excluir a adoção: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Você não tem permissão para excluir esta adoção.";
    }
} else {
    header("Location: login.html");
    exit();
}
