const modelo = require('../modelo/modelo.js');
const Usuarios = modelo.Usuarios;

module.exports.insertarRegistro = function(callback){

  Usuarios.find({},(err, result)=>{
    if(err){
      callback(null, "Error busqueda")
    }else{

      if (result.length <= 0){
        let Usuario1 = new Usuarios({nombre : 'Juan',email : 'juan@gmail.com', password : '123456'});

        Usuario1.save((error)=>{
          if(error)callback(error)
          callback(null,"Registro Guardado")
        })
        let Usuario2 = new Usuarios({nombre : 'Carlos', email : 'carlos@gmail.com', password : '123456'});
        Usuario2.save((error)=>{
          if(error)callback(error)
          callback(null,"Registro Guardado")
        })
      }else {
        callback(null, result)
      }
    }
  })
}
