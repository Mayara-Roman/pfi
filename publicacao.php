<?php
include "conexao.php";

session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    echo "Realize o login para acessar a página de publicação";
    exit();
} else {
    $nomeAnimal = $_POST['nomeAnimal'];
    $descricao = $_POST['descricao'];
    $loc = $_POST['loc'];
    $telefone = $_POST['telefone'];
    $imagem = $_FILES["foto"]["tmp_name"];

    $imagemBinaria = file_get_contents($imagem);

    $sql = "INSERT INTO adocao (nomeAnimal, descricao, loc, telefone, foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nomeAnimal, $descricao, $loc, $telefone, $imagemBinaria);

    if ($stmt->execute()) {
        echo "Descrição e imagem salvas no banco de dados com sucesso.";
    } else {
        echo "Erro ao salvar a descrição e a imagem no banco de dados: " . $stmt->error;
    }

    $stmt->close();
    header("Location: adocao.php");
}

$conn->close();
?>
