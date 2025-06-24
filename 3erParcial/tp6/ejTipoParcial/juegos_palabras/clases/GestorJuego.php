<?php
require_once __DIR__ . '/Palabra.php';
require_once __DIR__ . '/Pista.php';
require_once __DIR__ . '/../dao/PalabraDAO.php';
require_once __DIR__ . '/../dao/PistaDAO.php';

class GestorJuego {

    /** @var Palabra|null */
    private $palabra; 

    /** @var Pista[] */
    private $pistasTotales = []; 

    /** @var Pista[] */
    private $pistasMostradas = []; 
    private $puntaje = 80;
    private $indicePista = 0;
    private $maxPistas = 5;

    public function iniciarPartida() {
        $this->palabra = PalabraDAO::buscarRandom();
        if (!$this->palabra) throw new Exception("No se pudo seleccionar una palabra");
        
        $this->pistasTotales = PistaDAO::obtenerPorIdPalabra($this->palabra->getId());
        $this->puntaje = 80;
        $this->pistasMostradas = [];
        $this->indicePista = 0;
    }

    public function obtenerInfoInicial() {
    return [
        'longitud' => mb_strlen($this->palabra->getPalabra()),
        'dificultad' => $this->palabra->getDificultad(),
        'acertada' => $this->palabra->getAcertada(),
        'puntaje' => $this->puntaje,
        'id' => $this->palabra->getId(),          
        'palabra' => $this->palabra->getPalabra()  
    ];
}

    //Verifica que:Aún no se hayan mostrado todas las pistas disponibles
    //Y no se haya superado el límite máximo de pistas permitidas
    public function darPista() {
        if ($this->indicePista < count($this->pistasTotales) && $this->indicePista < $this->maxPistas) {
            //Toma la pista que corresponde al índice actual ($this->indicePista) del array de pistas totales.
            $pista = $this->pistasTotales[$this->indicePista];

            //Guarda esa pista en el array de pistas ya mostradas, para llevar control.
            $this->pistasMostradas[] = $pista;

            //Aumenta en 1 el índice para que la próxima vez se dé la siguiente pista.
            $this->indicePista++;

            //Resta 15 puntos al puntaje del jugador por haber pedido una pista.
            //Usa max(0, ...) para que nunca quede en negativo.
            $this->puntaje = max(0, $this->puntaje - 15);

            //devuelve el objeto pista, ojardo aca
            return $pista;
        }
        return null;
    }

    public function arriesgar($intentoUsuario) {
        $intentoNormalizado = mb_strtolower(trim($intentoUsuario));
        $palabraCorrecta = mb_strtolower($this->palabra->getPalabra());

        if ($intentoNormalizado === $palabraCorrecta) {
            PalabraDAO::aumentarAcertada($this->palabra->getId());
            return [
                'resultado' => true,
                'puntaje' => $this->puntaje
            ];
        } else {
            return [
                'resultado' => false,
                'puntaje' => 0
            ];
        }
    }

    public function rendirse() {
        return [
            'resultado' => false,
            'puntaje' => 0
        ];
    }


    public function getPuntaje() {
        return $this->puntaje;
    }

    public function getPalabra() {
        return $this->palabra;
    }

    public function getPistasMostradas() {
        return $this->pistasMostradas;
    }
}
