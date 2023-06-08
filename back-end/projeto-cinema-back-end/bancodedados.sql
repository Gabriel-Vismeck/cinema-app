CREATE DATABASE ProjetoCinema;

USE ProjetoCinema;

CREATE TABLE Fornecedor (
idFornecedor INT IDENTITY PRIMARY KEY,
nome VARCHAR(255),
telefone VARCHAR(255),
email VARCHAR(255)
);

CREATE TABLE Filme (
idFilme INT IDENTITY PRIMARY KEY,
titulo VARCHAR(255),
sinopse TEXT,
dataLancamento DATE,
duracao INT,
urlPoster VARCHAR(500),
idFornecedor INT FOREIGN KEY REFERENCES Fornecedor(idFornecedor)
);

CREATE TABLE Cinema (
idCinema INT IDENTITY PRIMARY KEY,
nome VARCHAR(255),
endereco VARCHAR(255),
telefone VARCHAR(255)
);

CREATE TABLE Sala (
idSala INT IDENTITY PRIMARY KEY,
nome VARCHAR(255),
idCinema INT FOREIGN KEY REFERENCES Cinema(idCinema)
);

CREATE TABLE Sessao (
idSessao INT IDENTITY PRIMARY KEY,
horarioInicio TIME,
idFilme INT FOREIGN KEY REFERENCES Filme(idFilme),
idSala INT FOREIGN KEY REFERENCES Sala(idSala)
);

CREATE TABLE Assento (
idAssento INT IDENTITY PRIMARY KEY,
posicao VARCHAR(3),
idSala INT FOREIGN KEY REFERENCES Sala(idSala)
);

CREATE TABLE Pessoa (
idPessoa INT IDENTITY PRIMARY KEY,
nome VARCHAR(255),
dataNascimento DATE,
cpf VARCHAR(15)
);


CREATE TABLE Usuario (
idUsuario INT IDENTITY PRIMARY KEY,
email VARCHAR(255),
senha VARCHAR(255),
dataCadastro DATE,
idPessoa INT FOREIGN KEY REFERENCES Pessoa(idPessoa)
);


CREATE TABLE Ingresso (
idIngresso INT IDENTITY PRIMARY KEY,
dataVenda DATE,
custoVenda MONEY,
idSessao INT FOREIGN KEY REFERENCES Sessao(idSessao),
idUsuario INT FOREIGN KEY REFERENCES Usuario(idUsuario),
idAssento INT FOREIGN KEY REFERENCES Assento(idAssento)
);

CREATE TABLE Setor (
idSetor INT IDENTITY PRIMARY KEY,
nome VARCHAR(150)
);

CREATE TABLE Funcionario (
idFuncionario INT IDENTITY PRIMARY KEY,
cargo VARCHAR(150),
salario MONEY,
dataAdmissao DATE,
idPessoa INT FOREIGN KEY REFERENCES Pessoa(idPessoa),
idChefe INT FOREIGN KEY REFERENCES Pessoa(idPessoa),
idSetor INT FOREIGN KEY REFERENCES Setor(idSetor)
);

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('Fornecedor de filmes', '(41) 99955-3167', 'fornecedorfilmes@gmail.com');
SELECT * FROM Fornecedor;

INSERT INTO Filme(titulo, sinopse, dataLancamento, duracao, urlPoster, idFornecedor)
VALUES ('John Wick 4', 'John wick mata pessoas denovo', '2023-03-23', 140, 'https://www.themoviedb.org/t/p/w220_and_h330_face/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg', 1);
INSERT INTO Filme(titulo, sinopse, dataLancamento, duracao, urlPoster, idFornecedor)
VALUES ('The End of Evangelion', 'O final do papa :(', '1997-06-14', 170, 'https://image.tmdb.org/t/p/w220_and_h330_face/j6G24dqI4WgUtChhWjfnI4lnmiK.jpg', 1);
SELECT * FROM Filme;