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


<div class="container">
    <nav>
        <a href="index.php">Início</a>
        <a href="usuarios.php">Usuários</a>
        <a href="pratos.php">Pratos</a>
        <a href="pratos_usuario.php">Pratos por Usuário</a>
    </nav>
    <hr>

    <h2>Cadastrar Usuário</h2>
    <?php if ($erro): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Nome</label>
        <input type="text" name="nome">

        <label>E-mail</label>
        <input type="email" name="email">

        <button type="submit">Cadastrar</button>
    </form>

    <h2>Usuários Cadastrados</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>
        <?php while ($u = $usuarios->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($u['nome']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>