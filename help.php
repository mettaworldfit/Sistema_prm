<?php


class Help
{

    public static function redirect()
    {
        header("Location: " . base_url);
    }

    public static function unRegister()
    {
        header("Location: " . base_url . "?controller=usuarios&action=login");
    }

    public static function AccDenied()
    {
        header("Location: " . base_url . "?controller=home&action=denied");
    }

    public static function Colegio($mesa)
    {
        $db = DataBase::connect();
        $query = "SELECT idmesa FROM mesas_electorales where colegio_electoral = '$mesa'";
        return $db->query($query);
    }

    public static function Colegios_totales()
    {

        $db = DataBase::connect();
        $query = "SELECT COUNT(idmesa) AS 'id' FROM mesas_electorales";
        return $db->query($query);
    }

    public static function Total_inscritos()
    {
        $query = "SELECT COUNT(idpersona) AS 'id' FROM personas_inscritas";
        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function Total_por_partidos($partido)
    {
        $query = "SELECT COUNT(idpersona) AS 'id' FROM personas_inscritas WHERE partido_perteneciente = '$partido'";
        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function Personas_inscritas($colegio)
    {
        $query = "SELECT *FROM personas_inscritas p INNER JOIN  
        mesas_electorales m ON p.idmesa = m.idmesa HAVING m.colegio_electoral = '$colegio' ORDER BY p.posicion_colegio DESC";

        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function Info_persona($id)
    {
        $query = "SELECT *FROM personas_inscritas p INNER JOIN  
        mesas_electorales m ON p.idmesa = m.idmesa HAVING p.idpersona = '$id'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function Info_usuario($id)
    {
        $query = "SELECT * FROM usuarios WHERE idusuario = '$id'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function Votos_totales($respuesta)
    {
        $query = "SELECT m.idmesa ,count(p.idpersona) AS 'han_votado', m.colegio_electoral, m.ubicacion, m.recinto FROM personas_inscritas p INNER JOIN 
        mesas_electorales m ON p.idmesa = m.idmesa WHERE ha_votado = '$respuesta' GROUP BY m.colegio_electoral;";

        $db = DataBase::connect();
        return $db->query($query);
    }


    public static function Votos_restantes($respuesta, $id)
    {
        $query = "SELECT count(p.idpersona) AS 'han_votado', m.colegio_electoral, m.ubicacion, m.recinto FROM personas_inscritas p INNER JOIN 
        mesas_electorales m ON p.idmesa = m.idmesa WHERE ha_votado = '$respuesta' AND m.idmesa = '$id'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    // Cuantos han votado por un partido en una mesa

    public static function Total_partido_colegio($partido, $colegio)
    {
        $query = "SELECT count(idpersona) AS 'total' FROM personas_inscritas p inner join mesas_electorales m on p.idmesa = m.idmesa
        where p.ha_votado = 'Si' AND p.partido_perteneciente = '$partido' AND m.colegio_electoral = '$colegio'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    // Personas que han votado en una mesa
    public static function Votos_de_mesa($colegio)
    {
        $query = "SELECT *FROM personas_inscritas p inner join mesas_electorales m on p.idmesa = m.idmesa
        WHERE (select count(idpersona) from personas_inscritas where p.ha_votado = 'Si' AND m.colegio_electoral = '$colegio' )";

        $db = DataBase::connect();
        return $db->query($query);
    }

    // personas que pertenecen al partido

    public static function partido($partido)
    {
        if ($partido == "prm" || $partido == "pld") {

            $query = "SELECT *from personas_inscritas p inner join mesas_electorales m on p.idmesa = m.idmesa
            WHERE (select count(idpersona) from personas_inscritas where p.partido_perteneciente = '$partido')";

            $db = DataBase::connect();
            return $db->query($query);
        } else {

            $query = "SELECT *from personas_inscritas p inner join mesas_electorales m on p.idmesa = m.idmesa
            WHERE (select count(idpersona) from personas_inscritas where p.partido_perteneciente = '')";

            $db = DataBase::connect();
            return $db->query($query);
        }
    }

    public static function Verificar($idmesa, $posicion)
    {
        $query = "SELECT count(idpersona) AS 'total' from personas_inscritas WHERE posicion_colegio = '$posicion' AND idmesa = '$idmesa'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    // Verificar número de identidad electoral
    
    public static function Verificar_cedula($cedula)
    {
    
        $query = "SELECT count(idpersona) as 'total' from personas_inscritas WHERE numero_de_identidad = '$cedula'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    // Verificar posición de colegio electoral

    public static function Verificar_posicion($colegio , $posicion)
    {
        $query = "SELECT count(p.idpersona) as 'total' from personas_inscritas p INNER JOIN  
        mesas_electorales m ON p.idmesa = m.idmesa WHERE p.posicion_colegio = '$posicion' AND m.colegio_electoral = '$colegio'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    // -----------------------------


    public static function Cantidad_votos($respuesta)
    {
        $query = "SELECT count(idpersona) AS 'total' from personas_inscritas WHERE ha_votado = '$respuesta'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function Total_de_partido($partido, $colegio)
    {

        $query = "SELECT count(p.idpersona) as 'total' from personas_inscritas p 
        INNER JOIN mesas_electorales m on p.idmesa = m.idmesa
        WHERE partido_perteneciente = '$partido' AND colegio_electoral = '$colegio'";

        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function JCE_votos()
    {
        $query = "SELECT SUM(votos) AS 'total' from resultados_finales";

        $db = DataBase::connect();
        return $db->query($query);
    }

    public static function JCE_votos_partido($partido)
    {
        $query = "SELECT SUM(votos) AS 'total' from resultados_finales WHERE partido = '$partido'";

        $db = DataBase::connect();
        return $db->query($query);
    }

}

