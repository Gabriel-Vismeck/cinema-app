DROP DATABASE IF EXISTS ProjetoCinema;

CREATE DATABASE ProjetoCinema;

USE ProjetoCinema;

CREATE TABLE Fornecedor (
idFornecedor INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(255),
telefone VARCHAR(255),
email VARCHAR(255)
);

CREATE TABLE Filme (
idFilme INT PRIMARY KEY AUTO_INCREMENT,
titulo VARCHAR(255),
sinopse TEXT,
dataLancamento DATE,
duracao INT,
urlPoster VARCHAR(500),
idFornecedor INT,
FOREIGN KEY (idFornecedor) REFERENCES Fornecedor(idFornecedor)
);

CREATE TABLE Cinema (
idCinema INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(255),
endereco VARCHAR(255),
telefone VARCHAR(255)
);

CREATE TABLE Sala (
idSala INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(255),
idCinema INT,
FOREIGN KEY (idCinema) REFERENCES Cinema(idCinema)
);

CREATE TABLE Sessao (
idSessao INT PRIMARY KEY AUTO_INCREMENT,
horarioInicio DATETIME,
idFilme INT,
idSala INT,
FOREIGN KEY (idFilme) REFERENCES Filme(idFilme),
FOREIGN KEY (idSala) REFERENCES Sala(idSala)
);

CREATE TABLE Pessoa (
idPessoa INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(255),
dataNascimento DATE,
cpf VARCHAR(15)
);

CREATE TABLE Cliente (
idCliente INT PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(255),
senha VARCHAR(255),
nome VARCHAR(255),
telefone VARCHAR(255),
cpf VARCHAR(255),
dataCadastro DATE
);

CREATE TABLE Ingresso (
idIngresso INT PRIMARY KEY AUTO_INCREMENT,
dataVenda DATE,
custoVenda DECIMAL,
idSessao INT,
idCliente INT,
FOREIGN KEY (idSessao) REFERENCES Sessao(idSessao),
FOREIGN KEY (idCliente) REFERENCES Cliente(idCliente)
);

CREATE TABLE AssentoIngresso (
idIngresso INT,
posicao VARCHAR(3),
FOREIGN KEY (idIngresso) REFERENCES Ingresso(idIngresso)
);

CREATE TABLE Setor (
idSetor INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(150)
);

CREATE TABLE Funcionario (
idFuncionario INT PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(255),
senha VARCHAR(255),
nome VARCHAR(255),
dataNascimento DATE,
cpf VARCHAR(255),
cargo VARCHAR(255),
salario DECIMAL,
dataAdmissao DATE,
idChefe INT,
idSetor INT,
idCinema INT,
FOREIGN KEY (idChefe) REFERENCES Funcionario(idFuncionario),
FOREIGN KEY (idSetor) REFERENCES Setor(idSetor),
FOREIGN KEY (idCinema) REFERENCES Cinema(idCinema)
);

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('Fornecedor de filmes', '(41) 99955-3167', 'fornecedorfilmes@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('Cinefilmes Distribuidora', '(41) 99955-3167', 'cinefilmes@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('CineWorld Productions', '(11) 98765-4321', 'cineworld@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('FilmStar Entertainment', '(21) 99887-5544', 'filmstar@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('SilverScreen Studios', '(31) 91234-5678', 'silverscreen@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('MovieMagic Productions', '(51) 98765-4321', 'moviemagic@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('CinemaVision Distribuidora', '(44) 99999-8888', 'cinemavision@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('Blockbuster Films', '(22) 91111-2222', 'blockbuster@gmail.com');

INSERT INTO Fornecedor(nome, telefone, email)
VALUES ('CineMakers Productions', '(33) 93333-6666', 'cinemakers@gmail.com');

SELECT * FROM Fornecedor;

INSERT INTO Filme(titulo, sinopse, dataLancamento, duracao, urlPoster, idFornecedor)
VALUES (
    'John Wick 4',
    'Com o preço por sua cabeça cada vez maior, o lendário assassino de aluguel John Wick leva sua luta contra o High Table global enquanto procura os jogadores mais poderosos do submundo, de Nova York a Paris, do Japão a Berlim.',
    '2023-03-23',
    140,
    'https://www.themoviedb.org/t/p/w780/vZloFAK7NmvMGKE7VkF5UHaz0I.jpg',
    1
),
(
    'The End of Evangelion',
    'A SEELE ordena um ataque à NERV para destruir os EVAs antes que Gendo consiga provocar o terceiro impacto e a união das almas humanas.',
    '1997-06-14',
    170,
    'https://image.tmdb.org/t/p/w780/j6G24dqI4WgUtChhWjfnI4lnmiK.jpg',
    1
),
(
    'Guardiões da Galáxia Vol. 3',
    'Peter Quill deve reunir sua equipe para defender o universo e proteger um dos seus. Se a missão não for totalmente bem-sucedida, isso pode levar ao fim dos Guardiões.',
    '2023-05-04',
    149,
    'https://www.themoviedb.org/t/p/w780/r2J02Z2OpNTctfOSN1Ydgii51I3.jpg',
    1
),
(
    'Homem-Aranha: Sem Volta para Casa',
    'Peter Parker tem a sua identidade secreta revelada e pede ajuda ao Doutor Estranho. Quando um feitiço para reverter o evento não sai como o esperado, o Homem-Aranha e seu companheiro dos Vingadores precisam enfrentar inimigos de todo o multiverso',
    '2021-12-16',
    148,
    'https://www.themoviedb.org/t/p/w780/fVzXp3NwovUlLe7fvoRynCmBPNc.jpg',
    1
),
(
    'Pantera Negra: Wakanda Para Sempre',
    'Rainha Ramonda, Shuri, MBaku, Okoye e Dora Milaje lutam para proteger sua nação das potências mundiais intervenientes após a morte do rei TChalla.',
    '2022-11-10',
    161,
    'https://www.themoviedb.org/t/p/w780/nZ69WTv7n01womaNz3SHa4inA9x.jpg',
    1
),
(
    'Avatar: O Caminho da Água',
    'Após formar uma família, Jake Sully e Neytiri fazem de tudo para ficarem juntos. No entanto, eles devem sair de casa e explorar as regiões de Pandora quando uma antiga ameaça ressurge, e Jake deve travar uma guerra difícil contra os humanos.',
    '2022-12-15',
    192,
    'https://www.themoviedb.org/t/p/w780/mbYQLLluS651W89jO7MOZcLSCUw.jpg',
    1
),
(
    'Velozes e Furiosos 10',
    'Dom Toretto e sua família precisam lidar com o adversário mais letal que já enfrentaram. Alimentada pela vingança, uma ameaça terrível emerge das sombras do passado para destruir o mundo de Dom e todos que ele ama.',
    '2023-05-19',
    141,
    'https://www.themoviedb.org/t/p/w780/A0Z6RoVP6tVXUjaZR7Bf1vdnJMF.jpg',
    1
),
(
    'Super Mario Bros. O Filme',
    'Mario é um encanador junto com seu irmão Luigi. Um dia, eles vão parar no reino dos cogumelos, governado pela Princesa Peach, mas ameaçado pelo rei dos Koopas, que faz de tudo para conseguir reinar em todos os lugares.',
    '2023-04-06',
    92,
    'https://www.themoviedb.org/t/p/w780/ktU3MIeZtuEVRlMftgp0HMX2WR7.jpg',
    1
),
(
    'Barbie',
    'Depois de ser expulsa da Barbieland por ser uma boneca de aparência menos do que perfeita, Barbie parte para o mundo humano em busca da verdadeira felicidade.',
    '2023-07-20',
    100,
    'https://www.themoviedb.org/t/p/w780/cgYg04miVQUAG2FKk3amSnnHzOp.jpg',
    1
),
(
    'The Flash',
    'Acompanhe as aventuras do homem mais veloz do planeta, o cientista da Central City Police Barry Allen, que após um trágico acidente adquire o poder da velocidade.',
    '2023-06-15',
    144,
    'https://www.themoviedb.org/t/p/w780/gCp4ATDNhhZyxZiLYkpQlMEiWWG.jpg',
    1
),
(
    'Elementos',
    'Em uma cidade onde moradores do fogo, da água, da terra e do ar vivem juntos, uma jovem impetuosa e um homem tranquilo estão prestes a descobrir algo elementar: o quanto realmente têm em comum.',
    '2023-06-15',
    162,
    'https://www.themoviedb.org/t/p/w780/cveXFCRCrxdARM3Gel0pRCKsssJ.jpg',
    1
),
(
    'Indiana Jones e A Relíquia do Destino',
    'Encontrando-se em uma nova era, aproximando-se da aposentadoria, Indy luta para se encaixar em um mundo que parece tê-lo superado. Mas quando os tentáculos de um mal muito familiar retornam na forma de um antigo rival, Indy deve colocar seu chapéu e pegar seu chicote mais uma vez para garantir que um antigo e poderoso artefato não caia nas mãos erradas.',
    '2023-06-29',
    154,
    'https://www.themoviedb.org/t/p/w780/9EnfMH0nTPCna87Mh3G8Q6W2wze.jpg',
    1
),
(
    'Ruby Marinho - Monstro Adolescente',
    'Uma adolescente tímida descobre que faz parte de uma lendária linhagem real dos míticos krakens do mar e que seu destino, nas profundezas dos oceanos, é maior do que ela jamais sonhou.',
    '2023-06-29',
    169,
    'https://www.themoviedb.org/t/p/w780/lotWiuWuTGlQ94rzBdy6ZmKZnTA.jpg',
    1
),
(
    'Que Horas Eu Te Pego?',
    'Uma jovem falida é contratada para namorar um adolescente introvertido e socialmente desajeitado, que está se preparando para a faculdade.',
    '2023-06-05',
    103,
    'https://www.themoviedb.org/t/p/w780/qkgAGAWqSxeLJ7MZeGpQs0S7Yd.jpg',
    1
),
(
    'Homem-Aranha: Através do Aranhaverso',
    'Miles Morales retorna para o próximo capítulo da saga do Aranhaverso, uma aventura épica que transportará o Homem-Aranha em tempo integral e amigável do bairro do Brooklyn através do Multiverso para unir forças com Gwen Stacy e uma nova equipe de Homens-Aranha para enfrentar com um vilão mais poderoso do que qualquer coisa que eles já encontraram.',
    '2023-06-01',
    140,
    'https://www.themoviedb.org/t/p/w780/6a7NItazspSV8Fl7u46ccxwPKk4.jpg',
    1
),
(
    'A Pequena Sereia',
    'Ariel é uma curiosa sereia que deseja experimentar a vida em terra firme e, contra a vontade de seu pai, visita a superfície. Ariel se vê em uma inesperada jornada de autodescoberta ao encontrar um príncipe, uma bruxa do mar e um novo mundo incrível.',
    '2023-05-25',
    135,
    'https://www.themoviedb.org/t/p/w780/2oVEdOpE6CYJmF1hNnIfMwuBHPx.jpg',
    1
),
(
    'Transformers: O Despertar das Feras',
    'Transformers: O Despertar das Feras traz mais uma aventura épica pelo universo dos transformers. Ambientada nos anos 1990, o filme apresentará os Maximals, Predacons e Terrorcons à batalha existente na Terra entre Autobots e Decepticons.',
    '2023-06-07',
    127,
    'https://www.themoviedb.org/t/p/w780/5KZwFWPY7a0bZFRXgA8t8fY6bcL.jpg',
    1
),
(
    'Rua Cloverfield, 10',
    'Uma jovem sofre um grave acidente de carro e acorda no porão de um desconhecido. O homem diz ter salvado sua vida de um ataque químico que deixou o mundo inabitável, motivo pelo qual eles devem permanecer protegidos no local. Desconfiada da história, ela tenta descobrir um modo de se libertar sob o risco de descobrir uma verdade muito mais perigosa do que seguir trancafiada no local.',
    '2023-05-06',
    103,
    'https://www.themoviedb.org/t/p/w780/yZlG6mFGy3dqUxWka5XlYNC0JvD.jpg',
    1
),
(
    'Scott Pilgrim Contra o Mundo',
    'Scott Pilgrim (Michael Cera) tem 23 anos, integra uma banda de colégio, vive trocando de emprego e tem um namoro firme. Sua vida está maravilhosa, até conhecer Ramona V. Flowers (Mary Elizabeth Winestead). Ele logo se apaixona perdidamente por ela, só que não será fácil conquistar seu amor. Para tanto ele precisa enfrentar os sete ex-namorados dela, que estão dispostos a tudo para impedir sua felicidade com outra pessoa.',
    '2023-05-27',
    112,
    'https://www.themoviedb.org/t/p/w780/pg4CBJZKcwW024xau5Wwt7riSH0.jpg',
    1
),
(
    'O Farol',
    'No final do século 19, um novo zelador chega a uma remota ilha na Nova Inglaterra para ajudar o faroleiro local, mas o isolamento causa tensão na convivência entre os dois homens. Entre tempestades e goles de querosene, o novato tenta desvendar os mistérios que existem nas histórias de pescador de seu chefe.',
    '2023-05-02',
    109,
    'https://www.themoviedb.org/t/p/original/3IHMR9l5VLs8IlU5yH83L7me1hY.jpg',
    2
),
(
    'Hereditário',
    'Após a morte da reclusa avó, a família Graham começa a desvendar algumas coisas. Mesmo após a partida da matriarca, ela permanece como se fosse uma sombra sobre a família, especialmente sobre a solitária neta adolescente, Charlie, por quem ela sempre manteve uma fascinação não usual. Com um crescente terror tomando conta da casa, a família explora lugares mais escuros para escapar do infeliz destino que herdaram.',
    '2023-06-21',
    127,
    'https://www.themoviedb.org/t/p/original/x9tUYQj6WrdVwoKimSdoMzkDABS.jpg',
    4
),
(
    'Midsommar',
    'Dani e Christian formam um jovem casal americano com um relacionamento prestes a desmoronar. Mas depois que uma tragédia familiar os mantém juntos, Dani, que está de luto, convida-se para se juntar a Christian e seus amigos em uma viagem para um festival de verão único em uma remota vila sueca. O que começa como férias despreocupadas de verão em uma terra de luz eterna toma um rumo sinistro quando os moradores do vilarejo convidam o grupo a participar de festividades que tornam o paraíso pastoral cada vez mais preocupante e visceralmente perturbador.',
    '2023-05-19',
    148,
    'https://www.themoviedb.org/t/p/original/bozDCie26Fa7G2qhP5IBiSYCtfS.jpg',
    6
),
(
    'A Bruxa',
    'O casal William e Katherine leva uma vida cristã com suas cinco crianças em uma comunidade extremamente religiosa, até serem expulsos do local por sua fé diferente daquela permitida pelas autoridades. A família passa a morar num local isolado, à beira do bosque, sofrendo com a escassez de comida. Um dia, o bebê recém-nascido desaparece. Enquanto buscam respostas, cada membro da família descobre seus piores medos.',
    '2023-05-03',
    92,
    'https://www.themoviedb.org/t/p/original/x8WMBRSiyzh9kx7dTUbOUyyeznX.jpg',
    8
),
(
    'Beau Tem Medo',
    'Um homem paranoico embarca em uma odisseia épica para voltar para casa e encontrar sua mãe.',
    '2023-04-20',
    180,
    'https://www.themoviedb.org/t/p/original/sHxS5Q9wvjXgfVhkeAmvdWZMfKt.jpg',
    7
);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('Cinemáximo - Shopping Curitiba', 'Rua das Mangas, 256', '(41) 8736-8376');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 1),
('Sala A02', 1),
('Sala B01', 1),
('Sala B02', 1);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('Cinemáximo - Shopping Boulevard', 'Rua das Capitais, 657', '(54) 5765-6785');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 2),
('Sala A02', 2),
('Sala B01', 2),
('Sala B02', 2);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('Cineplex - Shopping Center', 'Avenida das Flores, 123', '(11) 9876-5432');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 3),
('Sala A02', 3),
('Sala B01', 3),
('Sala B02', 3);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('StarCine - Metrópole Shopps', 'Rua dos Cinéfilos, 789', '(21) 8765-4321');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 4),
('Sala A02', 4),
('Sala B01', 4),
('Sala B02', 4);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('Cinema Paradiso - Shopping Dreamhouse', 'Avenida dos Sonhos, 456', '(31) 2345-6789');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 5),
('Sala A02', 5),
('Sala B01', 5),
('Sala B02', 5);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('Cinema Novo Mundo - Shopping Goindown', 'Estrada para I, 666', '(66) 6666-6666');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 6),
('Sala A02', 6),
('Sala B01', 6),
('Sala B02', 6);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('CineMagic - Shopping Cineville', 'Avenida das Estrelas, 321', '(44) 5678-9012');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 7),
('Sala A02', 7),
('Sala B01', 7),
('Sala B02', 7);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('Paradise Mall - Shopping Goinup', 'Escadaria para C, 777', '(77) 7777-7777');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 8),
('Sala A02', 8),
('Sala B01', 8),
('Sala B02', 8);

INSERT INTO Cinema (nome, endereco, telefone)
VALUES ('CinemaX - Shopping MoviePlace', 'Avenida dos Cinéfilos, 890', '(33) 6789-0123');
INSERT INTO Sala (nome, idCinema)
VALUES
('Sala A01', 9),
('Sala A02', 9),
('Sala B01', 9),
('Sala B02', 9);


INSERT INTO Sessao(horarioInicio, idFilme, idSala)
VALUES
('2023-03-23 12:30', 1,  1 ), ('2023-03-24 14:10', 1,  6 ),
('1997-06-14 15:20', 2,  2 ), ('1997-06-15 15:40', 2,  7 ),
('2023-05-04 14:50', 3,  3 ), ('2023-05-05 11:20', 3,  8 ),
('2021-12-16 13:10', 4,  4 ), ('2021-12-17 18:30', 4,  9 ),
('2022-11-10 17:20', 5,  5 ), ('2022-11-18 17:50', 5,  10),
('2022-12-15 15:10', 6,  6 ), ('2022-12-16 15:20', 6,  11),
('2023-05-19 15:30', 7,  7 ), ('2023-05-20 18:50', 7,  12),
('2023-04-06 18:50', 8,  8 ), ('2023-04-07 10:30', 8,  13),
('2023-07-20 11:55', 9,  9 ), ('2023-07-21 17:40', 9,  14),
('2023-06-15 12:40', 10, 10), ('2023-06-16 11:55', 10, 15),
('2023-06-15 13:50', 11, 11), ('2023-06-16 15:30', 11, 16),
('2023-06-29 15:50', 12, 12), ('2023-06-30 17:55', 12, 17),
('2023-06-29 16:20', 13, 13), ('2023-06-30 14:20', 13, 18),
('2023-06-05 13:30', 14, 14), ('2023-06-06 14:20', 14, 19),
('2023-06-01 15:20', 15, 15), ('2023-06-02 17:30', 15, 20),
('2023-05-26 17:30', 16, 16), ('2023-05-27 19:30', 16, 21),
('2023-06-07 13:40', 17, 17), ('2023-06-08 14:50', 17, 22),
('2023-05-06 16:55', 18, 18), ('2023-05-07 13:20', 18, 23),
('2023-05-27 19:20', 19, 19), ('2023-05-28 12:30', 19, 24),
('2023-05-02 12:30', 20, 20), ('2023-05-03 17:20', 20, 25),
('2023-06-21 10:20', 21, 21), ('2023-06-22 12:30', 21, 1),
('2023-05-19 12:55', 22, 22), ('2023-05-20 18:30', 22, 2),
('2023-05-03 15:50', 23, 23), ('2023-05-04 17:50', 23, 2),
('2023-04-20 18:20', 24, 24), ('2023-04-21 14:40', 24, 3);

INSERT INTO Cliente (cpf, dataCadastro, email, nome, senha, telefone)
VALUES ('345.567.234-76', NOW(), 'cliente@gmail.com', 'Cliente', '12345678', '(41) 93435-4563');

INSERT INTO Cliente (cpf, dataCadastro, email, nome, senha, telefone)
VALUES ('657.345.567-45', NOW(), 'cliente2@gmail.com', 'Cliente Dois', '12345678', '(75) 3453-6454');

INSERT INTO Ingresso (custoVenda, dataVenda, idCliente, idSessao)
VALUES (120, NOW(), 1, 1);
INSERT INTO AssentoIngresso (idIngresso, posicao)
VALUES
(1, '1J'),
(1, '2J'),
(1, '3J'),
(1, '4J'),
(1, '7J'),
(1, '8J');

INSERT INTO Ingresso (custoVenda, dataVenda, idCliente, idSessao)
VALUES (80, NOW(), 1, 5);
INSERT INTO AssentoIngresso (idIngresso, posicao)
VALUES
(2, '1H'),
(2, '2H'),
(2, '3H'),
(2, '4H');

INSERT INTO Ingresso (custoVenda, dataVenda, idCliente, idSessao)
VALUES (80, NOW(), 2, 13);
INSERT INTO AssentoIngresso (idIngresso, posicao)
VALUES
(3, '1G'),
(3, '2G'),
(3, '3G'),
(3, '4G');

INSERT INTO Ingresso (custoVenda, dataVenda, idCliente, idSessao)
VALUES (140, NOW(), 1, 6);
INSERT INTO AssentoIngresso (idIngresso, posicao)
VALUES
(4, '1B'),
(4, '2B'),
(4, '3B'),
(4, '4B'),
(4, '9A'),
(4, '10A'),
(4, '11A');

INSERT INTO Ingresso (custoVenda, dataVenda, idCliente, idSessao)
VALUES (200, NOW(), 2, 5);
INSERT INTO AssentoIngresso (idIngresso, posicao)
VALUES
(5, '9H'),
(5, '10H'),
(5, '11H'),
(5, '1B'),
(5, '2B'),
(5, '3B'),
(5, '4B'),
(5, '9A'),
(5, '10A'),
(5, '11A');

INSERT INTO Setor (nome)
VALUES 
('Atendimento'),
('Financeiro'),
('Administrativo'),
('Comercial'),
('Tecnologia da Informação'),
('Recursos Humanos'),
('Departamento Pessoal'),
('Logistica'),
('Marketing'),
('Facilities'),
('Contabilidade'),
('Manutenção'),
('Segurança do Trabalho'),
('Controladoria'),
('Almoxarifado');

INSERT INTO funcionario (
    email,
    senha,
    nome,
    dataNascimento,
    cpf,
    cargo,
    salario,
    dataAdmissao,
    idChefe,
    idSetor,
    idCinema)
VALUES (
    'mateus.cavalcanti@cinemaximo.com',
    '12345678',
    'Mateus Cavalcanti',
    '1996-02-12',
    '345.765.546-45',
    'Gerente',
    3450,
    '12/05/2019',
    1,
    1,
    3
),
(
    'diego.barros@cinemaximo.com',
    '12345678',
    'Diego Barros Souza',
    '1993-02-12',
    '562.867.345-46',
    'Vendedor de Ingressos',
    1550,
    '25/04/2020',
    1,
    1,
    4
),
(
    'olivia.paz@cinemaximo.com',
    '12345678',
    'Olivia Isabella da Paz',
    '1994-06-03',
    '363.910.801-94',
    'Gerente',
    3750,
    '12/05/2019',
    1,
    1,
    2
);

INSERT INTO Setor (nome)
VALUES ('Financeiro');

INSERT INTO funcionario (
    email,
    senha,
    nome,
    dataNascimento,
    cpf,
    cargo,
    salario,
    dataAdmissao,
    idChefe,
    idSetor,
    idCinema)
VALUES (
    'thais.barbosa@cinemaximo.com',
    '12345678',
    'Thaís Barbosa Goncalves',
    '1984-11-05',
    '564.876.234-76',
    'Compras Externas',
    2780,
    '23/07/2019',
    3,
    2,
    6
);

INSERT INTO Setor (nome)
VALUES ('Desenvolvimento');

INSERT INTO funcionario (
    email,
    senha,
    nome,
    dataNascimento,
    cpf,
    cargo,
    salario,
    dataAdmissao,
    idChefe,
    idSetor,
    idCinema)
VALUES (
    'fernando.smaniotto@cinemaximo.com',
    '12345678',
    'Fernando Galvão Smaniotto',
    '2004-10-29',
    '130.488.419-89',
    'Programador',
    1258,
    '23/01/2023',
    3,
    3,
    2
);

INSERT INTO funcionario (
    email,
    senha,
    nome,
    dataNascimento,
    cpf,
    cargo,
    salario,
    dataAdmissao,
    idChefe,
    idSetor,
    idCinema)
VALUES
(
    'Marcos.Ferreira@cinemaximo.com',
    '165165',
    'Marcos Ferreira',
    '2002-11-02',
    '94721320005',
    'Analista Junior',
    2500,
    '2020-05-03',
    3,
    2,
    1
),
(
    'vsilva@cinemaximo.com',
    '4894654',
    'Valquíria Silva',
    '1980-03-04',
    '31369954809',
    'Analista Pleno',
    3500,
    '2020-05-20',
    3,
    3,
    2
),
(
    'Jessica.Almeida@cinemaximo.com',
    '58363',
    'Thaís Barbosa Goncalves',
    '2000-06-07',
    '34074036509',
    'Analista Sênior',
    5000,
    '2021-04-06',
    3,
    5,
    3
),
(
    'Railson.Batista@cinemaximo.com',
    '4564',
    'Railson Batista',
    '1978-11-03',
    '39605761539',
    'Analista Sênior',
    5000,
    '2021-05-08',
    3,
    2,
    4
),
(
    'rcarmesin@cinemaximo.com',
    '156165',
    'Rodolfo Carmesin',
    '1976-07-05',
    '39048540008',
    'Diretoria',
    12000,
    '2003-07-06',
    3,
    4,
    4
),
(
    'Maria.Silva@cinemaximo.com',
    '55465',
    'Maria Silva',
    '2000-12-07',
    '57357860274',
    'Estagiário',
    1100,
    '2023-12-07',
    3,
    7,
    3
),
(
    'msantos@cinemaximo.com',
    '8654156',
    'Milena dos Santos',
    '2003-08-09',
    '54781957168',
    'Gerente',
    4000,
    '2020-05-03',
    3,
    5,
    6
),
(
    'Jasmine.Barbosa@cinemaximo.com',
    '41651654',
    'Jasmine Barbosa',
    '1995-09-29',
    '3975676960',
    'Gerente',
    4000,
    '2020-05-20',
    3,
    6,
    5
),
(
    'João.Andrade@cinemaximo.com',
    '546545',
    'João Andrade',
    '1990-10-14',
    '86764941730',
    'Gerente',
    4000,
    '2021-04-06',
    3,
    2,
    2
),
(
    'Mariana.Candido@cinemaximo.com',
    '26289',
    'Mariana Candido',
    '2006-05-04',
    '84685321696',
    'Menor Aprendiz',
    800,
    '2021-05-08',
    3,
    9,
    6
),
(
    'Francisco.Soares@cinemaximo.com',
    '6585861',
    'Francisco Soares',
    '2005-02-26',
    '94785415438',
    'Menor Aprendiz',
    800,
    '2023-02-26',
    3,
    3,
    1
);