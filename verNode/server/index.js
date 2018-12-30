const http = require('http'),
      path = require('path'),
      express = require('express'),
      bodyParser = require('body-parser'),
      mongoose = require('mongoose'),
      session = require('express-session');

const RouterU = require('./routerUsuario.js');
const RouterE = require('./routerEvento.js');
const CrearUsuario = require('./nuevo_usuario.js');
var url = 'mongodb://localhost:27017/agenda';

CrearUsuario.insertarRegistro((error, result) =>{
  if (error)console.log(error)
  console.log(result);
})


const PORT = 3000;
const app = express();

const Server = http.createServer(app);

let rutaCliente = path.join(__dirname,'../')+"client/";
app.use(express.static(rutaCliente));
app.use(express.static(rutaCliente+"css/"));
app.use(express.static(rutaCliente+"js/"));
app.use(express.static(rutaCliente+"img/"))
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:true}));
app.use(session({
    secret: '2C44-4D44-WppQ38S',
    resave: false,
    saveUninitialized: true
}));

app.use('', RouterU);
app.use('', RouterE);

mongoose.connect(url, {useNewUrlParser:true});

Server.listen(PORT, function(){
  console.log('Server is listeng on port. ' + PORT);
})
