/*CREAR BASE DE DATOS*/
CREATE DATABASE IF NOT  EXISTS base_civiles;
USE base_civiles;

/*INICIO TABLA CONTACTOS*/
CREATE TABLE contactos(
     id              INT(255) auto_increment not null,
     nombre          VARCHAR (50) NOT NULL,
     email           VARCHAR (50) NOT NULL,
     telefono        VARCHAR (13),
     mensaje         TEXT (10000) NOT NULL,
    created_at      datetime DEFAULT NULL,
    updated_at      datetime DEFAULT NULL,
    CONSTRAINT pk_contactos PRIMARY KEY(id)
)ENGINE=InnoDb;
/*FIN TABLA CONTACTOS*/

/*INICIO TABLA usuario*/
CREATE TABLE usuario(
     id              INT(255) auto_increment not null,
     username          VARCHAR (20) NOT NULL,
     contrasena           VARCHAR (200) NOT NULL,
    created_at      datetime DEFAULT NULL,
    updated_at      datetime DEFAULT NULL,
    CONSTRAINT pk_usuario PRIMARY KEY(id)
)ENGINE=InnoDb;
/*FIN TABLA usuario*/

/*INICIO TABLA usuario*/
CREATE TABLE servicios(
     id              INT(255) auto_increment not null,
     nombre          VARCHAR (100) NOT NULL,
     imagen          VARCHAR (100) NOT NULL,
     descripcion           TEXT (20000) NOT NULL,
    created_at      datetime DEFAULT NULL,
    updated_at      datetime DEFAULT NULL,
    CONSTRAINT pk_usuario PRIMARY KEY(id)
)ENGINE=InnoDb;
/*FIN TABLA usuario*/

/*INICIO TABLA CAMBIOS*/
CREATE TABLE cambios(
     id              INT(255) auto_increment not null,
     colornav          VARCHAR (20) NOT NULL,
     colorfoo          VARCHAR (20) NOT NULL,
     colortext          VARCHAR (20) NOT NULL,
     imgcarr1          VARCHAR (100) NOT NULL,
     imgcarr2          VARCHAR (100) NOT NULL,
     imgcarr3          VARCHAR (100) NOT NULL,
     textimg1          VARCHAR (100) NOT NULL,
     textimg2          VARCHAR (100) NOT NULL,
     textimg3          VARCHAR (100) NOT NULL,
     text1           TEXT (5000) NOT NULL,
     text2           TEXT (5000) NOT NULL,
     text3           TEXT (5000) NOT NULL,
     text4           TEXT (5000) NOT NULL,
     text5           TEXT (5000) NOT NULL,
    created_at      datetime DEFAULT NULL,
    updated_at      datetime DEFAULT NULL,
    CONSTRAINT pk_usuario PRIMARY KEY(id)
)ENGINE=InnoDb;
/*FIN TABLA usuario*/

/*INICIO TABLA CAMBIOS*/
CREATE TABLE proyectos(
     id              INT(255) auto_increment not null,
     nombre          VARCHAR (100) NOT NULL,
     descripcion     TEXT(20000) NOT NULL,
     imagen          VARCHAR (100) NOT NULL,
    created_at      datetime DEFAULT NULL,
    updated_at      datetime DEFAULT NULL,
    CONSTRAINT pk_usuario PRIMARY KEY(id)
)ENGINE=InnoDb;
/*FIN TABLA usuario*/