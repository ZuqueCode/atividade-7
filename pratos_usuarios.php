<?php
require 'conexao.php';

$usuarios = $conexao->query("SELECT * FROM usuarios ORDER BY nome");

$usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : '';
$pratos = null;

if ($usuario_id != '') {
    $sql = $conexao->prepare("SELECT * FROM pratos WHERE usuario_id = ?");
    $sql->bind_param('i', $usuario_id);
    $sql->execute();
    $pratos = $sql->get_result();

   }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pratos por Usuário</title>
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

    <h2>Filtrar Pratos por Usuário</h2>
    <form method="get">
        <label>Usuário</label>
        <select name="usuario_id" onchange="this.form.submit()">
            <option value="">Selecione</option>
            <?php while ($u = $usuarios->fetch_assoc()): ?>
                <option value="<?= $u['id'] ?>" <?= $u['id'] == $usuario_id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($u['nome']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if ($pratos): ?>
        <h2>Pratos Encontrados</h2>
        <table>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
            </tr>
            <?php while ($p = $pratos->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= htmlspecialchars($p['categoria']) ?></td>
                <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
 