<?php
include "conexao.php";  

$sql = "SELECT * FROM denuncia";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $message = "Dados da tabela:\n\n";
    while ($row = $result->fetch_assoc()) {
        $message .= "ID: " . $row["id"] . "\n";
        $message .= "Crime: " . $row["crime"] . "\n";
        $message .= "Animal: " . $row["animal"] . "\n";
        $message .= "Frequência: " . $row["frequencia"] . "\n";
        $message .= "Descrição: " . $row["descricaoCrime"] . "\n";
        $message .= "Cidade: " . $row["cidade"] . "\n";
        $message .= "Bairro: " . $row["bairro"] . "\n";
        $message .= "Rua: " . $row["rua"] . "\n";
        $message .= "Descrição: " . $row["descricaoLoc"] . "\n";

    }

    $to = "mayaraalvesroman@gmail.com";
    $subject = "Dados da Tabela";

    $headers = "From: mayaraalvesroman@gmail.com";

    mail($to, $subject, $message, $headers);

    echo "E-mail enviado com sucesso.";
} else {
    echo "Nenhum dado encontrado na tabela.";
}

$conn->close();
?>
