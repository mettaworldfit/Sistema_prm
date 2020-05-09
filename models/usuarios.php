<?php

require_once 'modelo.php';

class Usuarios extends ModeloBase
{


    private $id;
    public $nombre;
    public $apellidos;
    public $usuario;
    public $password;
    public $perfil;
    public $status;
    private $acceso;
    private $telefono;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
        return $this;
    }

    public function getAcceso()
    {
        return $this->acceso;
    }

    public function setAcceso($acceso)
    {
        $this->acceso = $acceso;
        return $this;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function save()
    {

        $query = "INSERT INTO usuarios VALUES (null,'{$this->getNombre()}','{$this->getApellidos()}',
        '{$this->getUsuario()}','{$this->getPassword()}','{$this->getPerfil()}','enabled','{$this->getAcceso()}',CURDATE(),'{$this->getTelefono()}');";

        return $this->db->query($query);
    }

    public function update($id)
    {
        
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $usuario = $this->getUsuario();
        $password = $this->getPassword();
        $perfil = $this->getPerfil();
        // $estado = $this->getEstado();
        $acceso = $this->getAcceso();
        $telefono = $this->getTelefono();


        $query = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos',
        usuario = '$usuario', password = '$password', perfil = '$perfil', 
        acceso = '$acceso', estado = 'enabled', telefono = '$telefono' WHERE idusuario = '$id'";

        return $this->db->query($query);
    }

    public function delete()
    {
        $id = $this->getId();
        $query = "DELETE FROM usuarios WHERE idusuario = '$id'";

        return $this->db->query($query);
    }

    public function login()
    {
        $result = false;

        $username = $this->usuario;
        $password = $this->password;

        $query = "SELECT *FROM usuarios WHERE usuario = '$username'";
        $login = $this->db->query($query);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            $verify = password_verify($password, $usuario->password);
            $verify2 = $password;   // verificar contraseña normal 

            if ($verify) {

                $result = $usuario;
                header("Location: " . base_url);
            } else  if ($verify2 == $usuario->password) {

                $result = $usuario;
                header("Location: " . base_url);
            } else {
                $result = false;
            }
            
        } else {
            $result = false;
        }

        return $result;
    }
}
