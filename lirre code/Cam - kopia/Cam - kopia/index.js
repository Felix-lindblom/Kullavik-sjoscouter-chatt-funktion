//Sätter upp servern, så som https och vilen port det är på m.m.
const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http);
const port = process.env.PORT || 3000;


app.get('/', (req, res) => {
  res.sendFile(__dirname + '/chat.html');
});

//skickar ut chatt medelanden till alla på hemsidan
io.on('connection', (socket) => {
  socket.on('chat message', msg => {
    io.emit('chat message', msg);
  });
});

//Ser till att server adressen lyssnar på localhost:3000 då port är satt 3000 på rad 4
http.listen(port, () => {
  console.log(`Socket.IO server running at http://localhost:${port}/`);
});