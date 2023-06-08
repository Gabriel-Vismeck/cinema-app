const express = require('express');
const app = express();         
const bodyParser = require('body-parser');
const port = 3000; //porta padrão
const connStr = "Server=localhost,1433;Database=ProjetoCinema;User Id=SA;Password=291004fer;trustServerCertificate=true;";
const sql = require("mssql");

//fazendo a conexão global
sql.connect(connStr)
   .then(conn => global.conn = conn)
   .catch(err => console.log(err));


function execSQLQuery(sqlQry, res){
    global.conn.request()
            .query(sqlQry)
            .then(result => res.json(result.recordset))
            .catch(err => res.json(err));
}

//configurando o body parser para pegar POSTS mais tarde
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

//definindo as rotas
const router = express.Router();
router.get('/', (req, res) => res.json({ message: 'Funcionando!' }));

router.get('/filmes', (req, res) => {
    execSQLQuery('SELECT * FROM Filme', res);
});

app.use('/', router);

//inicia o servidor
app.listen(port);
console.log('API funcionando!');