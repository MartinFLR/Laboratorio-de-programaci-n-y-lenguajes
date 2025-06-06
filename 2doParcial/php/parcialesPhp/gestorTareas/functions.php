<?php


function formularioInicioSesion()
{ ?>
    <form name="formLogin" action="inicioSesion.php" method="POST">
        <fieldset>
            <legend>Iniciar sesión</legend>

            <div>
                <label for="idnombre">Nombre:</label><br>
                <input type="text" id="idnombre" name="nombre" required>
            </div>

            <div>
                <label for="idpassword">Contraseña:</label><br>
                <input type="password" id="idpassword" name="password" required>
            </div>

            <div>
                <input type="checkbox" id="idremember" name="remember" value="1">
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


function mostrarGestorTareas(User $user) {
    ?>
    <div>  
        <form name="formTarea" action="pagTareas.php" method="POST">
            <label for="tarea">Ingresa una tarea:</label><br>
            <input type="text" id="tarea" name="tarea" required>
            <div>
                <button type="submit" name="ingresarTarea">Ingresar tarea</button>
            </div>
        </form>

        <div class="tableros">
            <div class="tareasPendientes">
                <h3>Tareas pendientes</h3>
                <?php
                foreach ($user->getTareasPendientes() as $data) {
                    echo "<p>" . nl2br(htmlspecialchars($data)) . "</p>";
                }
                ?>
            </div>

            <div class="tareasActivas">
                <h3>Tareas activas</h3>
                <?php
                foreach ($user->getTareasActivas() as $data) {
                    echo "<p>" . nl2br(htmlspecialchars($data)) . "</p>";
                }
                ?>
            </div>

            <div class="tareasFinalizadas">
                <h3>Tareas finalizadas</h3>
                <?php
                foreach ($user->getTareasFinalizadas() as $data) {
                    echo "<p>" . nl2br(htmlspecialchars($data)) . "</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}


