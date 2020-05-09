<?php

require_once 'modelo.php';

class Colegios extends ModeloBase
{

    private $id;


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

    public function showAll()
    {
        $query = "SELECT *FROM mesas_electorales ORDER BY colegio_electoral";

        return $this->db->query($query);
    }

    public function delete()
    {
        $id = $this->getId();
        $query = "DELETE FROM mesas_electorales WHERE idmesa = '$id'";

        return $this->db->query($query);
    }

    public function Total_inscritos_colegio()
    {
        $query = "SELECT m.idmesa AS 'idmesa', m.colegio_electoral AS 'colegio', m.ubicacion, 
        COUNT(p.idpersona) AS 'total', m.recinto FROM mesas_electorales m LEFT JOIN
        personas_inscritas p ON m.idmesa = p.idmesa GROUP BY m.idmesa ORDER BY m.colegio_electoral";

        return $this->db->query($query);
    }

    public function Restriccion_colegio($acceso)
    {
        $query = "SELECT m.idmesa AS 'idmesa', m.colegio_electoral AS 'colegio', m.ubicacion AS 'ubicacion', 
        COUNT(p.idpersona) AS 'total', m.recinto FROM mesas_electorales m LEFT JOIN
        personas_inscritas p ON m.idmesa = p.idmesa WHERE m.colegio_electoral = '$acceso' GROUP BY m.idmesa";

        return $this->db->query($query);
    }

    public function Han_votado()
    {
        $query = "SELECT p.idpersona, CONCAT(p.nombre,' ',p.apellidos) AS 'nombre', p.numero_de_identidad, m.colegio_electoral, p.partido_perteneciente
        FROM personas_inscritas p INNER JOIN mesas_electorales m ON p.idmesa = m.idmesa WHERE ha_votado = 'si'";

        return $this->db->query($query);
    }

    public function Total_votos_por_partido($partido)
    {
        $query = "SELECT count(idpersona) AS 'total' from personas_inscritas WHERE ha_votado = 'si' AND partido_perteneciente = '$partido'";

        return $this->db->query($query);
    }

    public function search($q, $mesa)
    {

        $query = "SELECT *FROM personas_inscritas p INNER JOIN mesas_electorales m ON p.idmesa = m.idmesa
        WHERE posicion_colegio = '$q' AND m.colegio_electoral = '$mesa'";

        return $this->db->query($query);
    }
}
