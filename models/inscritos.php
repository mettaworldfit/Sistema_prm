<?php

require_once 'modelo.php';

class Inscritos extends ModeloBase
{
    private $id;
    private $query;
    private $posicion;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $numero_de_identidad;
    private $partido;
    private $mesa_electoral;
    private $condicion;

    public function __construct()
    {
        parent::__construct();
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
        return $this;
    }

    public function getPosicion()
    {
        return $this->posicion;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setCedula($cedula)
    {
        $this->numero_de_identidad = $cedula;
        return $this;
    }

    public function getCedula()
    {
        return $this->numero_de_identidad;
    }

    public function setMesa($mesa)
    {
        $this->mesa_electoral = $mesa;
        return $this;
    }

    public function getMesa()
    {
        return $this->mesa_electoral;
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

    public function setPartido($partido)
    {
        $this->partido = $partido;
        return $this;
    }

    public function getPartido()
    {
        return $this->partido;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;
        return $this;
    }

    public function getCondicion()
    {
        return $this->condicion;
    }

    public function showAll()
    {
        $query = "SELECT *FROM personas_inscritas p INNER JOIN  
        mesas_electorales m ON p.idmesa = m.idmesa ORDER BY p.apellidos ASC";

        $datos = $this->db->query($query);
        return $datos;
    }

    public function save()
    {

        $query = "INSERT INTO personas_inscritas (idmesa,posicion_colegio,nombre,apellidos,numero_de_identidad,telefono,partido_perteneciente,fecha,condicion) 
        VALUES ('{$this->getMesa()}','{$this->getPosicion()}','{$this->getNombre()}','{$this->getApellidos()}','{$this->getCedula()}','{$this->getTelefono()}',
        '{$this->getPartido()}',CURDATE(),'{$this->getCondicion()}')";

        $datos = $this->db->query($query);
        return $datos;
    }

    public function delete()
    {
        $id = $this->getId();
        $query = "DELETE FROM personas_inscritas WHERE idpersona = '$id'";

        return $this->db->query($query);
    }

    public function votar($respuesta, $id)
    {
        $query = "UPDATE personas_inscritas SET ha_votado = '$respuesta' WHERE idpersona = '$id'";

        return $this->db->query($query);
    }

    public function update($id)
    {
        
        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $cedula = $this->getCedula();
        $mesa = $this->getMesa();
        $telefono = $this->getTelefono();
        $posicion = $this->getPosicion();
        $partido = $this->getPartido();
        $condicion = $this->getCondicion();


        $query = "UPDATE personas_inscritas SET nombre = '$nombre', apellidos = '$apellidos',
        numero_de_identidad = '$cedula', idmesa = '$mesa', telefono = '$telefono', 
        posicion_colegio = '$posicion', partido_perteneciente = '$partido', condicion = '$condicion' WHERE idpersona = '$id'";

        return $this->db->query($query);
    }

    public function search()
    {
        $q = $this->getQuery();

        $query = "SELECT *FROM personas_inscritas p INNER JOIN mesas_electorales m ON p.idmesa = m.idmesa
         WHERE nombre LIKE '%" . $q . "%' OR apellidos LIKE '%" . $q . "%' OR numero_de_identidad LIKE '%" . $q . "%'";

        return $this->db->query($query);
    }
}
