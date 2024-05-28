const express = require('express');

const app = express();

const server =  require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: { origin: "*" }
});

io.on('connection', (socket) => {
    console.log('connection');

    socket.on('joinRoom', (room_id) => {
        socket.join(room_id);
        console.log('berhasil Join Room! ' + room_id);
    });

    socket.on('sendChatToServer', (message) => {
        console.log(message);

        io.to(message.room_id).emit('sendChatToClient', message);

        // io.sockets.emit('sendChatToClient', message);
        // socket.broadcast.emit('sendChatToClient', message);
    });

    socket.on('disconnect', (socket) => {
        console.log('disconnect');
    });
});


server.listen(3000, () => {
    console.log('Server is running');
});
