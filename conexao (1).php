<?php
$conexao = new mysqli('localhost', 'root', '', 'restaurante_db');

if ($conexao->connect_error) {
    die('Erro na conexão: ' . $conexao->connect_error);
}
