<?php
require 'conexao.php';

$erro = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $categoria = trim($_POST['categoria']);
    $usuario_id = $_POST['usuario_id'];

    if ($nome == '' || $preco == '' || $categoria == '' || $usuario_id == '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        $sql = $conexao->prepare("INSERT INTO pratos (nome, descricao, preco, categoria, usuario_id) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param('ssdsi', $nome, $descricao, $preco, $categoria, $usuario_id);
        $sql->execute();
        header('Location: pratos.php');
        exit;
    }
}


if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = $conexao->prepare("DELETE FROM pratos WHERE id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();
    header('Location: pratos.php');
    exit;
}
