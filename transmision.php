<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transmisión en Vivo con Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #004853;
            margin: auto;
            margin-left: 100px;
            margin-bottom: 100px;
            padding: 0;
            justify-content: space-around;
            height: 220px;
        }

        #video-container {
            flex: 1;
            margin-top: 10px;
            max-width: 800px;
            align-items: center;
            border-radius: 8px;
            background-color: #007e80;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #jitsi-container {
            align-items: center;
            position: relative;
            top: 40px; left: 70px;
        }

        #chat-container {
            flex: 1;
            margin-left: 20px;
            margin-bottom: 20px;
            max-width: 400px;
            padding: 20px;
            background-color: #00b9bd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #messages {
            list-style: none;
            padding: 0;
        }

        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div id="video-container">
        <h2>Transmisión en Vivo</h2>
    <div id="chat-container">
        <h2>Chat en Vivo</h2>
        <ul id="messages"></ul>
        <form id="form" action="">
            <input id="m" autocomplete="off" /><button>Enviar</button>
        </form>
    </div>
    
    <div id="jitsi-container">
    <script src="https://meet.jit.si/external_api.js"></script>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    </div>

        $(document).ready(function () {
            function actualizarChat() {
                // Obtener mensajes desde el archivo
                $.get('obtener_mensajes.php', function (data) {
                    $('#messages').html(data);
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
