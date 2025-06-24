<!DOCTYPE html>
<html>
<head>
    <title>Adivina la palabra!</title>
</head>
<body>
    <header>
        <h1>Adivina la palabra!</h1>
    </header>
    <main>
        <h2>Información de la palabra</h2>
        <div id="informacion"></div>  

        <h2>Pistas</h2>
        <div id="pistas"></div>  

        <h2>Controles</h2>
        <div id="controles">
            <input type="text" id="input-intento" placeholder="Escribe tu palabra aquí" />
            <button onclick="arriesgarPalabra()">Arriesgar palabra</button>
            <button onclick="pedirPista()">Pedir pista</button>
            <button onclick="rendirse()">Rendirse</button>
            <button onclick="iniciarPartida()">Nueva partida</button>
        </div>

        <h2>Resultado</h2>
        <div id="resultado"></div>

        <h3 id="puntaje"></h3> 
    </main>

    <footer>
        <p>Martín Leonardo Flores</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
