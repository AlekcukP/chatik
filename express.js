const express = require('express');
const app = require('express')();
const expressWs = require('express-ws')(app);
const wss = expressWs.getWss();
const jwt = require('jsonwebtoken');
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
  if(checkJwt(req.body.jwt)){
    sendMessage(JSON.stringify(req.body));
  }
})

function sendMessage(message){
  wss.clients.forEach(function (client) {
    client.send(message);
});
}

function checkJwt(token){
  const key = 'secret_key';

  try{
    let decoded = jwt.verify(token, key);
    return decoded.data;
  } catch(error) {
    console.log(error);
    return null;
  }
}

app.listen(8080);
