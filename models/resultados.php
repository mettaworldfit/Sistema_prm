<?php

require_once "modelo.php";

class Resultados extends ModeloBase
{
    private $id;
    private $mesa_electoral;
    private $partido;
    private $votos;


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

    public function setMesa($mesa)
    {
        $this->mesa_electoral = $mesa;
        return $this;
    }

    public function getMesa()
    {
        return $this->mesa_electoral;
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

    public function setVotos($votos)
    {
        $this->votos = $votos;
        return $this;
    }

    public function getVotos()
    {
        return $this->votos;
    }

    public function showAll()
    {
        $query = "SELECT r.idresultado, r.partido, r.votos, r.fecha AS 'fecha', m.colegio_electoral AS 'colegio' 
        FROM resultados_finales r INNER JOIN mesas_electorales m ON r.idmesa = m.idmesa ORDER BY m.colegio_electoral";

        return $this->db->query($query);
    }

    public function save()
    {
        $query = "INSERT INTO resultados_finales VALUES (null,'{$this->getMesa()}','{$this->getPartido()}','{$this->getVotos()}',NOW())";

        return $this->db->query($query);
    }

    public function update($id)
    {

        $query = "UPDATE resultados_finales SET idmesa = '{$this->getMesa()}' , partido = '{$this->getPartido()}', 
        votos = '{$this->getVotos()}' WHERE idresultado = '$id'";

        return $this->db->query($query);
    }

    public function delete()
    {
        $id = $this->getId();
        $query = "DELETE FROM resultados_finales WHERE idresultado = '$id'";

        return $this->db->query($query);
    }
}
