<?php
require 'conexao.php';

$erro = '';

// Cadastrar usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    if ($nome == '' || $email == '') {
        $erro = 'Preencha todos os campos.';
    } else {
        $sql = $conexao->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
        $sql->bind_param('ss', $nome, $email);
        $sql->execute();
        header('Location: usuarios.php');
        exit;
    }
}

// Listar usuários
$usuarios = $conexao->query("SELECT * FROM usuarios ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>