
function start() {
    var ip_in = document.getElementById("ip");
    var port_in = document.getElementById("port");
    window.ip = ip_in.value;
    window.port = port_in.value;
    window.msgid = 0;
    console.log("Server is:" + window.ip + ":" + window.port);
    link(window.ip, window.port);
    return true;
}
window.message = [];
var heartbeatcount =0;
function Client() {

}
Client.prototype.createConnect = function (max, delay, server, port) {
    var self = this;
    if (max === 0) {
        return;
    }
    connect(server, port);
    var server_temp = server;
    var port_temp = port;
    var heartbeatInterval;

    function connect(server, port) {
        var ws = new WebSocket('ws://' + server + ':' + port + '/sub');

        var auth = false;

        ws.onopen = function () {
            getAuth();
        }

        ws.onmessage = function (evt) {
            var receives = JSON.parse(evt.data)
            for (var i = 0; i < receives.length; i++) {
                var data = receives[i];
                console.log(data);
                if (data.op == 8) {
                    auth = true;
                    
                    heartbeat();
                    heartbeatInterval = setInterval(heartbeat, 10 * 1000);
                }
                if (!auth) {
                    setTimeout(getAuth, delay);
                }
                if (auth && data.op == 5) {
                    var msg = JSON.stringify(data.body);
                    data.body.msgid = window.msgid;
                    console.log("Message:" + msg);
                    window.message.push(data.body);
                    window.msgid += 1;
                }
            }
        }

        ws.onclose = function () {
            if (heartbeatInterval) clearInterval(heartbeatInterval);
            setTimeout(reConnect, delay);
        }

        function heartbeat() {
            console.log("heartbeat");
            ws.send(JSON.stringify({
                'ver': 1,
                'op': 2,
                'seq': 2,
                'body': {}
            }));
        }

        function getAuth() {
            console.log("getauth");
            ws.send(JSON.stringify({
                'ver': 1,
                'op': 7,
                'seq': 1,
                'body': {
                    'data': {}
                }
            }));
        }

        function reConnect() {
            if ((window.ip == server_temp) && (window.port == port_temp))
                self.createConnect(--max, delay * 2, window.ip, window.port);
            else return false;
        }
    }
}

function link(ip, port) {
    var instance = new Client();
    var MAX_CONNECT_TIME = 100;
    var DELAY = 15000;
    instance.createConnect(MAX_CONNECT_TIME, DELAY, window.ip, window.port);
    console.log("debug:finish create!");
}
