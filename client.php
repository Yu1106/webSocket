<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>WebSocket</title>
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        var socket;  // WebSocket
        $(document).ready(function () {
            SetupWebSocket();
        });

        // 連線至提供資料的WebSocket
        function SetupWebSocket() {
            var host = 'ws://localhost:12345/server.php';
            socket = new WebSocket(host);
            socket.onopen = function (e) {
                socket.send('today is 20200215 firrst test websocket');
                $('#ShowTime').html('WebSocket Connected!');
            };
            socket.onmessage = function (e) {
                $('#ShowTime').html(e.data);
            };
            socket.onclose = function (e) {
                alert('Disconnected - status ' + this.readyState);
            };
        }
    </script>
</head>
<body>
<div id="ShowTime" Style="font-size:24px"></div>
</body>
</html>