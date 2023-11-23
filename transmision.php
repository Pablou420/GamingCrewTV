<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transmisión en Vivo con Chat</title>
    <link rel="stylesheet" type="text/css" href="global.scss">
    <style>
        body {
            background-color: #004853;
            margin: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        #jitsi-container,
        #chat-container {
            width: 45%;
            height: 80vh;
            overflow: hidden;
        }

        #jitsi-container {
            background-color: #000;
        }

        #chat-container {
            background-color: #333;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        #messages {
            flex: 1;
            overflow-y: auto;
        }

        #form {
            display: flex;
            margin-top: 10px;
        }

        #m {
            flex: 1;
            padding: 5px;
        }

        button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div id="jitsi-container">
        <script src="https://meet.jit.si/external_api.js"></script>
        <!-- Agrega el siguiente elemento de video -->
        <video id="video" autoplay playsinline muted></video>
        <script>
            var domain = "meet.jit.si";
            var options = {
                roomName: "GamingCrewTV",
                width: 1500,
                height: 700,
                parentNode: undefined,
                configOverwrite: {},
                interfaceConfigOverwrite: {}
            }
            var api = new JitsiMeetExternalAPI(domain, options);
        </script>
    </div>


    <div id="chat-container">
        <div id="messages"></div>
        <form id="form">
            <input type="text" id="m" autocomplete="off" placeholder="Escribe tu mensaje...">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            function actualizarChat() {
                $.get('obtener_mensajes.php', function (data) {
                    $('#messages').html(data);
                    // Hacer scroll hacia abajo para mostrar el mensaje más reciente
                    var chatContainer = document.getElementById('messages');
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
            }


            // Manejar el envío de mensajes desde el formulario
            $('#form').submit(function () {
                $.post('enviar_mensaje.php', { mensaje: $('#m').val() }, function (response) {
                    if (response.status === 'success') {
                        // Limpiar el campo de entrada después de enviar el mensaje
                        $('#m').val('');
                        // Actualizar el chat después de enviar un mensaje
                        actualizarChat();
                    }
                }, 'json');

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

            // Actualizar el chat cada 2 segundos (puedes ajustar este intervalo según tus necesidades)
            setInterval(actualizarChat, 2000);
        });
    </script>
</body>
</html>
