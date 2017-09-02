var express = require("express");
var app     = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var path = require('path')
var bodyParser = require('body-parser');
var serveStatic = require('serve-static');
//Store all HTML files in view folder.
var nodemailer = require("nodemailer");
var smtpTransport = require('nodemailer-smtp-transport');
var options = {
    service: 'gmail',
    auth: {
        user: 'percytsy@gmail.com',
        pass: process.env.GMAILPASS
    }
  };
var transporter = nodemailer.createTransport(smtpTransport(options));
app.set('port', process.env.PORT || 3100);

app.use(bodyParser.urlencoded({ extended:false}));
app.use(bodyParser.json());




app.use(serveStatic(__dirname + '/public'));
app.get('/', function(req, res){
  res.sendFile(__dirname + '/public/index.html');
});

app.post('/email',function(req,res){
    var from = req.body.from;
    var mailOptions={
      from: 'percytsy@gmail.com',
        to : 'percytsy@gmail.com',
        subject : from.concat(req.body.subject),
        text : req.body.content
    }
    console.log(mailOptions);
    transporter.sendMail(mailOptions, function(error, response){
     if(error){
          console.log(error);
        res.end("error");
     }else{
          res.redirect('/');
          }
});
});

app.get('/getOnline',function(req,res,next){
  console.log('activated')
  var from = req.body.from;
    var mailOptions={
      from: 'percytsy@gmail.com',
        to : 'percytsy@gmail.com',
        subject : "Get online",
        text : "Someone is trying to chat with you!"
    }
    console.log(mailOptions);
    transporter.sendMail(mailOptions, function(error, response){
     if(error){
          console.log(error);
        res.end("error");
     }else{
       res.sendStatus(200)
      }
    });
});
//var clients = [];

//io.sockets.on('connect', function(client) {
  //  clients.push(client);

//    client.on('disconnect', function() {
//      clients.splice(clients.indexOf(client), 1);
//    });
//});

io.on('connection', function(socket){
//  console.log(clients.length);
  socket.on('chat message', function(msg){
    io.emit('chat message', msg);
  });
});

http.listen(3100, function(){
  console.log('listening on *:3100');
});
