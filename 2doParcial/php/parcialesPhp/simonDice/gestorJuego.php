<?php
declare(strict_types=1);

require_once 'jugador.php';
require_once 'arrayUtils.php';
require_once 'sessionManager.php';

class GestorJuego {
    public const COLORES = ["R", "A", "Y", "V"];

    private SessionManager $session;
    public Jugador $jugador;
    public int $cantidad;
    public int $turno;
    private array $arraySecuencia;
    public array $arraySecreto;

    public function __construct() {
        $this->session = new SessionManager();
        $this->cantidad = (int) ($this->session->get("cantidad") ?? 0);

        $this->turno = $this->session->get("turno") ?? 0;
        $this->jugador = $this->session->get("jugador") ?? new Jugador();
        $this->arraySecuencia = $this->session->get("arraySecuencia") ?? $this->generarSecuencia();
        $this->arraySecreto = $this->session->get("arraySecreto") ?? $this->generarSecreto();

        // Siempre guardar jugador en sesión si es nuevo
        $this->guardarEstado();
    }

    private function generarSecuencia(): array {
        $secuencia = [];
        for ($i = 0; $i < $this->cantidad; $i++) {
            $secuencia[] = ArrayUtils::randomValue(self::COLORES);
        }
        $this->session->set("arraySecuencia", $secuencia);
        return $secuencia;
    }

    private function generarSecreto(): array {
        $secreto = array_slice($this->arraySecuencia, 0, $this->turno + 1);
        $this->session->set("arraySecreto", $secreto);
        return $secreto;
    }

    public function validarRespuesta(string $respuesta): bool {
        $respuestaArray = str_split(strtoupper(trim($respuesta)));

        if ($respuestaArray === $this->arraySecreto) {
            // Victoria total si coincide con la secuencia completa
            if ($respuestaArray === $this->arraySecuencia) {
                $this->victoriaPartida();
            }

            $this->turno++;
            $this->arraySecreto = $this->generarSecreto();
            $this->session->set("turno", $this->turno);
            return true;
        }

        // Si falló
        $this->jugador->restarVida();
        $this->session->set("jugador", $this->jugador);

        if ($this->jugador->getVida() === 0) {
            $this->derrotaPartida();
        }

        return false;
    }

    public function getVidaActual(): int {
        return $this->jugador->getVida();
    }

    public function reiniciarJuego(): void {
        session_destroy();

    }

    private function guardarEstado(): void {
        $this->session->set("turno", $this->turno);
        $this->session->set("jugador", $this->jugador);
        $this->session->set("arraySecuencia", $this->arraySecuencia);
        $this->session->set("arraySecreto", $this->arraySecreto);
    }

    private function derrotaPartida(): void {
        $_SESSION['resultado'] = 'derrota';
        $_SESSION['mensaje'] = '¡Perdiste! Intenta de nuevo.';
        header("Location: fin.php");
        exit;
    }

    private function victoriaPartida(): void {
        $_SESSION['resultado'] = 'victoria';
        $_SESSION['mensaje'] = '¡Felicidades! Ganaste el juego.';
        header("Location: fin.php");
        exit;
    }

    public function generarPantallaInit(): void {
        $arrayToString = implode('', $this->arraySecreto);

        echo "<form method='post' action='validarJugada.php'>
                <label for='respuesta'>Ingrese la secuencia:</label>
                <input type='text' id='respuesta' name='respuesta' required>
                <button type='submit'>Enviar</button>
            </form>
            <div><strong>Solución (debug):</strong> $arrayToString</div>";
    }
}
