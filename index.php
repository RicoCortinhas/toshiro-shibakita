PHP

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exemplo PHP</title>
</head>
<body>

<?php
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');

echo 'Versão Atual do PHP: ' . phpversion() . '<br>';

$servername = "192.168.15.14";
$username = "root";
$password = "Senha123";
$database = "banco1";

// Criar conexão
$link = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($link->connect_error) {
    die("Falha na conexão com o banco de dados: " . $link->connect_error);
}

$valor_rand1 = rand(1, 999);
$valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
$host_name = gethostname();

$query = "INSERT INTO dados (clienteID, nome, sobrenome, cpf, endereco, cidade, host) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($query);
$stmt->bind_param("issssss", $valor_rand1, $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2, $host_name);

if ($stmt->execute()) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro ao inserir registro: " . $stmt->error;
}

$stmt->close();
$link->close();

?>

</body>
</html>
