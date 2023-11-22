<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transmisión en Vivo con Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: space-around;
            height: 100vh;
        }

        #video-container {
            flex: 1;
            max-width: 800px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #chat-container {
            flex: 1;
            margin-left: 20px;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #messages {
            list-style: none;
            padding: 0;
            overflow-y: scroll;
            max-height: 300px; /* Ajusta según tus necesidades */
        }

        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div id="video-container">
        <h2>Transmisión en Vivo</h2>
        <video id="video" controls autoplay playsinline style="width: 100%;"></video>
    </div>

    <div id="chat-container">
        <h2>Chat en Vivo</h2>
        <ul id="messages"></ul>
        <form id="form" action="">
            <input id="m" autocomplete="off" /><button>Enviar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.5/firebase-database.js"></script>
    <script>
        // Configuración de Firebase (reemplaza con tu propia configuración)
        var firebaseConfig = {
            apiKey: "AIzaSyDNbT7HesuApTeNz06vwh3PPxvSpmF-kg4",
            authDomain: "chat-poyecto.firebaseapp.com",
            projectId: "chat-poyecto",
            storageBucket: "chat-poyecto.appspot.com",
            messagingSenderId: "274196426167",
            appId: "1:274196426167:web:67628d8edd7a7e80404c32",
            measurementId: "G-NF961Q2D1K"
            };

        // Inicializar Firebase
        firebase.initializeApp(firebaseConfig);

        // Referencia a la base de datos de Firebase
        var database = firebase.database();

        $(document).ready(function () {
            var chatRef = database.ref('chat');

            function actualizarChat(snapshot) {
                // Obtener los mensajes desde Firebase
                var mensajes = snapshot.val();
                $('#messages').empty();
                mensajes.forEach(function (mensaje) {
                    $('#messages').append('<li>' + mensaje + '</li>');
                });

                // Desplazar el contenedor del chat hacia abajo para mostrar los mensajes más recientes
                $('#messages').scrollTop($('#messages')[0].scrollHeight);
            }

            // Escuchar cambios en la base de datos (nuevos mensajes)
            chatRef.on('value', actualizarChat);

            // Manejar el envío de mensajes desde el formulario
            $('#form').submit(function () {
                // Obtener el mensaje del campo de entrada
                var mensaje = $('#m').val();

                // Enviar el mensaje a Firebase
                chatRef.push(mensaje);

                // Limpiar el campo de entrada después de enviar el mensaje
                $('#m').val('');

                return false;
            });

            // Obtener acceso a la cámara del usuario y mostrar el video
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    var video = document.getElementById('video');
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.error('Error al acceder a la cámara:', error);
                });
        });
    </script>

</body>
</html>
