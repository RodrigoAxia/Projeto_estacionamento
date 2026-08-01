<?php

// $host = "localhost";
// $usuario = "root";
// $senha = "";
// $banco = "meu_banco";

// $conn = new mysqli($host, $usuario, $senha, $banco);

// if ($conn->connect_error) {
//     die("Erro de conexão: " . $conn->connect_error);
// }

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

    $diretorio = "uploads/";

    // Cria a pasta caso não exista
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $nomeOriginal = $_FILES['imagem']['name'];
    $tmp = $_FILES['imagem']['tmp_name'];

    // Gera nome único
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    $novoNome = uniqid() . "." . $extensao;

    $caminho = $diretorio . $novoNome;

    // Validação simples
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($extensao, $extensoesPermitidas)) {
        die("Formato de arquivo não permitido.");
    }

    if (move_uploaded_file($tmp, $caminho)) {

        echo $novoNome;

        // $stmt = $conn->prepare(
        //     "INSERT INTO imagens (nome_arquivo) VALUES (?)"
        // );

        // $stmt->bind_param("s", $novoNome);

        // if ($stmt->execute()) {
        //     echo "Imagem enviada com sucesso!";
        // } else {
        //     echo "Erro ao gravar no banco.";
        // }

        // $stmt->close();

    } else {
        echo "Erro ao mover arquivo.";
    }

} else {
    echo "Nenhuma imagem enviada.";
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload de Imagem</title>
</head>
<body>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label>Selecione uma imagem:</label>
    <input type="file" name="imagem" accept="image/*" required>
    <button type="submit">Enviar</button>
</form>

<img src="./uploads/" alt="">

</body>
</html>