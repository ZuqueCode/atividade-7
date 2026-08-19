<?php
require 'conexao.php';

$id = $_GET['id'];
$erro = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $categoria = trim($_POST['categoria']);
    $usuario_id = $_POST['usuario_id'];

    if ($nome == '' || $preco == '' || $categoria == '' || $usuario_id == '') {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        $sql = $conexao->prepare("UPDATE pratos SET nome=?, descricao=?, preco=?, categoria=?, usuario_id=? WHERE id=?");
        $sql->bind_param('ssdsii', $nome, $descricao, $preco, $categoria, $usuario_id, $id);
        $sql->execute();
        header('Location: pratos.php');
        exit;
    }
}

$sql = $conexao->prepare("SELECT * FROM pratos WHERE id = ?");
$sql->bind_param('i', $id);
$sql->execute();
$prato = $sql->get_result()->fetch_assoc();


$usuarios = $conexao->query("SELECT * FROM usuarios ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Prato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <nav>
        <a href="index.php">Início</a>
        <a href="usuarios.php">Usuários</a>
        <a href="pratos.php">Pratos</a>
        <a href="pratos_usuario.php">Pratos por Usuário</a>
    </nav>
    <hr>

    <h2>Editar Prato</h2>
    <?php if ($erro): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Usuário responsável</label>
        <select name="usuario_id">
            <?php while ($u = $usuarios->fetch_assoc()): ?>
                <option value="<?= $u['id'] ?>" <?= $u['id'] == $prato['usuario_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['nome']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Nome do prato</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($prato['nome']) ?>">

        <label>Descrição</label>
        <textarea name="descricao"><?= htmlspecialchars($prato['descricao']) ?></textarea>

        <label>Preço</label>
        <input type="number" step="0.01" name="preco" value="<?= $prato['preco'] ?>">

        <label>Categoria</label>
        <input type="text" name="categoria" value="<?= htmlspecialchars($prato['categoria']) ?>">

        <button type="submit">Salvar Alterações</button>
    </form>
</div>
</body>
</html>
