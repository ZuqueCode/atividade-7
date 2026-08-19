
CREATE DATABASE IF NOT EXISTS restaurante_db;
USE restaurante_db;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
);

CREATE TABLE pratos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255),
    preco DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

INSERT INTO usuarios (nome, email) VALUES
('Ana Souza', 'ana@restaurante.com'),
('Carlos Lima', 'carlos@restaurante.com');

INSERT INTO pratos (nome, descricao, preco, categoria, usuario_id) VALUES
('Feijoada', 'Feijoada completa com acompanhamentos', 45.90, 'Prato Principal', 1),
('Brigadeiro', 'Doce de chocolate', 8.50, 'Sobremesa', 2);
