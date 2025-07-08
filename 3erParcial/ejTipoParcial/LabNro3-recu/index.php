<!DOCTYPE html>
<html>
<head>
    <title>Ministerio de Transporte de la República Argentina</title>

    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <h1>Lab3</h1>
    </header>
    <main>
        <h2>Ministerio de Transporte de la República Argentina</h2>
        <div id="informacion"></div>  

        <h2>Filtros</h2>

            <select id="empresa" name="empresa">
                <option value="">Seleccione una empresa</option>
            </select>
            <select id="dia" name="dia">
                <option value="">Seleccione un dia</option>
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miercoles">Miercoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
                <option value="sabado">Sabado</option>
                <option value="domingo">Domingo</option>

            </select>

        <h2>Resultado</h2>
        <div id="resultado"></div>

    </main>

    <footer>
        <p>Martín Leonardo Flores</p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
