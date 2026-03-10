const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

const server = http.createServer(app);

const io = new Server(server, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

io.on("connection", (socket) => {

    console.log("Client connected:", socket.id);

    socket.on("join-lane", (laneId) => {

        socket.rooms.forEach(room => {
            if(room !== socket.id){
                socket.leave(room);
            }
        });

        socket.join("lane-" + laneId);
        console.log("Client join lane:", laneId);
    });

    socket.on("disconnect", () => {
        console.log("Client disconnected:", socket.id);
    });

});

app.post("/broadcast", (req, res) => {

    const data = req.body;

    console.log("Emit dari PHP:", data);

    if(!data.laneId){
        return res.status(400).json({ error: "laneId required" });
    }

    const event = data.type;

    io.to("lane-" + data.laneId).emit(event, data);

    res.json({ status: "ok" });
});


server.listen(3000, () => {
    console.log("Realtime server running on port 3000");
});