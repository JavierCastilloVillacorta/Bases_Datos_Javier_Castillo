const modelo = require('../modelo/modelo.js');
const UltimoId = modelo.UltimoId;
const Eventos = modelo.Eventos;

function nuevoEvento(email,callback){

 Eventos.find({usuario: email}).sort({id:-1}).limit(1).exec(function(err, result){

    if (err) {
      callback(-1);
    }else{
      if (result == "") {
        callback(0);
      }else{
        nuevoid = parseInt(result[0]["id"]);
        var nuevoid = result[0]["id"] + 1;
        callback(nuevoid);
      }
    }
  });

}

module.exports = { nuevoEvento:nuevoEvento };
