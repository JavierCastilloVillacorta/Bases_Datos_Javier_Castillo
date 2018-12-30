const modelo = require('../modelo/modelo.js');
const UltimoId = modelo.UltimoId;
const Eventos = modelo.Eventos;

function nuevoEvento(email,callback){

  valor =   Eventos.findOne({usuario: email},{_id:0}).sort({id:-1}).limit(1);

  console.log(valor +"--"+ valor.id);

 Eventos.find({usuario: email}).sort({id:-1}).limit(1).exec(function(err, result){

    if (err) {
      callback(-1);
    }else{
      console.log(result+"///");
      console.log(result._id);
/*



for x in mydoc:
  print(x)
  

      console.log(result+"--");
      if (result == "") {
        callback(0);
      }else{
        console.log("///"+result.id);
        var nuevoid = result.id + 1;
        callback(result);
      }
*/
    }


  });



/*
  Eventos.findOne({usuario: email}, (err, result)=>{

  }).sort({$natural:-1}).limit(1);
*/

  /*
  if (err) {
    callback(-1);
  }else{
    console.log(result);
    if (result == "") {
      var nuevoid = 0;
    }else{
      console.log("///"+result.id);
      var nuevoid = result.id + 1;
    }
    callback(nuevoid);
  }

  */

}

module.exports = { nuevoEvento:nuevoEvento };
