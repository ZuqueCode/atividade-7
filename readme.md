# Sistema de Cadastro de Pratos - Restaurante

Sistema desenvolvido para organizar o cadastro de pratos de um restaurante, permitindo saber quais pratos foram cadastrados e por qual usuário.

## Funcionalidades

Cadastro de usuários
Cadastro de pratos vinculados ao usuário responsável
Listagem de pratos e seus responsáveis
Edição e exclusão de pratos
Filtro de pratos por usuário

## Tecnologias

PHP
MySQL
HTML
CSS
XAMPP

O projeto utiliza PHP puro, sem frameworks ou bibliotecas externas, mantendo a estrutura simples.

## Arquivos principais

textbanco.sql              -> criação do banco e das tabelas
conexao.php            -> conexão com o MySQL
style.css              -> estilos das páginas
index.php              -> página inicial
usuarios.php           -> cadastro e lista de usuários
pratos.php             -> cadastro, lista e exclusão de pratos
editar_prato.php       -> edição de pratos
pratos_usuario.php     -> filtro de pratos por usuário

## Requisitos atendidos

Cadastro de usuários e pratos

Associação dos pratos aos usuários

Listagem, edição e exclusão de pratos

Filtro de pratos por usuário

Validação de campos obrigatórios

Uso de Prepared Statements para evitar SQL Injection

Uso de htmlspecialchars() para ajudar na prevenção de XSS