        
        
        <?php
        session_start();
        require_once 'persona.php';
        require_once 'gestorUsuarios.php';
        
            $persona = new Persona($_POST['usuario'], $_POST['clave']);
            $gestorUsuarios = new GestorUsuarios();
            $existe = $gestorUsuarios->autenticarPersona($persona->getNombre(),$persona->getContra());
            if($existe){
                $_SESSION['usuario'] = $persona->getNombre();
                header('Location: bienvenida.php');
                $persona->saludar();
                exit;
            }else{
                $_SESSION['error'] = "Su usuario no existe";
                header('Location: form.php');
                exit;
            }
        
        ?>
