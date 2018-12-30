var express = require('express');
var modelo = require('../modelo/modelo.js');

const Router = express.Router();
const Usuarios = modelo.Usuarios;

Router.post('/login', function(req, res){
  let email = req.body.user;

  Usuarios.findOne({email:email}).exec(function(error, usuario){
    if (error) {
      res.send("Error: Consulta de datos");
    }else{

      if (usuario) {
        if (usuario.password == req.body.pass) {
          req.session.user = true;
          req.session.email = email;
          res.send("Validado");
        }else{
          res.send("Error: Contraeña incorrecta")
        }
      }else{
        res.send("Error: Usuario No Valido")
      }
    }

  });

})


module.exports = Router;
