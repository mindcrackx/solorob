CREATE DATABASE solorob_db;
USE solorob_db;

/*
--CREATE USER 'admin'@'localhost';
--grant all privileges on solorob_db.* to 'admin'@'localhost' identified by 'adminadmin';
--drop database solorob_db; source /home/marcel/Documents/Berufsschule/AWP/htdocs/AWP/solorob/create_solorob_db.sql; source /home/marcel/Documents/Berufsschule/AWP/htdocs/AWP/solorob/create_solorob_db_data.sql;
*/


CREATE TABLE tbl_lieferant
(
    l_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    l_firmenname VARCHAR(25),
    l_strasse VARCHAR(25),
    l_plz VARCHAR(5),
    l_ort VARCHAR(45),
    l_tel VARCHAR(20),
    l_mobil VARCHAR(20),
    l_fax VARCHAR(20),
    l_email VARCHAR(45)
);


CREATE TABLE tbl_rechte_funktion
(
    rf_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rf_name VARCHAR(45) NOT NULL UNIQUE
);

CREATE TABLE tbl_rechte_rolle
(
    rr_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rr_name VARCHAR(45) NOT NULL UNIQUE
);

CREATE TABLE tbl_rechte_zuordnung
(
    rz_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rz_rolle_id INT(11) NOT NULL,
    rz_funktion_id INT(11) NOT NULL,

    CONSTRAINT fk_zuordnung_rolle_id
    FOREIGN KEY (rz_rolle_id)
    REFERENCES tbl_rechte_rolle(rr_id),

    CONSTRAINT fk_zuordnung_funktion_id
    FOREIGN KEY (rz_funktion_id)
    REFERENCES tbl_rechte_funktion(rf_id)
);

CREATE TABLE tbl_benutzer
(
    b_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    b_name VARCHAR(45) NOT NULL,
    b_vorname VARCHAR(45) NOT NULL,
    b_nickname VARCHAR(45) NOT NULL UNIQUE,
    b_password VARCHAR(100) NOT NULL,
    b_rechte_rolle_id INT(11) NOT NULL,

    CONSTRAINT fk_benutzer_rechte
    FOREIGN KEY (b_rechte_rolle_id)
    REFERENCES tbl_rechte_rolle(rr_id)
);

CREATE TABLE tbl_raeume
(
    r_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    r_nr VARCHAR(20),
    r_bezeichnung VARCHAR(45),
    r_notiz VARCHAR(1024)
);

CREATE TABLE tbl_komponentenarten
(
    ka_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ka_komponentenart VARCHAR(45)
);

CREATE TABLE tbl_komponentenattribute
(
    kat_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    kat_bezeichnung VARCHAR(25)
);

CREATE TABLE tbl_komponente_hat_attribute
(
    kha_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    komponenten_k_id INT(11) NOT NULL,
    komponentenattribute_kat_id INT(11),
    khkat_wert VARCHAR(45),

    CONSTRAINT fk_komponente_hat_attribute__komponentenattribute
    FOREIGN KEY (komponentenattribute_kat_id)
    REFERENCES tbl_komponentenattribute(kat_id)
);

CREATE TABLE tbl_komponenten
(
    k_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    k_bezeichnung VARCHAR(100),
    raeume_r_id INT(11),
    lieferant_l_id INT(11),
    k_einkaufsdatum DATE,
    k_gewaehrleistungsdauer INT(11),
    k_notiz VARCHAR(1024),
    k_hersteller VARCHAR(45),
    komponentenarten_ka_id INT(11),

    CONSTRAINT fk_komponenten__raeume_id
    FOREIGN KEY (raeume_r_id)
    REFERENCES tbl_raeume(r_id),

    CONSTRAINT fk_komponenten__lieferant_id
    FOREIGN KEY (lieferant_l_id)
    REFERENCES tbl_lieferant(l_id),

    CONSTRAINT fk_komponenten__komponentenarten_id
    FOREIGN KEY (komponentenarten_ka_id)
    REFERENCES tbl_komponentenarten(ka_id)
);

CREATE TABLE tbl_wird_beschrieben_durch
(
    wbd_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    komponentenarten_ka_id INT(11) NOT NULL,
    komponentenattribute_kat_id INT(11) NOT NULL,

    CONSTRAINT fk_wird_beschrieben_durch__komponentenarten
    FOREIGN KEY (komponentenarten_ka_id)
    REFERENCES tbl_komponentenarten(ka_id),

    CONSTRAINT fk_wird_beschrieben_durch__komponentenattribute
    FOREIGN KEY (komponentenattribute_kat_id)
    REFERENCES tbl_komponentenattribute(kat_id)
);


CREATE TABLE tbl_software_in_raum
(
    sir_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    sir_k_id INT(11),
    sir_r_id INT(11),

    CONSTRAINT fk_software_in_raum__komponenten_id
    FOREIGN KEY (sir_k_id)
    REFERENCES tbl_komponenten(k_id),

    CONSTRAINT fk_software_in_raum__raeume_id
    FOREIGN KEY (sir_r_id)
    REFERENCES tbl_raeume(r_id)
);