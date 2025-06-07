<?php


function formularioInicioSesion()
{
    $nombreRecordado = $_COOKIE['remembered_user'] ?? '';
    $contraRecordada = $_COOKIE['remembered_pass'] ?? '';
?>
    <form name="formLogin" action="inicioSession.php" method="POST">
        <fieldset>
            <legend>Iniciar sesión</legend>

            <div>
                <label for="idnombre">Nombre:</label><br>
                <input type="text" id="idnombre" name="nombre" required value="<?= htmlspecialchars($nombreRecordado) ?>">
            </div>

            <div>
                <label for="idpassword">Contraseña:</label><br>
                <input type="password" id="idpassword" name="password" required value="<?= htmlspecialchars($contraRecordada) ?>">
            </div>

            <div>
                <input type="checkbox" id="idremember" name="remember" value="1" <?= $nombreRecordado ? 'checked' : '' ?>>
                <label for="idremember">Recordarme</label>
            </div>

            <div>
                <button type="submit" name="login">Ingresar</button>
            </div>
        </fieldset>
    </form>

    <p>No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
<?php
}


function volver(){
    ?>
    <p><a href="index.php">Volver</a></p>
    <?php
}


function formularioRegistro()
{ ?>
    <form name="formRegistro" action="registro.php" method="POST">
        <fieldset>
            <legend>Registrarse</legend>

            <div>
                <label for="idnombre">Nombre:</label><br>
                <input type="text" id="idnombre" name="nombre" required>
            </div>

            <div>
                <label for="idpassword">Contraseña:</label><br>
                <input type="password" id="idpassword" name="password" required>
            </div>

            <div>
                <label for="idconfirmar">Confirmar contraseña:</label><br>
                <input type="password" id="idconfirmar" name="confirmar_password" required>
            </div>

            <div>
                <button type="submit" name="register">Registrarme</button>
            </div>
        </fieldset>
    </form>
<?php
}



