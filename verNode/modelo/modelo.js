var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var usuariosShema = new Schema({
  nombre:{type:String, required:true},
  email:{type:String, required:true},
  password:{type:String, required:true}
});

var eventosSchema = new Schema({
  id:{type:Number, required:true},
  titulo:{type:String, requiered:true},
  inicio:{type:String, required:true},
  fin:{type:String, required:false},
  usuario:{type:String, require:true}
});


var Usuarios = mongoose.model('Usuario', usuariosShema);
var Eventos = mongoose.model('Evento', eventosSchema);

module.exports = {Usuarios: Usuarios, Eventos:Eventos};
