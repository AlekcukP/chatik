const express = require('express');
const app = require('express')();
const expressWs = require('express-ws')(app);
const wss = expressWs.getWss();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.ws('/', function(ws, req) {
  // ws.on('message', function(msg) {
  //   wss.clients.forEach(function (client) {
  //       client.send(msg);
  //   });
  // });
});


app.post('/message', function(req, res){
  sendMessage(JSON.stringify(req.body));
})

function sendMessage(message){
  wss.clients.forEach(function (client) {
    client.send(message);
});
}

app.listen(8080);
