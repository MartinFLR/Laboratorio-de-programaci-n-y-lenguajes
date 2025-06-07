<?php
class User {
    private string $user_id;
    private string $nombre;
    private string $contra;
    private array $tareasActivas;
    private array $tareasPendientes;
    private array $tareasFinalizadas;

    public function __construct(string $user_id, string $nombre, string $contra) {
        $this->user_id = $user_id;
        $this->nombre = $nombre;
        $this->contra = $contra;
        $this->tareasActivas = [];
        $this->tareasPendientes = [];
        $this->tareasFinalizadas = [];
    }

    
    public function getNombre(){
        return $this->nombre;
    }

    public function getContra(){
        return $this->contra;
    }

    public function getId(){
        return $this->user_id;
    }

    // Tareas Activas
    public function getTareasActivas(): array {
        return $this->tareasActivas;
    }
    
    public function agregarTareaActiva(string $tareasActivas): void {
        $this->tareasActivas[] = $tareasActivas;
    }
    
    public function setTareasActivas(array $tareasActivas): void {
        $this->tareasActivas = $tareasActivas;
    }

    public function eliminarTareaActiva(int $indice): void {
        if (isset($this->tareasActivas[$indice])) {
            unset($this->tareasActivas[$indice]);
            // Reindexar para que los índices no se rompan
            $this->tareasActivas = array_values($this->tareasActivas);
        }
    }
    

    // Tareas Pendientes
    public function getTareasPendientes(): array {
        return $this->tareasPendientes;
    }
    
    public function agregarTareaPendiente(string $tareasPendientes): void {
        $this->tareasPendientes[] = $tareasPendientes;
    }
    
    public function setTareaPendiente(array $tareasPendientes): void {
        $this->tareasPendientes = $tareasPendientes;
    }

    public function eliminarTareaPendiente(int $indice): void {
        if (isset($this->tareasPendientes[$indice])) {
            unset($this->tareasPendientes[$indice]);
            // Reindexar para que los índices no se rompan
            $this->tareasPendientes = array_values($this->tareasPendientes);
        }
    }
    

    // Tareas Finalizadas
    public function getTareasFinalizadas(): array {
        return $this->tareasFinalizadas;
    }
    
    public function agregarTareaFinalizada(string $tareasFinalizadas): void {
        $this->tareasFinalizadas[] = $tareasFinalizadas;
    }
    
    public function setTareasFinalizadas(array $tareasFinalizadas): void {
        $this->tareasFinalizadas = $tareasFinalizadas;
    }

    public function eliminarTareaFinalizada(int $indice): void {
        if (isset($this->tareasFinalizadas[$indice])) {
            unset($this->tareasFinalizadas[$indice]);
            // Reindexar para que los índices no se rompan
            $this->tareasFinalizadas = array_values($this->tareasFinalizadas);
        }
    }

    public function eliminarTodasTareas(): void {
        $this->tareasActivas = [];
        $this->tareasPendientes = [];
        $this->tareasFinalizadas = [];
    }
    



    public static function fromArray(array $data): User {
        $user = new User(
            $data['user_id'] ?? '',
            $data['nombre'] ?? '',
            $data['contra'] ?? ''
        );

        // Setear tareas si existen
        if (isset($data['tareasActivas']) && is_array($data['tareasActivas'])) {
            $user->setTareasActivas($data['tareasActivas']);
        }
        if (isset($data['tareasPendientes']) && is_array($data['tareasPendientes'])) {
            $user->setTareaPendiente($data['tareasPendientes']);
        }
        if (isset($data['tareasFinalizadas']) && is_array($data['tareasFinalizadas'])) {
            $user->setTareasFinalizadas($data['tareasFinalizadas']);
        }

        return $user;
    }


    public function toArray(): array {
        return [
            'user_id' => $this->user_id,
            'nombre' => $this->nombre,
            'contra' => $this->contra,
            'tareasActivas' => $this->tareasActivas,
            'tareasPendientes' => $this->tareasPendientes,
            'tareasFinalizadas' => $this->tareasFinalizadas
        ];
    }
    
}