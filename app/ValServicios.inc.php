<?php 
include_once 'RepositorioPropietarios.inc.php';

class ValServicios {
    private $usuario;
    private $error;
    
    public function __construct($email, $clave, $conexion){
        $this -> error = "";
        
        if (!$this -> variable_iniciada($email) || !$this -> variable_iniciada($clave) ){
        $this -> usuario = null;
        $this -> error = "debes introducir tu email y tu contraseña";
        }else{
            $this ->usuario = RepositorioPropietarios :: obtener_usuario_por_email($conexion, $email);
            
            if(is_null($this -> usuario) || !password_verify($clave, $this -> usuario -> obtener_password())){
                $this -> error = "DATOS INCORRECTOS!!";
            }
        }
        
    }
    
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    public function obtener_usuario(){
        return $this -> usuario;
    }
    
    public function obtener_error(){
        return $this -> error;
    }
    
    public function mostrar_error(){
        if($this -> error !==''){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this -> error;
            echo "</div><br>";
        }
    }
    
    
    
}