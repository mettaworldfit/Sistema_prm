CREATE DATABASE 

IF NOT EXISTS prm_db CHARACTER SET utf8 COLLATE utf8_general_ci;

USE prm_db ;

CREATE TABLE mesas_electorales (
idmesa int(10) auto_increment NOT NULL,
colegio_electoral int(100) NOT NULL,
ubicacion varchar(100) NULL,
fecha date NULL,
CONSTRAINT pk_mesas_electorales PRIMARY KEY (idmesa)

)ENGINE = InnoDb;

CREATE TABLE personas_inscritas (
idpersona int(10) auto_increment NOT NULL,
idmesa int(10) NOT NULL,
nombre varchar(50) NOT NULL,
apellidos varchar(50) NOT NULL,
numero_de_identidad int(20) UNIQUE,
telefono int(10) DEFAULT '000',
partido_perteneciente varchar(20) DEFAULT 'Sin Registrar',
fecha date NULL,
CONSTRAINT pk_personas_inscritas PRIMARY KEY (idpersona),
CONSTRAINT fk_mesas_electorales_personas_inscritas FOREIGN KEY (idmesa) REFERENCES mesas_electorales(idmesa)
)ENGINE = InnoDb;

CREATE TABLE votos_registrados (
idvoto int(10) auto_increment NOT NULL,
idpersona int(10) NOT NULL,
fecha date NULL,
CONSTRAINT pk_votos_registrados PRIMARY KEY (idvoto),
CONSTRAINT fk_personas_inscritas_votos_registrados FOREIGN KEY (idpersona) REFERENCES personas_inscritas(idpersona)
)ENGINE = InnoDb;