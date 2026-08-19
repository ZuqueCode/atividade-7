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

$usuarios = $conexao->query("SELECT * FROM usuarios ORDER BY nome");

// Listar pratos com o nome do usuário responsável
$pratos = $conexao->query("
    SELECT pratos.*, usuarios.nome AS usuario_nome
    FROM pratos
    JOIN usuarios ON pratos.usuario_id = usuarios.id
    ORDER BY pratos.id DESC
");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pratos</title>
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

    <h2>Cadastrar Prato</h2>
    <?php if ($erro): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Usuário responsável</label>
        <select name="usuario_id">
            <option value="">Selecione</option>
            <?php while ($u = $usuarios->fetch_assoc()): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Nome do prato</label>
        <input type="text" name="nome">

        <label>Descrição</label>
        <textarea name="descricao"></textarea>

        <label>Preço</label>
        <input type="number" step="0.01" name="preco">

        <label>Categoria</label>
        <input type="text" name="categoria">

        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <h2>Pratos Cadastrados</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Usuário</th>
            <th>Ações</th>
        </tr>
        <?php while ($p = $pratos->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['usuario_nome']) ?></td>
            <td class="acoes">
                <a href="editar_prato.php?id=<?= $p['id'] ?>">Editar</a>
                <a href="pratos.php?excluir=<?= $p['id'] ?>" onclick="return confirm('Excluir este prato?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>