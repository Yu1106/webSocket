<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>WebSocket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        var socket;  // WebSocket
        $(document).ready(function () {
            var socket = SetupWebSocket();
            $(".btn").on('click', function () {
                socket.send($("#textarea").val());
                $("#textarea").val('');
            });
            $("#textarea").on('keypress', function (e) {
                if (e.keyCode == 13) {
                    socket.send($("#textarea").val());
                    $("#textarea").val('');
                }
            });
        });

        // 連線至提供資料的WebSocket
        function SetupWebSocket() {
            var host = 'ws://localhost:12345/server.php';
            socket = new WebSocket(host);
            socket.onopen = function (e) {
                socket.send(new Date());
                $('#ShowTime').append('<br>WebSocket Connected!');
            };
            socket.onmessage = function (e) {
                $('#ShowTime').append('<br>>' + e.data);
            };
            socket.onclose = function (e) {
                $('#ShowTime').append('<br>Disconnected - status ' + this.readyState);
            };
            return socket;
        }
    </script>
</head>
<body>
<style>
    #ShowTime {
        　padding-bottom: 100px;
    }

    #footer {
        　height: 100px;
        　position: relative;
        　margin-top: -100px;
    }
</style>
<div id="ShowTime" Style="font-size:24px"></div>
<div id="footer" class="container">
    <form>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">輸入文字</label>
            <textarea class="form-control" id="textarea" rows="3"></textarea>
        </div>
        <button type="button" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>