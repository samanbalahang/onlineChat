<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <ul class="msg-list">
            </ul>
        </div>
        <form method="post" id="chatForm">
            <div class="form-group">
                <label for="message"></label>
                <input type="text" name="message" id="message" class="form-control" />
            </div>
            <div>
                <input type="submit" id="subBtn" class="btn btn-info" value="send">
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> 
    $(document).ready(function() {
        var conn = new WebSocket('ws://localhost:8080');
        var chatForm = $('#chatForm');
        var userMessage = $("#message");
        var msgList = $('.msg-list');
        chatForm.on('submit', function(e){
            e.preventDefault();
            var message = userMessage.val();
            conn.send(message);
            msgList.prepend("<li style='color:blue;'>" + message +"</li>");
        });
        conn.onopen = function(e) {
            console.log("Connection stablished");
        }
        conn.onmessage = function(e) {
            console.log(e.data);
            msgList.prepend("<li style='color:red;'>" + e.data + "</li>");
        }        
    });
    </script>
</body>
</html>