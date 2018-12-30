var express = require('express');
const modelo = require('../modelo/modelo.js');
const UltimoEvent = require('./ultimoevent.js')

const Router = express.Router();
const Usuarios = modelo.Usuarios;
const Eventos = modelo.Eventos;


Router.get('/events/all', function(req, res){
  if (!req.session.user) {
    res.send("Error");
    return;
  }
  Eventos.find({usuario:req.session.email}).exec((error,resultado) =>{
    if (error) {
      res.status = 500;
      res.send("Error al obtener data");
    }else{
      let eventos =[];
      for (var i = 0; i < resultado.length; i++) {
        let evento ={
          id:resultado[i].id,
          title:resultado[i].titulo,
          start:resultado[i].inicio,
          end:resultado[i].fin
        };
        eventos[i] = evento;
      }
      res.json(eventos);
    }
  });
});

Router.post('/events/new', function(req, res){
  if (!req.session.user) {
    res.send("Error");
    return;
  }
  UltimoEvent.nuevoEvento(req.session.email, function(idEvento){
    if(idEvento == -1){
      res.send('Error');
      return;
    }

    let nEvento = new Eventos({
      id: idEvento,
      titulo:req.body.title,
      inicio:req.body.start,
      fin:req.body.end,
      usuario:req.session.email,
    });
    nEvento.save(function(error){
      if(error){
        res.json(error);
      }else{
        res.json({
          msg:"Evento "+nEvento.titulo+" añadido exitosamente.",
          idEvento:idEvento
        })
      }
    });
  });
});

Router.post('/events/update', function(req, res){
  if (!req.session.user) {
    res.send("Error");
    return;
  }

  let actualizaEvento = {
    titulo: req.body.title,
    inicio: req.body.start,
    fin: req.body.end
  }

  Eventos.updateOne({id:req.body.id},actualizaEvento, function(error, evento){
    if(error){
      res.json(error);
    }else{
      res.json({
        msg:"Evento "+actualizaEvento.titulo+' modificado',
        idEvento:req.body.id
      });
    }
  });
});

Router.post('/events/delete/:id', function(req, res){
  if (!req.session.user) {
    res.send("Error");
    return;
  }

  Eventos.deleteOne({usuario:req.session.email, id:req.params.id}).exec(function(error){
    if(error){
      res.json(error);
    } else {
      res.send("Evento eliminado exitosamente");;
    }
  })

})


module.exports = Router;
