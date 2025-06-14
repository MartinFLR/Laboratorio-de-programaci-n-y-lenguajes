<?php
function formularioingresoNumero()
{
?>
    <form name="formNumero" action="validarNumero.php" method="POST">
        <fieldset>
            <legend>Centros numericos</legend>

            <div>
                <label for="idNumero">Ingrese su numero:</label><br>
                <input type="number" min="1" placeholder="0" id="idNumero" name="numero" required>
            </div>


            <div>
                <button type="submit" name="ingreso">Ingresar</button>
            </div>
        </fieldset>
    </form>
<?php
}

